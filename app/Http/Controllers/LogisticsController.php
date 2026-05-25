<?php
namespace App\Http\Controllers;

use App\Models\Logistics;
use App\Models\MandiPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogisticsController extends Controller
{
    public function index()
    {
        $user     = Auth::user();
        $logistics = Logistics::where('farmer_id', (string)$user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('dashboard.logistics', compact('user', 'logistics'));
    }

    public function advanceStage(Request $request, $id)
    {
        $user   = Auth::user();
        $item   = Logistics::findOrFail($id);

        // Allow farmer to advance only their own shipments
        if ((string)$item->farmer_id !== (string)$user->id) {
            return back()->with('error', 'Unauthorized.');
        }

        if ($item->status === 'Cancelled') {
            return back()->with('error', 'This shipment has been cancelled and cannot be advanced.');
        }

        $stages = ['Pending Pickup', 'Dispatched', 'In Transit', 'Out for Delivery', 'Delivered'];
        $idx    = array_search($item->status, $stages);

        if ($idx !== false && $idx < count($stages) - 1) {
            $newStatus = $stages[$idx + 1];

            // If advancing to Delivered, we just mark it as verified automatically
            if ($newStatus === 'Delivered') {
                $item->otp_verified = true;
            }

            // Descriptions for each stage transition
            $descriptions = [
                'Pending Pickup'  => 'Shipment is ready at the farm. Awaiting logistics pickup.',
                'Dispatched'      => 'Package has been dispatched from the farm.',
                'In Transit'      => 'Package is in transit between hubs.',
                'Out for Delivery'=> 'Package is out for delivery. Share your OTP with the driver upon arrival.',
            ];

            // Append to history array
            $history = $item->history ?? [];
            $history[] = [
                'status'      => $newStatus,
                'timestamp'   => now()->toIso8601String(),
                'location'    => $item->pickup_address ?? 'Farm Location',
                'description' => $descriptions[$newStatus] ?? "Status updated to {$newStatus}.",
            ];

            $item->status  = $newStatus;
            $item->history = $history;
            $item->save();

            // Notify buyer of status update
            \App\Models\Notification::create([
                'user_id'    => $item->buyer_id,
                'type'       => 'order',
                'title'      => 'Shipment Update 🚚',
                'message'    => "Your order for {$item->crop_name} is now: {$item->status}",
                'is_read'    => false,
                'created_at' => now(),
                'data'       => ['url' => route('buyer.logistics')],
            ]);

            return back()->with('success', "Shipment moved to: {$item->status}");
        }

        return back()->with('info', 'This shipment is already delivered.');
    }

    public function verifyOtp(Request $request, $id)
    {
        $user = Auth::user();
        $item = Logistics::findOrFail($id);

        // Validate - OTP can be 4 digits (our system) or 6 digits (future)
        $request->validate(['otp' => 'required|string|min:4|max:6']);

        if ((string)$item->buyer_id !== (string)$user->id) {
            return back()->with('error', 'Unauthorized. Only the buyer can verify the delivery.');
        }

        if ($item->status !== 'Out for Delivery') {
            return back()->with('error', 'OTP can only be verified when the order is Out for Delivery.');
        }

        if ((string)$request->otp === (string)$item->delivery_otp) {
            // Append Delivered to history
            $history = $item->history ?? [];
            $history[] = [
                'status'      => 'Delivered',
                'timestamp'   => now()->toIso8601String(),
                'location'    => $item->delivery_address ?? 'Delivery Location',
                'description' => 'OTP verified by buyer. Order successfully delivered.',
            ];

            $item->status       = 'Delivered';
            $item->otp_verified = true;
            $item->history      = $history;
            $item->save();

            // Update linked order to delivered
            if ($item->order_id) {
                \App\Models\Order::where('_id', $item->order_id)
                    ->update(['status' => 'delivered']);
            }

            // Notify farmer
            \App\Models\Notification::create([
                'user_id'    => $item->farmer_id,
                'type'       => 'order',
                'title'      => 'Order Delivered! 🎉',
                'message'    => "Your shipment for {$item->crop_name} has been successfully delivered and verified by the buyer.",
                'is_read'    => false,
                'created_at' => now(),
                'data'       => ['url' => route('farmer.logistics')],
            ]);

            return back()->with('success', "✅ OTP verified! Order #{$item->tracking_number} is now Delivered!");
        }

        return back()->with('error', '❌ Wrong OTP! Please ask the buyer to re-check their OTP.');
    }

    // ── Mandi Prices ──────────────────────────────────────────────────────────
    public function mandi(Request $request)
    {
        $user     = Auth::user();
        $search   = $request->get('search', '');
        $category = $request->get('category', '');

        // Seed if empty
        if (MandiPrice::count() === 0) {
            $this->seedMandiPrices();
        }

        $query = MandiPrice::query();
        if ($search) {
            $query->where('crop_name', 'like', "%{$search}%");
        }
        if ($category && $category !== 'All') {
            $query->where('category', $category);
        }
        $prices = $query->orderBy('category')->orderBy('crop_name')->get();

        return view('dashboard.mandi', compact('user', 'prices', 'search', 'category'));
    }

    private function seedMandiPrices()
    {
        // [Crop Name, Mandi Location, Price per Quintal (₹), Category]
        $data = [
            // ── CEREALS ──────────────────────────────────────────────────────
            ['Wheat',                   'Khanna Mandi, Punjab',           2275, 'Cereal'],
            ['Rice (Basmati)',           'Amritsar Mandi, Punjab',         4200, 'Cereal'],
            ['Rice (Non-Basmati)',       'Karnal Mandi, Haryana',          2183, 'Cereal'],
            ['Paddy (Raw)',              'Cuttack Mandi, Odisha',          1940, 'Cereal'],
            ['Maize (Corn)',             'Gulbarga Mandi, Karnataka',      1962, 'Cereal'],
            ['Jowar (Sorghum)',          'Solapur Mandi, Maharashtra',     3371, 'Cereal'],
            ['Bajra (Pearl Millet)',     'Jaipur Mandi, Rajasthan',        2350, 'Cereal'],
            ['Ragi (Finger Millet)',     'Bangalore Mandi, Karnataka',     3846, 'Cereal'],
            ['Barley',                   'Kota Mandi, Rajasthan',          1735, 'Cereal'],
            ['Oats',                     'Ludhiana Mandi, Punjab',         2100, 'Cereal'],

            // ── PULSES ───────────────────────────────────────────────────────
            ['Chickpea (Chana)',         'Indore Mandi, MP',               5440, 'Pulse'],
            ['Lentil (Masoor Dal)',      'Bhopal Mandi, MP',               6000, 'Pulse'],
            ['Pigeon Pea (Toor Dal)',    'Akola Mandi, Maharashtra',       7000, 'Pulse'],
            ['Green Gram (Moong)',       'Nagpur Mandi, Maharashtra',      8558, 'Pulse'],
            ['Black Gram (Urad)',        'Indore Mandi, MP',               6950, 'Pulse'],
            ['Field Pea (Matar)',        'Agra Mandi, UP',                 5100, 'Pulse'],
            ['Kidney Beans (Rajma)',     'Jammu Mandi, J&K',               8500, 'Pulse'],
            ['Cowpea (Lobia)',           'Coimbatore Mandi, Tamil Nadu',   5200, 'Pulse'],
            ['Horse Gram',              'Mysore Mandi, Karnataka',         6800, 'Pulse'],
            ['Moth Bean',               'Bikaner Mandi, Rajasthan',        5600, 'Pulse'],

            // ── VEGETABLES ───────────────────────────────────────────────────
            ['Tomato',                  'Nashik Mandi, Maharashtra',       1400, 'Vegetable'],
            ['Onion',                   'Lasalgaon Mandi, Maharashtra',    2000, 'Vegetable'],
            ['Potato',                  'Agra Mandi, UP',                   900, 'Vegetable'],
            ['Cauliflower',             'Nashik Mandi, Maharashtra',        800, 'Vegetable'],
            ['Cabbage',                 'Pune Mandi, Maharashtra',          600, 'Vegetable'],
            ['Carrot',                  'Ooty Mandi, Tamil Nadu',          1800, 'Vegetable'],
            ['Capsicum (Green)',        'Belgaum Mandi, Karnataka',        2400, 'Vegetable'],
            ['Capsicum (Red)',          'Belgaum Mandi, Karnataka',        4500, 'Vegetable'],
            ['Brinjal (Baingan)',       'Varanasi Mandi, UP',               700, 'Vegetable'],
            ['Lady Finger (Bhindi)',    'Surat Mandi, Gujarat',            1500, 'Vegetable'],
            ['Spinach (Palak)',         'Delhi Azadpur Mandi, Delhi',      1200, 'Vegetable'],
            ['Fenugreek (Methi)',       'Ahmedabad Mandi, Gujarat',        2000, 'Vegetable'],
            ['Green Chili',            'Guntur Mandi, Andhra Pradesh',    3500, 'Vegetable'],
            ['Bitter Gourd (Karela)',   'Lucknow Mandi, UP',               1800, 'Vegetable'],
            ['Bottle Gourd (Lauki)',    'Kanpur Mandi, UP',                 800, 'Vegetable'],
            ['Ridge Gourd (Turai)',     'Patna Mandi, Bihar',               900, 'Vegetable'],
            ['Snake Gourd',             'Chennai Mandi, Tamil Nadu',        700, 'Vegetable'],
            ['Pumpkin (Kaddu)',         'Kolkata Mandi, West Bengal',       700, 'Vegetable'],
            ['Cucumber (Kheera)',       'Bangalore Mandi, Karnataka',      1000, 'Vegetable'],
            ['Beetroot',                'Ooty Mandi, Tamil Nadu',          2200, 'Vegetable'],
            ['Radish (Mooli)',          'Delhi Azadpur Mandi, Delhi',       800, 'Vegetable'],
            ['Turnip (Shalgam)',        'Amritsar Mandi, Punjab',           900, 'Vegetable'],
            ['Sweet Potato',            'Bhubaneswar Mandi, Odisha',       2500, 'Vegetable'],
            ['Yam (Jimikand)',          'Varanasi Mandi, UP',              3000, 'Vegetable'],
            ['Garlic',                  'Neemuch Mandi, MP',              13000, 'Vegetable'],
            ['Ginger (Fresh)',          'Kozhikode Mandi, Kerala',         7000, 'Vegetable'],
            ['Green Pea (Fresh)',       'Agra Mandi, UP',                  3200, 'Vegetable'],
            ['Drumstick (Sahjan)',      'Coimbatore Mandi, Tamil Nadu',    3000, 'Vegetable'],
            ['Corn (Sweet)',            'Pune Mandi, Maharashtra',         2500, 'Vegetable'],
            ['Cluster Beans (Guar)',    'Jaipur Mandi, Rajasthan',         1800, 'Vegetable'],
            ['Raw Banana',              'Jalgaon Mandi, Maharashtra',      1200, 'Vegetable'],
            ['Taro Root (Arbi)',        'Lucknow Mandi, UP',               2000, 'Vegetable'],
            ['French Beans',            'Bangalore Mandi, Karnataka',      2800, 'Vegetable'],
            ['Coriander (Fresh)',       'Indore Mandi, MP',                2500, 'Vegetable'],

            // ── FRUITS ───────────────────────────────────────────────────────
            ['Mango (Alphonso)',        'Ratnagiri Mandi, Maharashtra',   20000, 'Fruit'],
            ['Mango (Totapuri)',        'Bangalore Mandi, Karnataka',      5500, 'Fruit'],
            ['Mango (Dussehri)',        'Lucknow Mandi, UP',               7000, 'Fruit'],
            ['Banana (Cavendish)',      'Jalgaon Mandi, Maharashtra',      2200, 'Fruit'],
            ['Banana (Robusta)',        'Coimbatore Mandi, Tamil Nadu',    1800, 'Fruit'],
            ['Apple (Shimla)',          'Shimla Mandi, HP',               10000, 'Fruit'],
            ['Apple (Kinnaur)',         'Rampur Mandi, HP',               14000, 'Fruit'],
            ['Grapes (Thompson)',       'Nashik Mandi, Maharashtra',       5000, 'Fruit'],
            ['Grapes (Black)',          'Solapur Mandi, Maharashtra',      7000, 'Fruit'],
            ['Orange (Nagpur)',         'Nagpur Mandi, Maharashtra',       5500, 'Fruit'],
            ['Lemon',                   'Tirupur Mandi, Tamil Nadu',       6000, 'Fruit'],
            ['Pomegranate',             'Solapur Mandi, Maharashtra',     10000, 'Fruit'],
            ['Papaya',                  'Anand Mandi, Gujarat',            1500, 'Fruit'],
            ['Guava',                   'Allahabad Mandi, UP',             2500, 'Fruit'],
            ['Watermelon',              'Hyderabad Mandi, Telangana',      1000, 'Fruit'],
            ['Muskmelon (Kharbooza)',   'Surat Mandi, Gujarat',            1500, 'Fruit'],
            ['Pineapple',               'Agartala Mandi, Tripura',         3000, 'Fruit'],
            ['Strawberry',              'Mahabaleshwar Mandi, Maharashtra',8000, 'Fruit'],
            ['Litchi',                  'Muzaffarpur Mandi, Bihar',       10000, 'Fruit'],
            ['Sapota (Chikoo)',         'Anand Mandi, Gujarat',            4000, 'Fruit'],
            ['Custard Apple (Sitaphal)','Nasik Mandi, Maharashtra',        6000, 'Fruit'],
            ['Coconut',                 'Pollachi Mandi, Tamil Nadu',      2500, 'Fruit'],
            ['Fig (Anjeer)',            'Pune Mandi, Maharashtra',        15000, 'Fruit'],
            ['Jamun',                   'Lucknow Mandi, UP',               4000, 'Fruit'],
            ['Pear (Nashpati)',         'Pathankot Mandi, Punjab',         6000, 'Fruit'],
            ['Plum (Aloo Bukhara)',     'Shimla Mandi, HP',                8000, 'Fruit'],
            ['Kiwi',                    'Solan Mandi, HP',                18000, 'Fruit'],
            ['Dragon Fruit',            'Ahmedabad Mandi, Gujarat',       15000, 'Fruit'],
            ['Jackfruit (Kathal)',       'Thrissur Mandi, Kerala',          4000, 'Fruit'],
            ['Amla (Indian Gooseberry)','Pratapgarh Mandi, UP',            8000, 'Fruit'],

            // ── SPICES ───────────────────────────────────────────────────────
            ['Red Chili (Dried)',       'Guntur Mandi, Andhra Pradesh',   16000, 'Spice'],
            ['Turmeric (Haldi)',        'Erode Mandi, Tamil Nadu',         8000, 'Spice'],
            ['Coriander Seeds (Dhaniya)','Kota Mandi, Rajasthan',          8500, 'Spice'],
            ['Cumin (Jeera)',           'Unjha Mandi, Gujarat',           25000, 'Spice'],
            ['Fenugreek Seeds (Methi)', 'Jaipur Mandi, Rajasthan',        5800, 'Spice'],
            ['Black Pepper',            'Kozhikode Mandi, Kerala',        50000, 'Spice'],
            ['Cardamom (Elaichi)',       'Idukki Mandi, Kerala',          120000, 'Spice'],
            ['Cloves (Laung)',          'Kozhikode Mandi, Kerala',        75000, 'Spice'],
            ['Cinnamon (Dalchini)',     'Kozhikode Mandi, Kerala',        45000, 'Spice'],
            ['Ajwain (Carom Seeds)',    'Rajkot Mandi, Gujarat',          17000, 'Spice'],
            ['Fennel (Saunf)',          'Unjha Mandi, Gujarat',           12000, 'Spice'],
            ['Mustard Seeds (Sarson)',  'Jaipur Mandi, Rajasthan',         6200, 'Spice'],
            ['Bay Leaf (Tej Patta)',    'Siliguri Mandi, West Bengal',     8000, 'Spice'],
            ['Star Anise (Chakra Phool)','Kozhikode Mandi, Kerala',       55000, 'Spice'],

            // ── OILSEEDS ─────────────────────────────────────────────────────
            ['Soybean',                 'Indore Mandi, MP',                4200, 'Oilseed'],
            ['Groundnut (Peanut)',      'Rajkot Mandi, Gujarat',           5700, 'Oilseed'],
            ['Sunflower',               'Raichur Mandi, Karnataka',        6015, 'Oilseed'],
            ['Sesame (Til)',            'Jamnagar Mandi, Gujarat',        13600, 'Oilseed'],
            ['Linseed (Alsi)',         'Raipur Mandi, Chhattisgarh',       5600, 'Oilseed'],
            ['Safflower (Kadipha)',     'Latur Mandi, Maharashtra',         5800, 'Oilseed'],
            ['Castor (Arandi)',         'Deesa Mandi, Gujarat',             5500, 'Oilseed'],
            ['Mustard (Rapeseed)',      'Bharatpur Mandi, Rajasthan',      5650, 'Oilseed'],
            ['Niger Seed (Ramtil)',     'Jagdalpur Mandi, Chhattisgarh',   6500, 'Oilseed'],

            // ── CASH CROPS ───────────────────────────────────────────────────
            ['Cotton (Long Staple)',    'Akola Mandi, Maharashtra',        7020, 'Cash Crop'],
            ['Cotton (Medium Staple)',  'Rajkot Mandi, Gujarat',           6500, 'Cash Crop'],
            ['Sugarcane',               'Kolhapur Mandi, Maharashtra',      350, 'Cash Crop'],
            ['Jute',                    'Siliguri Mandi, West Bengal',     5050, 'Cash Crop'],
            ['Tobacco (Virginia)',      'Guntur Mandi, Andhra Pradesh',   18000, 'Cash Crop'],
        ];

        foreach ($data as [$crop, $mandi, $price, $category]) {
            MandiPrice::create([
                'crop_name'   => $crop,
                'mandi_name'  => $mandi,
                'state'       => trim(explode(',', $mandi)[1] ?? 'India'),
                'price_per_q' => $price,
                'category'    => $category,
            ]);
        }
    }
}

