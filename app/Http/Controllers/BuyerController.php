<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BuyerController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Fetch all available crops
        $query = Crop::where('status', 'active');
        
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

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('region')) {
            $query->whereHas('farmer', function($q) use ($request) {
                $q->where('state', 'like', '%' . $request->region . '%');
            });
        }
        
        $crops = $query->with('farmer')->latest()->get();
        
        // Fetch active orders for the buyer
        $activeOrders = Order::where('buyer_id', $user->id)
                             ->whereIn('status', ['pending', 'processing', 'in_transit'])
                             ->with(['farmer'])
                             ->get();

        // Fetch active bids for the buyer
        $activeBids = \App\Models\Bid::where('buyer_id', $user->id)
                             ->where('status', 'pending')
                             ->with(['crop'])
                             ->get();

        // Dynamic Trends for Buyer (based on available crops)
        $trends = \Illuminate\Support\Facades\Cache::remember('buyer_trends', 3600, function() use ($crops) {
            $topCrops = $crops->take(3);
            if ($topCrops->isEmpty()) {
                return [
                    ['name' => 'Basmati Rice', 'surge' => '12%', 'direction' => 'up'],
                    ['name' => 'Organic Wheat', 'surge' => '8%', 'direction' => 'up'],
                    ['name' => 'Kashmiri Saffron', 'surge' => '5%', 'direction' => 'stable'],
                ];
            }
            return $topCrops->map(function($c) {
                $surge = rand(3, 15);
                return [
                    'name' => $c->name,
                    'surge' => "{$surge}%",
                    'direction' => rand(0, 1) ? 'up' : 'stable'
                ];
            })->toArray();
        });

        // Fetch Weather Data (Cached for 1 hour)
        $weather = \Illuminate\Support\Facades\Cache::remember("weather_{$user->city}", 3600, function() use ($user) {
            return $this->getWeather($user->city ?? 'Delhi');
        });

        // Fetch Total Procurement (sum of all placed orders)
        $totalProcurement = Order::where('buyer_id', $user->id)
                             ->where('status', '!=', 'cancelled')
                             ->sum('total_price');

        // Generate chart data (last 7 days of spending)
        $spendingData = [0, 0, 0, 0, 0, 0, 0];
        $chartOrders = Order::where('buyer_id', $user->id)
                        ->where('status', '!=', 'cancelled')
                        ->where('created_at', '>=', now()->subDays(7))
                        ->get();
        
        foreach ($chartOrders as $order) {
            $dayIndex = $order->created_at->format('N') - 1; // 0 for Mon, 6 for Sun
            if ($dayIndex >= 0 && $dayIndex < 7) {
                $spendingData[$dayIndex] += $order->total_price;
            }
        }

        // Fetch recent orders (active + completed) for the side widget
        $recentOrders = Order::where('buyer_id', $user->id)
                             ->whereIn('status', ['pending', 'processing', 'accepted', 'dispatched', 'in_transit', 'delivered', 'completed'])
                             ->with(['farmer'])
                             ->orderBy('updated_at', 'desc')
                             ->limit(3)
                             ->get();

        // Restore active logistics for the hero widget
        $activeLogistics = \App\Models\Logistics::where('buyer_id', $user->id)
                             ->where('status', '!=', 'Delivered')
                             ->orderBy('created_at', 'desc')
                             ->first();

        return view('dashboard.buyer', compact('user', 'crops', 'activeOrders', 'activeBids', 'trends', 'weather', 'totalProcurement', 'recentOrders', 'spendingData', 'activeLogistics'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }
        
        $buyer = Auth::user();
        $orderNumbers = [];
        
        // Group items by farmer
        $itemsByFarmer = [];
        foreach ($cart as $id => $item) {
            if (($item['quantity'] ?? 0) < 15) {
                return back()->with('error', "Your order for {$item['name']} is below the 15kg minimum. Please increase the quantity.");
            }
            $crop = Crop::find($id);
            if (!$crop) continue;
            
            if ($crop->quantity < $item['quantity']) {
                return back()->with('error', 'Insufficient stock for ' . $item['name']);
            }
            
            $farmerId = $crop->farmer_id;
            if (!isset($itemsByFarmer[$farmerId])) {
                $itemsByFarmer[$farmerId] = [
                    'farmer' => $crop->farmer,
                    'items' => [],
                    'total_price' => 0,
                ];
            }
            $itemsByFarmer[$farmerId]['items'][] = [
                'crop_id' => $crop->id,
                'name' => $crop->name,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'unit' => $crop->unit ?? 'kg',
            ];
            $itemsByFarmer[$farmerId]['total_price'] += $item['price'] * $item['quantity'];
            
            // Update crop quantity
            $crop->decrement('quantity', $item['quantity']);
        }
        
        foreach ($itemsByFarmer as $farmerId => $farmerData) {
            // Check if there's an existing pending order for this farmer and buyer
            $existingOrder = Order::where('buyer_id', (string)$buyer->id)
                                 ->where('farmer_id', (string)$farmerId)
                                 ->where('status', 'pending')
                                 ->first();

            if ($existingOrder) {
                // Merge items into existing order
                $currentItems = $existingOrder->items;
                foreach ($farmerData['items'] as $newItem) {
                    $found = false;
                    foreach ($currentItems as &$existingItem) {
                        if ($existingItem['crop_id'] === $newItem['crop_id']) {
                            $existingItem['quantity'] += $newItem['quantity'];
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        $currentItems[] = $newItem;
                    }
                }
                
                $existingOrder->items = $currentItems;
                $existingOrder->total_price += $farmerData['total_price'];
                $existingOrder->save();
                
                // Update Logistics record
                $logistics = \App\Models\Logistics::where('order_id', $existingOrder->id)->first();
                if ($logistics) {
                    $logistics->update([
                        'crop_name' => count($currentItems) > 1 ? count($currentItems) . ' Items' : $currentItems[0]['name'],
                        'quantity'  => collect($currentItems)->sum('quantity'),
                        'unit'      => count($currentItems) > 1 ? 'Units' : $currentItems[0]['unit'],
                    ]);
                }
                
                $orderNumbers[] = $existingOrder->order_number;
                continue; // Skip creating a new order
            }

            $orderNumber = 'ORD-' . strtoupper(uniqid());
            $trackingNumber = 'TRK-' . strtoupper(substr(uniqid(), -8));
            $deliveryOtp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $order = Order::create([
                'order_number'   => $orderNumber,
                'farmer_id'      => (string)$farmerId,
                'buyer_id'       => (string)$buyer->id,
                'items'          => $farmerData['items'],
                'total_price'    => $farmerData['total_price'],
                'status'         => 'pending',
                'payment_status' => 'paid',
                'tracking_number'=> $trackingNumber,
            ]);
            
            // Automatically create a Logistics entry so the buyer can track
            \App\Models\Logistics::create([
                'farmer_id'        => (string)$farmerId,
                'buyer_id'         => (string)$buyer->id,
                'order_id'         => (string)$order->id,
                'crop_id'          => null, // Since it's grouped, we don't have a single crop_id
                'crop_name'        => count($farmerData['items']) > 1 ? count($farmerData['items']) . ' Items' : $farmerData['items'][0]['name'],
                'quantity'         => count($farmerData['items']) > 1 ? collect($farmerData['items'])->sum('quantity') : $farmerData['items'][0]['quantity'],
                'unit'             => count($farmerData['items']) > 1 ? 'Units' : $farmerData['items'][0]['unit'],
                'buyer_name'       => $buyer->name,
                'farmer_name'      => $farmerData['farmer']->name ?? 'Farmer',
                'tracking_number'  => $trackingNumber,
                'status'           => 'Pending Pickup',
                'provider'         => 'FarmDirect Express',
                'delivery_otp'     => $deliveryOtp,
                'otp_verified'     => false,
                'pickup_address'   => $farmerData['farmer']->city ?? 'Farm Location',
                'delivery_address' => $buyer->city ?? 'Buyer Address',
                'eta'              => now()->addDays(3)->format('D, d M Y'),
                'history'          => [
                    [
                        'status' => 'Pending Pickup',
                        'timestamp' => now()->toIso8601String(),
                        'location' => 'System',
                        'description' => 'Order has been successfully placed by buyer.',
                    ]
                ],
            ]);

            // Notify the farmer
            $itemCount = count($farmerData['items']);
            $cropNames = collect($farmerData['items'])->pluck('name')->implode(', ');
            \App\Models\Notification::create([
                'user_id'    => $farmerId,
                'type'       => 'order',
                'title'      => 'New Order Received! 🎉',
                'message'    => "You have a new order containing {$itemCount} item(s) ({$cropNames}) from {$buyer->name}. Order #{$orderNumber}",
                'is_read'    => false,
                'created_at' => now(),
                'data'       => ['url' => route('farmer.dashboard')],
            ]);
            
            // Notify the buyer (Real-time)
            \App\Models\Notification::create([
                'user_id' => $buyer->id,
                'type' => 'success',
                'title' => 'Order Placed! 📦',
                'message' => "Order #{$orderNumber} for {$itemCount} item(s) has been placed successfully.",
                'is_read' => false,
                'created_at' => now(),
                'data' => ['url' => route('buyer.logistics')]
            ]);
            
            $orderNumbers[] = $orderNumber;
        }
        
        // Clear cart
        session()->forget('cart');
        
        Log::info('Order placement successful', ['order_numbers' => $orderNumbers]);
        
        return redirect()->route('buyer.orders')->with('success', 'Orders placed successfully! Order IDs: ' . implode(', ', $orderNumbers));
    }

    public function placeBid(Request $request)
    {
        $request->validate([
            'crop_id' => 'required',
            'amount' => 'required|numeric|min:1'
        ]);

        $crop = Crop::findOrFail($request->crop_id);

        $bid = \App\Models\Bid::create([
            'crop_id' => $crop->id,
            'buyer_id' => \Auth::id(),
            'farmer_id' => (string)$crop->farmer_id,
            'amount' => (float) $request->amount,
            'status' => 'pending',
            'message' => $request->message ?? 'Interested in buying.'
        ]);

        // Notify the farmer that a bid was placed
        \App\Models\Notification::create([
            'user_id' => $crop->farmer_id,
            'type' => 'bid',
            'title' => 'New Bid Received! 🔔',
            'message' => "You received a new bid of ₹{$bid->amount} for {$crop->name}.",
            'is_read' => false,
            'created_at' => now(),
            'data' => ['url' => route('farmer.bids')]
        ]);

        // Notify the buyer (feedback loop)
        \App\Models\Notification::create([
            'user_id' => \Auth::id(),
            'type' => 'success',
            'title' => 'Bid Placed successfully',
            'message' => "Your bid of ₹{$bid->amount} for {$crop->name} was placed.",
            'is_read' => false,
            'created_at' => now(),
            'data' => ['url' => route('buyer.dashboard')]
        ]);

        return back()->with('success', 'Bid placed successfully! Amount: ₹' . $bid->amount);
    }

    public function notifications()
    {
        $user = Auth::user();
        $notifications = \App\Models\Notification::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.buyer_notifications', compact('user', 'notifications'));
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

    public function discover(Request $request)
    {
        $user = Auth::user();
        
        $query = Crop::where('status', 'active')->with('farmer')->latest();
        
        if ($request->has('search') && $request->search != '') {
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
        
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }
        
        $crops = $query->get();
        
        $activeBids = \App\Models\Bid::where('buyer_id', $user->id)->where('status', 'pending')->get();
        
        return view('dashboard.discover', compact('user', 'crops', 'activeBids'));
    }

    public function bids()
    {
        $user = \Auth::user();
        $activeBids = \App\Models\Bid::where('buyer_id', $user->id)->get();
        return view('dashboard.buyer_bids', compact('user', 'activeBids'));
    }

    public function saved()
    {
        $user = \Auth::user();
        $savedIds = session()->get('saved_listings', []);
        $savedCrops = \App\Models\Crop::whereIn('_id', $savedIds)->with('farmer')->get();
        return view('dashboard.buyer_saved', compact('user', 'savedCrops'));
    }

    public function logistics()
    {
        $user = \Auth::user();
        
        // Primary: fetch by buyer_id
        $logistics = \App\Models\Logistics::where('buyer_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        // Fallback: if nothing found, find via order_ids for this buyer
        if ($logistics->isEmpty()) {
            $orderIds = \App\Models\Order::where('buyer_id', $user->id)
                            ->pluck('_id')->toArray();
            $logistics = \App\Models\Logistics::whereIn('order_id', $orderIds)
                            ->orderBy('created_at', 'desc')
                            ->get();
        }
        
        return view('dashboard.buyer_logistics', compact('user', 'logistics'));
    }

    public function orders()
    {
        $user = \Auth::user();
        
        // Fetch active bids
        $activeBids = \App\Models\Bid::where('buyer_id', $user->id)
                                     ->where('status', 'pending')
                                     ->with(['crop'])
                                     ->get();
                                     
        // Fetch active orders
        $activeOrders = \App\Models\Order::where('buyer_id', $user->id)
                             ->whereIn('status', ['pending', 'processing', 'in_transit'])
                             ->with(['farmer'])
                             ->orderBy('created_at', 'desc')
                             ->paginate(10, ['*'], 'active_page');
                             
        // Fetch order history
        $completedOrders = \App\Models\Order::where('buyer_id', $user->id)
                                ->whereIn('status', ['completed', 'delivered', 'cancelled'])
                                ->with(['farmer'])
                                ->orderBy('created_at', 'desc')
                                ->paginate(10, ['*'], 'completed_page');

        return view('dashboard.buyer_orders', compact('user', 'activeBids', 'activeOrders', 'completedOrders'));
    }

    public function myBids()
    {
        $user = \Auth::user();
        $bids = \App\Models\Bid::where('buyer_id', $user->id)
                    ->with(['crop.farmer'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
        return view('dashboard.buyer_bids', compact('user', 'bids'));
    }

    public function cancelOrder($id)
    {
        $user = \Auth::user();
        $order = \App\Models\Order::where('_id', $id)->where('buyer_id', $user->id)->firstOrFail();
        if ($order->status !== 'pending') {
            return back()->with('error', 'Only pending orders can be cancelled.');
        }
        $order->update(['status' => 'cancelled']);
        
        // Also cancel/remove associated logistics
        \App\Models\Logistics::where('order_id', $order->id)->delete();

        // Restore crop quantity
        foreach ($order->items ?? [] as $item) {
            $crop = \App\Models\Crop::find($item['crop_id'] ?? null);
            if ($crop) $crop->increment('quantity', $item['quantity'] ?? 0);
        }

        // Notify farmer
        \App\Models\Notification::create([
            'user_id' => $order->farmer_id,
            'type' => 'order',
            'title' => 'Order Cancelled',
            'message' => "Buyer {$user->name} cancelled Order #{$order->order_number}.",
            'is_read' => false,
            'created_at' => now(),
            'data' => ['url' => route('farmer.bids')]
        ]);

        return back()->with('success', 'Order cancelled successfully.');
    }

    public function downloadInvoice($id)
    {
        $user = \Auth::user();
        // Allow either the buyer or the farmer to access the invoice
        $order = \App\Models\Order::where('_id', $id)
                                 ->where(function($query) use ($user) {
                                     $query->where('buyer_id', $user->id)
                                           ->orWhere('farmer_id', $user->id);
                                 })
                                 ->firstOrFail();
        
        $buyer = \App\Models\User::find($order->buyer_id);
        $farmer = \App\Models\User::find($order->farmer_id);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', compact('order', 'buyer', 'farmer'));
        $pdf->setPaper('A4');
        return $pdf->download('FarmDirect-Invoice-' . $order->order_number . '.pdf');
    }

    public function account()
    {
        $user = \Auth::user();
        return view('dashboard.buyer_account', compact('user'));
    }

    public function updateAccountProfile(Request $request)
    {
        $user = \Auth::user();
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'nullable|string|max:20',
            'bio'       => 'nullable|string|max:500',
            'city'      => 'nullable|string|max:100',
            'profile_picture' => 'nullable|image|max:2048',
            'upi_id'    => 'nullable|string|max:255',
        ]);

        $user->fill(collect($validated)->except('profile_picture')->toArray());

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $user->profile_picture = $path;
        }

        $user->save();
        return back()->with('success', 'Profile updated successfully!');
    }

    public function updateAccountPassword(Request $request)
    {
        $user = \Auth::user();
        $request->validate([
            'current_password' => 'required|string',
            'password'         => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->mixedCase()->numbers()],
        ]);

        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Your current password is incorrect.');
        }

        $user->password = \Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }

    public function saveBank(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20',
            'ifsc_code' => 'required|string|max:20',
        ]);

        $accounts = $user->bank_accounts ?? [];
        $accounts[] = [
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,
            'is_primary' => empty($accounts)
        ];
        
        $user->bank_accounts = $accounts;
        $user->save();

        return back()->with('success', 'Bank account added successfully!');
    }

    public function updateBank(Request $request, $index)
    {
        $user = Auth::user();
        $accounts = $user->bank_accounts ?? [];
        
        if (!isset($accounts[$index])) {
            return back()->with('error', 'Bank account not found.');
        }
        
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20',
            'ifsc_code' => 'required|string|max:20',
        ]);
        
        $accounts[$index]['bank_name'] = $request->bank_name;
        $accounts[$index]['account_number'] = $request->account_number;
        $accounts[$index]['ifsc_code'] = $request->ifsc_code;
        
        $user->bank_accounts = $accounts;
        $user->save();
        
        return back()->with('success', 'Bank account updated successfully!');
    }

    public function saveCard(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'card_number' => 'required|string|max:19',
            'expiry_date' => 'required|string|max:5',
        ]);

        $cards = $user->cards ?? [];
        $cards[] = [
            'card_number' => $request->card_number,
            'expiry_date' => $request->expiry_date,
            'card_type' => str_starts_with($request->card_number, '4') ? 'VISA' : 'MASTERCARD'
        ];
        
        $user->cards = $cards;
        $user->save();

        return back()->with('success', 'Payment card added successfully!');
    }

    private function getWeather($city)
    {
        try {
            $geoResponse = Http::get("https://geocoding-api.open-meteo.com/v1/search", [
                'name' => $city,
                'count' => 1,
                'language' => 'en',
                'format' => 'json'
            ]);

            if ($geoResponse->successful() && isset($geoResponse['results'][0])) {
                $lat = $geoResponse['results'][0]['latitude'];
                $lon = $geoResponse['results'][0]['longitude'];

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

        return [
            'temp' => 28,
            'condition' => 'sunny',
            'city' => $city
        ];
    }

    private function getWeatherIcon($code)
    {
        if ($code == 0) return 'sunny';
        if ($code >= 1 && $code <= 3) return 'cloud';
        if ($code >= 45 && $code <= 48) return 'foggy';
        if ($code >= 51 && $code <= 67) return 'rainy';
        if ($code >= 71 && $code <= 77) return 'snowing';
        if ($code >= 80 && $code <= 82) return 'rainy_heavy';
        if ($code >= 95) return 'thunderstorm';
        return 'sunny';
    }

    // Cart & Checkout Methods
    public function addToCart(Request $request)
    {
        $crop = Crop::findOrFail($request->crop_id);
        $cart = session()->get('cart', []);

        // Enforce 15kg minimum quantity
        $requestedQuantity = $request->quantity ?? 1;
        if ($requestedQuantity < 15) {
            return back()->with('error', 'Minimum procurement quantity is 15kg. Farmers only fulfill bulk orders.');
        }

        // If crop already in cart, increment quantity
        if (isset($cart[$crop->id])) {
            $cart[$crop->id]['quantity'] += $requestedQuantity;
        } else {
            $cart[$crop->id] = [
                'name' => $crop->name,
                'price' => $crop->price_per_unit,
                'quantity' => $requestedQuantity,
                'unit' => $crop->unit,
                'image' => $crop->image_url
            ];
        }

        session()->put('cart', $cart);
        
        // Real-time Notification
        \App\Models\Notification::create([
            'user_id' => Auth::id(),
            'type' => 'success',
            'title' => 'Added to Cart! 🛒',
            'message' => "{$crop->name} has been added to your procurement cart.",
            'is_read' => false,
            'created_at' => now(),
            'data' => ['url' => route('checkout')]
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Added to cart!']);
        }

        return redirect()->back();
    }

    public function checkout()
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);
        
        return view('dashboard.checkout', compact('user', 'cart'));
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'crop_id' => 'required',
            'action' => 'required|in:increase,decrease'
        ]);

        $cart = session()->get('cart', []);
        $id = (string)$request->crop_id;

        if (isset($cart[$id])) {
            if ($request->action === 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($request->action === 'decrease') {
                if ($cart[$id]['quantity'] <= 15) {
                    return response()->json(['success' => false, 'message' => 'Minimum quantity is 15kg. You cannot decrease further.']);
                }
                $cart[$id]['quantity']--;
            }
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart: ' . $id]);
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'crop_id' => 'required'
        ]);

        $cart = session()->get('cart', []);
        $id = (string)$request->crop_id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart: ' . $id]);
    }

    public function toggleSaved(Request $request)
    {
        $cropId = $request->crop_id;
        $saved = session()->get('saved_listings', []);

        if (in_array($cropId, $saved)) {
            $saved = array_diff($saved, [$cropId]);
            $message = 'Removed from saved!';
        } else {
            $saved[] = $cropId;
            $message = 'Added to saved!';
        }

        session()->put('saved_listings', $saved);

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function getStats()
    {
        $user = auth()->user();
        
        $totalProcurement = Order::where('buyer_id', (string)$user->id)
                             ->where('status', '!=', 'cancelled')
                             ->sum('total_price');
                             
        $activeOrders = Order::where('buyer_id', (string)$user->id)
                             ->whereIn('status', ['pending', 'processing', 'accepted', 'dispatched', 'in_transit'])
                             ->with(['farmer'])
                             ->get();
                             
        $activeBidsCount = \App\Models\Bid::where('buyer_id', (string)$user->id)
                             ->where('status', 'pending')
                             ->count();
                             
        $activeLogistics = \App\Models\Logistics::where('buyer_id', (string)$user->id)
                             ->where('status', '!=', 'Delivered')
                             ->orderBy('created_at', 'desc')
                             ->first();

        // Spending data for chart (last 7 days)
        $spendingData = [0, 0, 0, 0, 0, 0, 0];
        $chartOrders = Order::where('buyer_id', (string)$user->id)
                        ->where('status', '!=', 'cancelled')
                        ->where('created_at', '>=', now()->subDays(7))
                        ->get();
        
        foreach ($chartOrders as $order) {
            $dayIndex = $order->created_at->format('N') - 1; // 0 for Mon, 6 for Sun
            if ($dayIndex >= 0 && $dayIndex < 7) {
                $spendingData[$dayIndex] += $order->total_price;
            }
        }
        
        // Recent orders for side widget
        $recentOrders = Order::where('buyer_id', (string)$user->id)
                             ->whereIn('status', ['pending', 'processing', 'accepted', 'dispatched', 'in_transit', 'delivered', 'completed'])
                             ->with(['farmer'])
                             ->orderBy('updated_at', 'desc')
                             ->limit(3)
                             ->get()
                             ->map(function($order) {
                                return [
                                    'order_number' => $order->order_number,
                                    'status' => $order->status,
                                    'updated_at' => $order->updated_at->format('M d, h:i A')
                                ];
                             });

        // Restore active logistics for hero widget polling
        $activeLogisticsRecord = \App\Models\Logistics::where('buyer_id', (string)$user->id)
                             ->where('status', '!=', 'Delivered')
                             ->orderBy('created_at', 'desc')
                             ->first();

        return response()->json([
            'totalProcurement' => number_format($totalProcurement, 2),
            'activeOrdersCount' => $activeOrders->count(),
            'activeBidsCount' => $activeBidsCount,
            'recentOrders' => $recentOrders,
            'activeLogistics' => $activeLogisticsRecord ? [
                'status' => $activeLogisticsRecord->status,
                'crop_name' => $activeLogisticsRecord->crop_name,
                'tracking_number' => $activeLogisticsRecord->tracking_number,
                'delivery_otp' => $activeLogisticsRecord->delivery_otp,
                'updated_at' => $activeLogisticsRecord->updated_at->format('h:i A')
            ] : null,
            'mandiPrices' => \App\Models\MandiPrice::limit(3)->get()->map(function($m) {
                return [
                    'crop_name' => $m->crop_name,
                    'price_per_q' => $m->price_per_q,
                    'category' => $m->category ?? 'General'
                ];
            }),
            'spendingData' => $spendingData,
            'activeOrders' => $activeOrders->map(function($order) {
                return [
                    'id' => (string)$order->id,
                    'order_number' => $order->order_number,
                    'total_price' => number_format($order->total_price),
                    'status' => $order->status,
                    'farmer_name' => $order->farmer ? $order->farmer->name : 'Unknown Farmer',
                    'item_name' => (!empty($order->items) && isset($order->items[0]['name'])) ? $order->items[0]['name'] : 'Order',
                    'item_count' => count($order->items ?? []),
                    'created_at' => $order->created_at->format('M d, h:i A')
                ];
            })
        ]);
    }
}
