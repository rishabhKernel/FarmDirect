<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FarmerController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Search logic
        $cropQuery = Crop::where('farmer_id', $user->id);
        
        if ($request->filled('category') && $request->category !== 'All') {
            $cropQuery->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $words = explode(' ', $searchTerm);
            $cropQuery->where(function($q) use ($words) {
                foreach ($words as $word) {
                    if (trim($word) != '') {
                        $q->orWhere('name', 'LIKE', '%' . trim($word) . '%');
                    }
                }
            });
        }
        $crops = $cropQuery->limit(5)->get();

        // Fetch User's Active Bids
        $bids = \App\Models\Bid::whereIn('crop_id', $crops->pluck('id'))
                            ->where('status', 'pending')
                            ->orderBy('created_at', 'desc')
                            ->limit(4)
                            ->get();

        // Fetch Active Orders
        $activeOrders = \App\Models\Order::where('farmer_id', (string)$user->id)
                                         ->whereIn('status', ['pending', 'processing'])
                                         ->orderBy('created_at', 'desc')
                                         ->get();

        // Fetch Stats
        $revenue = Order::where('farmer_id', (string)$user->id)
                        ->whereIn('status', ['completed', 'processing', 'delivered']) // Including processing and delivered for demo visual impact
                        ->sum('total_price');

        // Fetch Weather Data (Cached for 1 hour)
        $weather = \Illuminate\Support\Facades\Cache::remember("weather_{$user->city}", 3600, function() use ($user) {
            return $this->getWeather($user->city);
        });

        // Mock AI Trends based on farmer's crops
        $trends = [];
        foreach($crops as $crop) {
            $trends[] = [
                'name' => $crop->name,
                'current' => $crop->price_per_unit,
                'predicted' => round($crop->price_per_unit * (1 + (rand(-5, 15) / 100)), 2),
                'status' => rand(0, 1) ? 'trending_up' : 'trending_flat'
            ];
        }

        // Fetch 3 Mandi Prices for widget
        $mandiPrices = \Illuminate\Support\Facades\Cache::get("mandi_prices");
        if (!$mandiPrices || !is_array($mandiPrices)) {
            $mandiPrices = $this->fetchLiveMandiPrices();
            \Illuminate\Support\Facades\Cache::put("mandi_prices", $mandiPrices, 14400);
        }

        // Fetch Logistics (only real ones linked to orders)
        $logistics = \App\Models\Logistics::where('farmer_id', (string)$user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Generate chart data (last 7 days)
        $revenueData = [0, 0, 0, 0, 0, 0, 0]; // Start at zero
        $chartOrders = Order::where('farmer_id', (string)$user->id)
                        ->whereIn('status', ['completed', 'processing', 'delivered'])
                        ->where('created_at', '>=', now()->subDays(7))
                        ->get();
        
        foreach ($chartOrders as $order) {
            $dayIndex = $order->created_at->format('N') - 1; // 0 for Mon, 6 for Sun
            if ($dayIndex >= 0 && $dayIndex < 7) {
                $revenueData[$dayIndex] += $order->total_price;
            }
        }

        // AI Insights based on data
        $cropCount = $crops->count();
        $bidCount = \App\Models\Bid::whereIn('crop_id', $crops->pluck('id'))->count();
        
        $aiInsights = "You have {$cropCount} active crop listings. ";
        if ($bidCount > 0) {
            $aiInsights .= "There are {$bidCount} active bids waiting for your review. ";
        } else {
            $aiInsights .= "No active bids yet. Consider updating prices to attract buyers. ";
        }
        
        if (str_contains(strtolower($weather['condition'] ?? ''), 'rain')) {
            $aiInsights .= "Weather is rainy. Delay harvest and check for fungal infections.";
        } else {
            $aiInsights .= "Weather is clear. Great time for drying harvested grains and applying fertilizers.";
        }

        // Dynamic Greeting & Time
        $hour = now()->hour;
        $greeting = 'Good morning';
        if ($hour >= 12 && $hour < 17) $greeting = 'Good afternoon';
        elseif ($hour >= 17 || $hour < 5) $greeting = 'Good evening';

        return view('dashboard.farmer', compact('user', 'crops', 'bids', 'activeOrders', 'revenue', 'weather', 'trends', 'greeting', 'mandiPrices', 'logistics', 'revenueData', 'aiInsights'));
    }

    public function nextLogisticsStage(\Illuminate\Http\Request $request, $id)
    {
        $logistics = \App\Models\Logistics::find($id);
        if (!$logistics) {
            return back()->with('error', 'Logistics record not found!');
        }

        $stages = ['Pending Pickup', 'Dispatched', 'In Transit', 'Out for Delivery', 'Delivered'];
        $currentStage = $logistics->status;
        $currentIndex = array_search($currentStage, $stages);

        if ($currentIndex !== false && $currentIndex < count($stages) - 1) {
            $nextStage = $stages[$currentIndex + 1];
            
            $logistics->status = $nextStage;

            // Update history array
            $descriptions = [
                'Pending Pickup'  => 'Shipment is ready at the farm. Awaiting logistics pickup.',
                'Dispatched'      => 'Package has been dispatched from the farm.',
                'In Transit'      => 'Package is in transit between hubs.',
                'Out for Delivery'=> 'Package is out for delivery. Share your OTP with the driver upon arrival.',
                'Delivered'       => 'OTP verified by buyer. Order successfully delivered.',
            ];

            $history = $logistics->history ?? [];
            $history[] = [
                'status'      => $nextStage,
                'timestamp'   => now()->toIso8601String(),
                'location'    => $logistics->pickup_address ?? 'Farm Location',
                'description' => $descriptions[$nextStage] ?? "Shipment marked as {$nextStage}.",
            ];
            $logistics->history = $history;
            $logistics->save();

            // Create a notification for the farmer
            \App\Models\Notification::create([
                'user_id' => \Auth::id(),
                'type' => 'order',
                'title' => 'Logistics Update',
                'message' => 'Your shipment status has been updated to: ' . $logistics->status,
                'is_read' => false,
                'created_at' => now(),
                'data' => ['url' => route('farmer.dashboard')]
            ]);

            // Create a notification for the buyer
            \App\Models\Notification::create([
                'user_id' => $logistics->buyer_id,
                'type' => 'success',
                'title' => 'Shipment Update 📦',
                'message' => 'Your shipment for ' . $logistics->crop_name . ' is now: ' . $logistics->status,
                'is_read' => false,
                'created_at' => now(),
                'data' => ['url' => route('buyer.logistics')]
            ]);

            return back()->with('success', 'Logistics moved to next stage: ' . $nextStage);
        }

        return back()->with('info', 'Shipment is already out for delivery or delivered! Enter OTP to complete.');
    }

    public function verifyOTP(\Illuminate\Http\Request $request, $id)
    {
        $logistics = \App\Models\Logistics::find($id);
        if (!$logistics) {
            return response()->json(['success' => false, 'message' => 'Logistics record not found!']);
        }

        if ($request->otp === $logistics->delivery_otp) {
            $logistics->status = 'Delivered';
            $logistics->otp_verified = true;

            // Update history array
            $history = $logistics->history ?? [];
            $history[] = [
                'status'      => 'Delivered',
                'timestamp'   => now()->toIso8601String(),
                'location'    => $logistics->delivery_address ?? 'Delivery Location',
                'description' => 'OTP verified. Shipment successfully delivered.',
            ];
            $logistics->history = $history;
            $logistics->save();

            // Sync with Order model
            $order = \App\Models\Order::find($logistics->order_id);
            if ($order) {
                $order->status = 'delivered';
                $order->save();
            }

            // Notifications
            \App\Models\Notification::create([
                'user_id' => $logistics->buyer_id,
                'type' => 'success',
                'title' => 'Order Delivered! 🎁',
                'message' => 'Your order for ' . $logistics->crop_name . ' has been delivered successfully.',
                'is_read' => false,
                'created_at' => now(),
                'data' => ['url' => route('buyer.orders')]
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP. Please try again.']);
    }

    private function getWeather($city)
    {
        try {
            // 1. Geocode the city to get lat/long
            $geoResponse = Http::get("https://geocoding-api.open-meteo.com/v1/search", [
                'name' => $city,
                'count' => 1,
                'language' => 'en',
                'format' => 'json'
            ]);

            if ($geoResponse->successful() && isset($geoResponse['results'][0])) {
                $lat = $geoResponse['results'][0]['latitude'];
                $lon = $geoResponse['results'][0]['longitude'];

                // 2. Fetch weather for lat/long
                $weatherResponse = Http::get("https://api.open-meteo.com/v1/forecast", [
                    'latitude' => $lat,
                    'longitude' => $lon,
                    'current_weather' => true,
                    'timezone' => 'auto'
                ]);

                if ($weatherResponse->successful()) {
                    return [
                        'temp' => round($weatherResponse['current_weather']['temperature']),
                        'condition' => $this->getWeatherIcon($weatherResponse['current_weather']['weathercode']),
                        'city' => $city
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::error("Weather fetch failed: " . $e->getMessage());
        }

        // Fallback mock data
        return [
            'temp' => 28,
            'condition' => 'sunny',
            'city' => $city
        ];
    }

    private function getWeatherIcon($code)
    {
        // Simple mapping of WMO codes to Material Icons
        if ($code == 0) return 'sunny';
        if ($code >= 1 && $code <= 3) return 'cloud';
        if ($code >= 45 && $code <= 48) return 'foggy';
        if ($code >= 51 && $code <= 67) return 'rainy';
        if ($code >= 71 && $code <= 77) return 'snowing';
        if ($code >= 80 && $code <= 82) return 'rainy_heavy';
        if ($code >= 95) return 'thunderstorm';
        return 'sunny';
    }

    private function fetchLiveMandiPrices()
    {
        $apiKey = env('DATA_GOV_IN_API_KEY');
        $resourceId = env('DATA_GOV_IN_RESOURCE_ID', 'YOUR_RESOURCE_ID_HERE');
        
        if (!$apiKey || $resourceId === 'YOUR_RESOURCE_ID_HERE') {
            return \App\Models\MandiPrice::limit(3)->get()->map(function($m) {
                return [
                    'crop_name' => $m->crop_name,
                    'price_per_q' => $m->price_per_q,
                    'category' => $m->category ?? 'General'
                ];
            })->toArray();
        }
        
        try {
            $response = \Illuminate\Support\Facades\Http::get("https://api.data.gov.in/resource/{$resourceId}", [
                'api-key' => $apiKey,
                'format' => 'json',
                'limit' => 3
            ]);
            
            if ($response->successful() && !empty($response['records'])) {
                return collect($response['records'])->map(function($record) {
                    return [
                        'crop_name' => $record['commodity'] ?? 'Unknown',
                        'price_per_q' => (float)($record['modal_price'] ?? 0),
                        'category' => $record['category'] ?? 'General'
                    ];
                })->toArray();
            }
        } catch (\Exception $e) {
            \Log::error("Mandi API failed: " . $e->getMessage());
        }

        // Fallback hardcoded premium data to ensure UI is NEVER blank
        return [
            ['crop_name' => 'Basmati Rice', 'price_per_q' => 8500, 'category' => 'Cereals'],
            ['crop_name' => 'Organic Wheat', 'price_per_q' => 2400, 'category' => 'Cereals'],
            ['crop_name' => 'Red Onions', 'price_per_q' => 1800, 'category' => 'Vegetables'],
        ];
    }

    public function crops(Request $request)
    {
        $user = Auth::user();
        $query = Crop::where('farmer_id', (string)$user->id);

        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $words = explode(' ', $searchTerm);
            $query->where(function($q) use ($words) {
                foreach ($words as $word) {
                    if (trim($word) != '') {
                        $q->orWhere('name', 'LIKE', '%' . trim($word) . '%');
                    }
                }
            });
        }

        $crops = $query->get();

        return view('dashboard.crops', compact('user', 'crops'));
    }

    public function notifications()
    {
        $user = Auth::user();
        $notifications = \App\Models\Notification::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        
        if ($notifications->isEmpty()) {
            // Seed mock notifications
            $mocks = [
                [
                    'user_id' => $user->id,
                    'type' => 'price_alert',
                    'title' => 'Wheat Market Surge',
                    'message' => 'AI predicts a 12% increase in Wheat prices in your region next week. Consider holding inventory.',
                    'is_read' => false,
                    'created_at' => now(),
                    'data' => ['url' => route('farmer.crops')]
                ],
                [
                    'user_id' => $user->id,
                    'type' => 'stat',
                    'title' => 'Quality Verified',
                    'message' => 'Your Organic Cotton batch #OC-2024 has passed the government quality check.',
                    'is_read' => true,
                    'created_at' => now()->subHours(2),
                    'data' => ['url' => route('farmer.dashboard')]
                ],
                [
                    'user_id' => $user->id,
                    'type' => 'order',
                    'title' => 'Order #4582 Out for Delivery',
                    'message' => 'The logistics partner has picked up your shipment of Basmati Rice.',
                    'is_read' => true,
                    'created_at' => now()->subDays(1),
                    'data' => ['url' => route('farmer.dashboard')]
                ],
                [
                    'user_id' => $user->id,
                    'type' => 'system',
                    'title' => 'Payout Confirmed',
                    'message' => 'The payment of ₹45,000 for Order #4560 has been credited to your linked bank account.',
                    'is_read' => true,
                    'created_at' => now()->subDays(2),
                    'data' => ['url' => route('farmer.settings')]
                ],
                [
                    'user_id' => $user->id,
                    'type' => 'bid',
                    'title' => 'New High Bid Received',
                    'message' => 'Reliance Retail placed a new high bid of ₹2,200/quintal for your Wheat.',
                    'is_read' => false,
                    'created_at' => now()->subMinutes(30),
                    'data' => ['url' => route('farmer.bids')]
                ]
            ];

            foreach ($mocks as $mock) {
                // \App\Models\Notification::create($mock); // Disabled to prevent repetitive popups
            }

            $notifications = \App\Models\Notification::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }

        return view('dashboard.notifications', compact('user', 'notifications'));
    }

    public function markNotificationRead($id)
    {
        $notification = \App\Models\Notification::findOrFail($id);
        $notification->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    public function deleteNotification($id)
    {
        $notification = \App\Models\Notification::findOrFail($id);
        $notification->delete();
        return response()->json(['success' => true]);
    }

    public function bids()
    {
        $user = \Auth::user();
        
        // Fetch all crop IDs owned by this farmer (convert to string for matching in bids collection)
        $cropIds = \App\Models\Crop::where('farmer_id', (string)$user->id)->pluck('_id')->map(fn($id) => (string)$id)->toArray();

        // Fetch bids for those crops
        $bids = \App\Models\Bid::whereIn('crop_id', $cropIds)
            ->whereIn('status', ['pending', 'negotiating', 'accepted'])
            ->with(['crop', 'buyer'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Fetch active orders (pending or processing)
        $activeOrders = \App\Models\Order::where('farmer_id', (string)$user->id)
                    ->whereIn('status', ['pending', 'processing', 'in_transit'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        
        return view('dashboard.bids', compact('user', 'bids', 'activeOrders'));
    }
    public function acceptBid($id)
    {
        $bid = \App\Models\Bid::findOrFail($id);
        $bid->update(['status' => 'accepted']);

        $crop = $bid->crop;
        $buyer = $bid->buyer;

        // Update the crop's base price to reflect the new agreed procurement price
        if ($crop) {
            $crop->update(['price_per_unit' => (float)$bid->amount]);
        }

        // Create an Order to track progress
        $order = \App\Models\Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'farmer_id' => \Auth::id(),
            'buyer_id' => $bid->buyer_id,
            'items' => [
                [
                    'crop_id' => $bid->crop_id,
                    'name' => $crop->name ?? 'Crop',
                    'quantity' => $crop->quantity ?? 1,
                    'price' => (float)$bid->amount,
                    'unit' => $crop->unit ?? 'kg'
                ]
            ],
            'total_price' => (float)$bid->amount * (float)($crop->quantity ?? 1),
            'status' => 'processing',
            'payment_status' => 'unpaid'
        ]);

        // Create a Logistics record automatically
        \App\Models\Logistics::create([
            'farmer_id' => \Auth::id(),
            'buyer_id' => $bid->buyer_id,
            'order_id' => (string)$order->id,
            'crop_id' => $bid->crop_id,
            'crop_name' => $crop->name ?? 'Crop',
            'quantity' => $crop->quantity ?? 1,
            'unit' => $crop->unit ?? 'kg',
            'buyer_name' => $buyer->name ?? 'Buyer',
            'status' => 'Pending Pickup',
            'provider' => 'Kisan Logistics',
            'tracking_number' => 'FD-' . rand(100, 999),
            'delivery_otp' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT), // Generate 6 digit OTP
            'otp_verified' => false,
            'history' => [
                [
                    'status' => 'Pending Pickup',
                    'timestamp' => now()->toIso8601String(),
                    'location' => 'System',
                    'description' => 'Farmer has accepted the order and is preparing for pickup.',
                ]
            ],
        ]);

        // Create a Chat record
        \App\Models\Chat::create([
            'participants' => [\Auth::id(), $bid->buyer_id],
            'product_id' => $bid->crop_id
        ]);

        // Create a notification for the farmer
        \App\Models\Notification::create([
            'user_id' => \Auth::id(),
            'type' => 'order',
            'title' => 'Bid Accepted',
            'message' => 'You have accepted a bid for ' . ($crop->name ?? 'crop') . '. Order and logistics tracking created.',
            'is_read' => false,
            'created_at' => now(),
            'data' => ['url' => route('farmer.dashboard')]
        ]);

        // Create a notification for the buyer
        \App\Models\Notification::create([
            'user_id' => $bid->buyer_id,
            'type' => 'success',
            'title' => 'Bid Accepted! 🎉',
            'message' => 'Your bid of ₹' . $bid->amount . ' for ' . ($crop->name ?? 'crop') . ' has been accepted by the farmer!',
            'is_read' => false,
            'created_at' => now(),
            'data' => ['url' => route('buyer.logistics')]
        ]);

        return response()->json(['success' => true]);
    }

    public function rejectBid($id)
    {
        $bid = \App\Models\Bid::findOrFail($id);
        $bid->update(['status' => 'rejected']);

        // Create a notification for the farmer
        \App\Models\Notification::create([
            'user_id' => \Auth::id(),
            'type' => 'order',
            'title' => 'Bid Rejected',
            'message' => 'You have rejected a bid for ' . ($bid->crop->name ?? 'crop') . '.',
            'is_read' => false,
            'created_at' => now(),
            'data' => ['url' => route('farmer.bids')]
        ]);

        // Create a notification for the buyer
        \App\Models\Notification::create([
            'user_id' => $bid->buyer_id,
            'type' => 'error',
            'title' => 'Bid Rejected',
            'message' => 'Your bid for ' . ($bid->crop->name ?? 'crop') . ' was declined by the farmer.',
            'is_read' => false,
            'created_at' => now(),
            'data' => ['url' => route('buyer.orders')]
        ]);

        return response()->json(['success' => true]);
    }

    public function negotiateBid(\Illuminate\Http\Request $request, $id)
    {
        $bid = \App\Models\Bid::findOrFail($id);
        $bid->update([
            'status' => 'negotiating',
            'counter_amount' => $request->counter_amount,
            'message' => $request->message
        ]);
        return response()->json(['success' => true]);
    }

    public function clearRejectedBids()
    {
        $user = \Auth::user();
        $cropIds = \App\Models\Crop::where('farmer_id', $user->id)->pluck('_id')->toArray();
        \App\Models\Bid::whereIn('crop_id', $cropIds)->where('status', 'rejected')->delete();
        return response()->json(['success' => true]);
    }

    public function activeOrders()
    {
        $user = \Auth::user();
        $orders = \App\Models\Order::where('farmer_id', $user->id)
                    ->whereIn('status', ['pending', 'processing'])
                    ->orderBy('created_at', 'desc')
                    ->get();
        // Eager load buyer for each order
        foreach ($orders as $order) {
            $order->buyer;
        }
        return view('dashboard.farmer_orders', compact('user', 'orders'));
    }

    public function acceptOrder(Request $request, $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->update([
            'status' => 'processing',
            'estimated_delivery' => $request->delivery_date ?? now()->addDays(3)->format('Y-m-d')
        ]);
        
        // Update the corresponding Logistics entry
        $logistics = \App\Models\Logistics::where('order_id', (string)$order->id)->first();
        if (!$logistics) {
            // fallback – match by first item + buyer
            $firstItem = $order->items[0] ?? null;
            if ($firstItem) {
                $logistics = \App\Models\Logistics::where('crop_id', $firstItem['crop_id'])
                                ->where('buyer_id', (string)$order->buyer_id)->first();
            }
        }
        if ($logistics) {
            $logistics->update([
                'status' => 'Pending Pickup',
                'eta' => $request->delivery_date ? \Carbon\Carbon::parse($request->delivery_date)->format('D, d M Y') : now()->addDays(3)->format('D, d M Y')
            ]);
        }

        // Notify buyer
        \App\Models\Notification::create([
            'user_id'    => $order->buyer_id,
            'type'       => 'order',
            'title'      => 'Order Accepted! 🚛',
            'message'    => "Your order #{$order->order_number} has been accepted by the farmer and is being prepared for pickup.",
            'is_read'    => false,
            'created_at' => now(),
            'data'       => ['url' => route('buyer.logistics')],
        ]);
        
        return back()->with('success', 'Order #' . $order->order_number . ' accepted and ready for pickup!');
    }

    public function rejectOrder($id)
    {
        $order = \App\Models\Order::findOrFail($id);
        
        // Restore crop quantities
        if (!empty($order->items)) {
            foreach ($order->items as $item) {
                if (isset($item['crop_id'])) {
                    $crop = \App\Models\Crop::find($item['crop_id']);
                    if ($crop) {
                        $crop->increment('quantity', $item['quantity']);
                    }
                }
            }
        }

        $order->update(['status' => 'cancelled']);
        
        // Update logistics
        $logistics = \App\Models\Logistics::where('order_id', (string)$order->id)->first();
        if (!$logistics) {
            $firstItem = $order->items[0] ?? null;
            if ($firstItem) {
                $logistics = \App\Models\Logistics::where('crop_id', $firstItem['crop_id'])
                                ->where('buyer_id', (string)$order->buyer_id)->first();
            }
        }
        if ($logistics) {
            $logistics->update([
                'status' => 'Cancelled',
                'history' => array_merge($logistics->history ?? [], [[
                    'status' => 'Cancelled',
                    'timestamp' => now()->toIso8601String(),
                    'location' => 'Farmer Location',
                    'description' => 'Order rejected and cancelled by farmer. Inventory restored.'
                ]])
            ]);
        }

        // Refund crop quantities
        foreach ($order->items ?? [] as $item) {
            $crop = \App\Models\Crop::find($item['crop_id']);
            if ($crop) {
                $crop->increment('quantity', (float)$item['quantity']);
            }
        }

        // Notify buyer
        \App\Models\Notification::create([
            'user_id'    => $order->buyer_id,
            'type'       => 'order',
            'title'      => 'Order Declined ❌',
            'message'    => "Your order #{$order->order_number} was declined by the farmer. Your account will be refunded.",
            'is_read'    => false,
            'created_at' => now(),
            'data'       => ['url' => route('buyer.orders')],
        ]);
        
        return back()->with('success', 'Order rejected and buyer notified.');
    }
    public function getStats()
    {
        $user = auth()->user();
        
        $revenue = Order::where('farmer_id', (string)$user->id)
                        ->whereIn('status', ['completed', 'processing', 'delivered'])
                        ->sum('total_price');
                        
        $activeOrdersCount = Order::where('farmer_id', (string)$user->id)
                                 ->whereIn('status', ['pending', 'processing', 'accepted', 'dispatched', 'in_transit'])
                                 ->count();
                                 
        // Fetch 3 Mandi Prices for widget
        $mandiPrices = \Illuminate\Support\Facades\Cache::get("mandi_prices");
        if (!$mandiPrices || !is_array($mandiPrices)) {
            $mandiPrices = $this->fetchLiveMandiPrices();
            \Illuminate\Support\Facades\Cache::put("mandi_prices", $mandiPrices, 14400);
        }
        
        // Fetch recent logistics
        $logistics = \App\Models\Logistics::where('farmer_id', (string)$user->id)
                        ->orderBy('created_at', 'desc')
                        ->limit(3)
                        ->get();
        
        return response()->json([
            'revenue' => number_format($revenue, 0),
            'activeOrdersCount' => (int)$activeOrdersCount,
            'mandiPrices' => $mandiPrices,
            'logistics' => $logistics
        ]);
    }
}
