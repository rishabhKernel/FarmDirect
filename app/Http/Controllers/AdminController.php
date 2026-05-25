<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Crop;
use App\Models\Order;
use App\Models\Bid;
use App\Models\Logistics;
use App\Models\MandiPrice;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Admin Dashboard — Main index view with all aggregated platform data.
     */
    public function index()
    {
        $admin = Auth::user();

        // Guard: only admin role can access
        if ($admin->role !== 'admin') {
            return redirect('/login')->withErrors(['email' => 'Unauthorized access.']);
        }

        // ─── Platform Metrics ─────────────────────────────────────────
        $totalFarmers     = User::where('role', 'farmer')->count();
        $totalBuyers      = User::where('role', 'buyer')->count();
        $suspendedFarmers = User::where('role', 'farmer')->where('is_suspended', true)->count();
        $suspendedBuyers  = User::where('role', 'buyer')->where('is_suspended', true)->count();

        $totalOrders      = Order::count();
        $completedOrders  = Order::where('status', 'completed')->count();
        $pendingOrders    = Order::whereIn('status', ['pending', 'processing'])->count();

        // Total Revenue from completed orders
        $totalRevenue = Order::where('status', 'completed')->sum('total_price') ?? 0;

        // Active Logistics Pipelines
        $activeLogistics = Logistics::whereNotIn('status', ['Delivered'])->count();
        $deliveredCount  = Logistics::where('status', 'Delivered')->count();

        // Bid Analytics
        $totalBids    = Bid::count();
        $acceptedBids = Bid::where('status', 'accepted')->count();
        $pendingBids  = Bid::where('status', 'pending')->count();
        $bidConversion = $totalBids > 0 ? round(($acceptedBids / $totalBids) * 100, 1) : 0;

        // Active Crop Listings
        $totalCrops   = Crop::count();
        $activeCrops  = Crop::where('status', 'active')->count();

        // ─── Directory Data ────────────────────────────────────────────
        $farmers = User::where('role', 'farmer')
                       ->orderBy('created_at', 'desc')
                       ->get()
                       ->map(function ($farmer) {
                           $farmer->crop_count = Crop::where('farmer_id', (string)$farmer->id)->count();
                           $farmer->total_sales = Order::where('farmer_id', (string)$farmer->id)
                                                       ->where('status', 'completed')
                                                       ->sum('total_price') ?? 0;
                           $farmer->active_orders = Order::where('farmer_id', (string)$farmer->id)
                                                         ->whereIn('status', ['pending', 'processing'])
                                                         ->count();
                           $farmer->crops_list = Crop::where('farmer_id', (string)$farmer->id)->orderBy('created_at', 'desc')->get();
                           $farmer->orders_list = Order::where('farmer_id', (string)$farmer->id)
                                                       ->orderBy('created_at', 'desc')
                                                       ->get()
                                                       ->map(function($order) {
                                                           $order->crop = Crop::find((string)$order->crop_id);
                                                           $order->buyer = User::find((string)$order->buyer_id);
                                                           return $order;
                                                       });
                            
                            $farmerBids = Bid::where('farmer_id', (string)$farmer->id)->get();
                            if ($farmerBids->isEmpty()) {
                                $farmerBids = Bid::all()->filter(function($bid) use ($farmer) {
                                    $crop = Crop::find((string)$bid->crop_id);
                                    return $crop && (string)$crop->farmer_id === (string)$farmer->id;
                                })->values();
                            }
                            $farmer->bids_list = $farmerBids->map(function($bid) {
                                $bid->crop = Crop::find((string)$bid->crop_id);
                                $bid->buyer = User::find((string)$bid->buyer_id);
                                return $bid;
                            });
                            return $farmer;
                       });

        $buyers = User::where('role', 'buyer')
                      ->orderBy('created_at', 'desc')
                      ->get()
                      ->map(function ($buyer) {
                          $buyer->total_purchases = Order::where('buyer_id', (string)$buyer->id)
                                                        ->where('status', 'completed')
                                                        ->sum('total_price') ?? 0;
                          $buyer->active_orders = Order::where('buyer_id', (string)$buyer->id)
                                                       ->whereIn('status', ['pending', 'processing'])
                                                       ->count();
                          $buyer->total_order_count = Order::where('buyer_id', (string)$buyer->id)->count();
                          $buyer->orders_list = Order::where('buyer_id', (string)$buyer->id)
                                                     ->orderBy('created_at', 'desc')
                                                     ->get()
                                                     ->map(function($order) {
                                                         $order->crop = Crop::find((string)$order->crop_id);
                                                         $order->farmer = User::find((string)$order->farmer_id);
                                                         return $order;
                                                     });
                          $buyer->bids_list = Bid::where('buyer_id', (string)$buyer->id)
                                                 ->orderBy('created_at', 'desc')
                                                 ->get()
                                                 ->map(function($bid) {
                                                     $bid->crop = Crop::find((string)$bid->crop_id);
                                                     $farmerId = $bid->farmer_id ?? ($bid->crop->farmer_id ?? null);
                                                     $bid->farmer = User::find((string)$farmerId);
                                                     return $bid;
                                                 });
                          return $buyer;
                      });

        // ─── All Crops (Platform Wide) ─────────────────────────────────
        $allCrops = Crop::orderBy('created_at', 'desc')->get()->map(function($crop) {
            $crop->farmer = User::find((string)$crop->farmer_id);
            return $crop;
        });

        // ─── Live Bids ─────────────────────────────────────────────────
        $liveBids = Bid::whereIn('status', ['pending', 'negotiated'])
                       ->orderBy('created_at', 'desc')
                       ->limit(10)
                       ->get()
                       ->map(function ($bid) {
                           $bid->crop   = Crop::find((string)$bid->crop_id);
                           $bid->buyer  = User::find((string)$bid->buyer_id);
                           $farmerId    = $bid->farmer_id ?? ($bid->crop->farmer_id ?? null);
                           $bid->farmer = User::find((string)$farmerId);
                           return $bid;
                       });

        // ─── Active Logistics ──────────────────────────────────────────
        $activeShipments = Logistics::whereNotIn('status', ['Delivered'])
                                    ->orderBy('created_at', 'desc')
                                    ->limit(8)
                                    ->get()
                                    ->map(function ($shipment) {
                                        $shipment->order  = Order::find($shipment->order_id);
                                        $shipment->farmer = $shipment->order ? User::find($shipment->order->farmer_id) : null;
                                        $shipment->buyer  = $shipment->order ? User::find($shipment->order->buyer_id) : null;
                                        return $shipment;
                                    });

        // ─── Mandi Prices ──────────────────────────────────────────────
        $mandiPrices = MandiPrice::limit(8)->get();

        // ─── Recent Notifications (platform-wide) ──────────────────────
        $recentNotifications = Notification::orderBy('created_at', 'desc')
                                           ->limit(10)
                                           ->get();

        // ─── Pending Verifications ─────────────────────────────────────
        $pendingVerifications = User::where('role', 'farmer')
                                    ->where(function ($q) {
                                        $q->where('is_verified', '!=', true)
                                          ->orWhereNull('is_verified');
                                    })
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get();

        $hour = now()->hour;
        if ($hour < 12) {
            $greeting = 'Good morning';
        } elseif ($hour < 17) {
            $greeting = 'Good afternoon';
        } else {
            $greeting = 'Good evening';
        }
        
        $weather = \Illuminate\Support\Facades\Cache::remember("weather_admin", 3600, function() {
            return $this->getWeather('Delhi');
        });

        // Generate chart data (last 7 days of procurement revenue)
        $revenueData = [0, 0, 0, 0, 0, 0, 0];
        $chartOrders = Order::whereIn('status', ['completed', 'processing'])
                        ->where('created_at', '>=', now()->subDays(7))
                        ->get();
        
        foreach ($chartOrders as $order) {
            if ($order->created_at) {
                $dayIndex = $order->created_at->format('N') - 1; // 0 for Mon, 6 for Sun
                if ($dayIndex >= 0 && $dayIndex < 7) {
                    $revenueData[$dayIndex] += $order->total_price;
                }
            }
        }

        return view('dashboard.admin', compact(
            'admin',
            'totalFarmers', 'totalBuyers', 'suspendedFarmers', 'suspendedBuyers',
            'totalOrders', 'completedOrders', 'pendingOrders', 'totalRevenue',
            'activeLogistics', 'deliveredCount',
            'totalBids', 'acceptedBids', 'pendingBids', 'bidConversion',
            'totalCrops', 'activeCrops',
            'farmers', 'buyers', 'liveBids', 'activeShipments',
            'mandiPrices', 'recentNotifications', 'pendingVerifications', 'allCrops',
            'greeting', 'weather', 'revenueData'
        ));
    }

    private function getWeather($city)
    {
        try {
            $geoResponse = \Illuminate\Support\Facades\Http::get("https://geocoding-api.open-meteo.com/v1/search", [
                'name' => $city,
                'count' => 1,
                'language' => 'en',
                'format' => 'json'
            ]);

            if ($geoResponse->successful() && isset($geoResponse['results'][0])) {
                $lat = $geoResponse['results'][0]['latitude'];
                $lon = $geoResponse['results'][0]['longitude'];

                $weatherResponse = \Illuminate\Support\Facades\Http::get("https://api.open-meteo.com/v1/forecast", [
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
            \Illuminate\Support\Facades\Log::error("Weather fetch failed: " . $e->getMessage());
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

    /**
     * Suspend a user account.
     */
    public function suspendUser($id)
    {
        $admin = Auth::user();
        if ($admin->role !== 'admin') {
            return redirect('/login');
        }

        $user = User::findOrFail($id);

        // Cannot suspend admin accounts
        if ($user->role === 'admin') {
            return back()->with('error', 'Cannot suspend admin accounts.');
        }

        $user->is_suspended = true;
        $user->save();

        // Create a notification for the suspended user
        Notification::create([
            'user_id' => (string)$user->id,
            'type'    => 'account_suspended',
            'title'   => 'Account Suspended',
            'message' => 'Your account has been suspended by the platform administrator. Please contact support for assistance.',
            'is_read' => false,
        ]);

        return back()->with('success', "Account for {$user->name} ({$user->role}) has been suspended.");
    }

    /**
     * Release (unsuspend) a user account.
     */
    public function releaseUser($id)
    {
        $admin = Auth::user();
        if ($admin->role !== 'admin') {
            return redirect('/login');
        }

        $user = User::findOrFail($id);

        $user->is_suspended = false;
        $user->save();

        // Create a notification for the released user
        Notification::create([
            'user_id' => (string)$user->id,
            'type'    => 'account_released',
            'title'   => 'Account Restored',
            'message' => 'Your account has been restored by the platform administrator. You can now log in and use FarmDirect.',
            'is_read' => false,
        ]);

        return back()->with('success', "Account for {$user->name} ({$user->role}) has been restored.");
    }

    /**
     * Verify a farmer account.
     */
    public function verifyFarmer($id)
    {
        $admin = Auth::user();
        if ($admin->role !== 'admin') {
            return redirect('/login');
        }

        $user = User::findOrFail($id);
        $user->is_verified = true;
        $user->save();

        Notification::create([
            'user_id' => (string)$user->id,
            'type'    => 'verification_approved',
            'title'   => 'Organic Certification Approved! 🌾',
            'message' => 'Congratulations! Your farm organic certification has been verified by the administrator.',
            'is_read' => false,
        ]);

        return back()->with('success', "Farmer {$user->name} has been verified and certified successfully!");
    }

    /**
     * Flag/Reject verification and suspend farmer account.
     */
    public function flagFarmer($id)
    {
        $admin = Auth::user();
        if ($admin->role !== 'admin') {
            return redirect('/login');
        }

        $user = User::findOrFail($id);
        $user->is_verified = false;
        $user->is_suspended = true;
        $user->save();

        Notification::create([
            'user_id' => (string)$user->id,
            'type'    => 'verification_flagged',
            'title'   => 'Verification Flagged & Suspended ⚠️',
            'message' => 'Your organic credentials could not be verified and your account has been temporarily suspended.',
            'is_read' => false,
        ]);

        return back()->with('error', "Farmer {$user->name} has been flagged and suspended due to verification failure.");
    }

    /**
     * Assign carrier to a shipment.
     */
    public function assignLogistics(Request $request, $id)
    {
        $admin = Auth::user();
        if ($admin->role !== 'admin') {
            return redirect('/login');
        }

        $request->validate([
            'provider' => 'required|string',
            'tracking_number' => 'required|string',
        ]);

        $shipment = Logistics::findOrFail($id);
        $shipment->provider = $request->provider;
        $shipment->tracking_number = $request->tracking_number;
        $shipment->status = 'Dispatched';

        // Append to history
        $history = $shipment->history ?? [];
        $history[] = [
            'status'      => 'Dispatched',
            'timestamp'   => now()->toIso8601String(),
            'location'    => $shipment->pickup_address ?? 'Central Hub',
            'description' => "Admin assigned transport partner: {$request->provider} (Tracking ID: {$request->tracking_number})",
        ];
        $shipment->history = $history;
        $shipment->save();

        // Notify both farmer and buyer
        Notification::create([
            'user_id' => $shipment->farmer_id,
            'type'    => 'order',
            'title'   => 'Logistics Partner Assigned 🚚',
            'message' => "Admin has assigned {$request->provider} for shipment #{$shipment->tracking_number}.",
            'is_read' => false,
        ]);

        Notification::create([
            'user_id' => $shipment->buyer_id,
            'type'    => 'order',
            'title'   => 'Order Dispatched 🚚',
            'message' => "Your order for {$shipment->crop_name} has been dispatched via {$request->provider}.",
            'is_read' => false,
        ]);

        return back()->with('success', "Logistics partner assigned successfully to shipment.");
    }

    /**
     * Override OTP verification and deliver shipment immediately.
     */
    public function otpOverride($id)
    {
        $admin = Auth::user();
        if ($admin->role !== 'admin') {
            return redirect('/login');
        }

        $shipment = Logistics::findOrFail($id);
        $shipment->status = 'Delivered';
        $shipment->otp_verified = true;

        // Append to history
        $history = $shipment->history ?? [];
        $history[] = [
            'status'      => 'Delivered',
            'timestamp'   => now()->toIso8601String(),
            'location'    => $shipment->delivery_address ?? 'Delivery Address',
            'description' => 'OTP verification bypassed and overridden by platform administrator.',
        ];
        $shipment->history = $history;
        $shipment->save();

        // Sync order status
        if ($shipment->order_id) {
            Order::where('_id', $shipment->order_id)->update(['status' => 'completed']);
        }

        // Notify farmer and buyer
        Notification::create([
            'user_id' => $shipment->farmer_id,
            'type'    => 'order',
            'title'   => 'Delivery Bypassed & Completed 🎉',
            'message' => "Shipment for {$shipment->crop_name} was marked delivered via admin OTP override.",
            'is_read' => false,
        ]);

        Notification::create([
            'user_id' => $shipment->buyer_id,
            'type'    => 'order',
            'title'   => 'Order Delivered (Admin Override) 🎉',
            'message' => "Your order for {$shipment->crop_name} was completed via admin OTP override.",
            'is_read' => false,
        ]);

        return back()->with('success', "OTP verification successfully overridden. Shipment marked as Delivered.");
    }

    /**
     * JSON API endpoint for real-time polling of admin stats.
     */
    public function getStats()
    {
        $admin = Auth::user();
        if (!$admin || $admin->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $totalBids = Bid::count();
        $acceptedBids = Bid::where('status', 'accepted')->count();
        $bidConversion = $totalBids > 0 ? round(($acceptedBids / $totalBids) * 100, 1) : 0;

        // Generate chart data (last 7 days of procurement revenue)
        $revenueData = [0, 0, 0, 0, 0, 0, 0];
        $chartOrders = Order::whereIn('status', ['completed', 'processing'])
                        ->where('created_at', '>=', now()->subDays(7))
                        ->get();
        
        foreach ($chartOrders as $order) {
            if ($order->created_at) {
                $dayIndex = $order->created_at->format('N') - 1; // 0 for Mon, 6 for Sun
                if ($dayIndex >= 0 && $dayIndex < 7) {
                    $revenueData[$dayIndex] += $order->total_price;
                }
            }
        }

        return response()->json([
            'success'          => true,
            'total_farmers'    => User::where('role', 'farmer')->count(),
            'total_buyers'     => User::where('role', 'buyer')->count(),
            'suspended_farmers'=> User::where('role', 'farmer')->where('is_suspended', true)->count(),
            'suspended_buyers' => User::where('role', 'buyer')->where('is_suspended', true)->count(),
            'total_orders'     => Order::count(),
            'pending_orders'   => Order::whereIn('status', ['pending', 'processing'])->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'total_revenue'    => Order::where('status', 'completed')->sum('total_price') ?? 0,
            'active_logistics' => Logistics::whereNotIn('status', ['Delivered'])->count(),
            'total_bids'       => $totalBids,
            'accepted_bids'    => $acceptedBids,
            'pending_bids'     => Bid::where('status', 'pending')->count(),
            'bid_conversion'   => $bidConversion,
            'active_crops'     => Crop::where('status', 'active')->count(),
            'mandi_prices'     => MandiPrice::limit(8)->get(),
            'revenue_data'     => $revenueData,
        ]);
    }
}
