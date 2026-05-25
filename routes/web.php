<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    $mandiPrices = \App\Models\MandiPrice::limit(6)->get();
    return view('welcome', compact('mandiPrices')); // Master Landing Page
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    // ─── Admin Portal ─────────────────────────────────────────────────────────
    Route::get('/dashboard/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/dashboard/admin/users/{id}/suspend', [App\Http\Controllers\AdminController::class, 'suspendUser'])->name('admin.suspend');
    Route::post('/dashboard/admin/users/{id}/release', [App\Http\Controllers\AdminController::class, 'releaseUser'])->name('admin.release');
    Route::post('/dashboard/admin/users/{id}/verify', [App\Http\Controllers\AdminController::class, 'verifyFarmer'])->name('admin.verify-user');
    Route::post('/dashboard/admin/users/{id}/flag', [App\Http\Controllers\AdminController::class, 'flagFarmer'])->name('admin.flag-user');
    Route::post('/dashboard/admin/logistics/{id}/assign', [App\Http\Controllers\AdminController::class, 'assignLogistics'])->name('admin.assign-logistics');
    Route::post('/dashboard/admin/logistics/{id}/otp-override', [App\Http\Controllers\AdminController::class, 'otpOverride'])->name('admin.otp-override');
    Route::get('/api/dashboard/admin/stats', [App\Http\Controllers\AdminController::class, 'getStats'])->name('admin.stats');

    Route::get('/dashboard/farmer', [App\Http\Controllers\FarmerController::class, 'index'])->name('farmer.dashboard');
    // Logistics
    Route::post('/dashboard/logistics/{id}/next-stage', [App\Http\Controllers\FarmerController::class, 'nextLogisticsStage'])->name('logistics.next-stage');
    Route::get('/dashboard/logistics', [App\Http\Controllers\LogisticsController::class, 'index'])->name('farmer.logistics');
    Route::post('/dashboard/logistics/{id}/advance', [App\Http\Controllers\LogisticsController::class, 'advanceStage'])->name('logistics.advance');
    // Mandi Prices
    Route::get('/dashboard/mandi', [App\Http\Controllers\LogisticsController::class, 'mandi'])->name('farmer.mandi');
    Route::get('/dashboard/farmer/crops', [App\Http\Controllers\FarmerController::class, 'crops'])->name('farmer.crops');
    Route::get('/api/notifications', [App\Http\Controllers\NotificationController::class, 'getNotifications'])->name('api.notifications');
    Route::post('/api/notifications/mark-notified', [App\Http\Controllers\NotificationController::class, 'markAsNotified']);
    Route::get('/api/dashboard/farmer/stats', [App\Http\Controllers\FarmerController::class, 'getStats']);
    Route::get('/api/dashboard/buyer/stats', [App\Http\Controllers\BuyerController::class, 'getStats']);
    Route::get('/dashboard/farmer/notifications', [App\Http\Controllers\FarmerController::class, 'notifications'])->name('farmer.notifications');
    Route::post('/dashboard/farmer/notifications/{id}/read', [App\Http\Controllers\FarmerController::class, 'markNotificationRead'])->name('notifications.read');
    Route::delete('/dashboard/farmer/notifications/{id}', [App\Http\Controllers\FarmerController::class, 'deleteNotification'])->name('notifications.delete');

    // Live Notifications API (Polling)
    Route::get('/api/notifications/unread', function () {
        $user = \Illuminate\Support\Facades\Auth::user();
        return response()->json([
            'success' => true,
            'data' => \App\Models\Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    })->name('api.notifications.unread');

    Route::post('/api/notifications/mark-notified', [App\Http\Controllers\NotificationController::class, 'markAsNotified'])->name('api.notifications.mark-notified');
    Route::post('/dashboard/logistics/{id}/verify-otp', [App\Http\Controllers\FarmerController::class, 'verifyOTP'])->name('logistics.verify-otp');
    Route::get('/dashboard/farmer/bids', [App\Http\Controllers\FarmerController::class, 'bids'])->name('farmer.bids');
    Route::post('/dashboard/farmer/bids/{id}/accept', [App\Http\Controllers\FarmerController::class, 'acceptBid'])->name('bids.accept');
    Route::post('/dashboard/farmer/bids/{id}/reject', [App\Http\Controllers\FarmerController::class, 'rejectBid'])->name('bids.reject');
    Route::post('/dashboard/farmer/bids/{id}/negotiate', [App\Http\Controllers\FarmerController::class, 'negotiateBid'])->name('bids.negotiate');
    Route::post('/dashboard/farmer/bids/clear-rejected', [App\Http\Controllers\FarmerController::class, 'clearRejectedBids'])->name('bids.clear-rejected');
    // Order Accept / Reject
    Route::post('/dashboard/farmer/orders/{id}/accept', [App\Http\Controllers\FarmerController::class, 'acceptOrder'])->name('orders.accept');
    Route::post('/dashboard/farmer/orders/{id}/reject', [App\Http\Controllers\FarmerController::class, 'rejectOrder'])->name('orders.reject');
    Route::get('/dashboard/farmer/orders', function () {
        return redirect()->route('farmer.bids');
    })->name('farmer.orders');
    // Route::get('/dashboard/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('farmer.chat');
    // Route::post('/dashboard/chat/send', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat.send');
    // Route::get('/dashboard/chat/{chat_id}/messages', [App\Http\Controllers\ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat', [App\Http\Controllers\ChatController::class, 'chat'])->name('ai.chat');
    Route::post('/crops', [App\Http\Controllers\CropController::class, 'store'])->name('crops.store');
    Route::put('/crops/{id}', [App\Http\Controllers\CropController::class, 'update'])->name('crops.update');
    Route::delete('/crops/{id}', [App\Http\Controllers\CropController::class, 'destroy'])->name('crops.destroy');
    Route::get('/dashboard/buyer', [App\Http\Controllers\BuyerController::class, 'index'])->name('buyer.dashboard');
    Route::post('/orders', [App\Http\Controllers\BuyerController::class, 'placeOrder'])->name('orders.place');
    Route::post('/bids', [App\Http\Controllers\BuyerController::class, 'placeBid'])->name('bids.place');
    Route::get('/dashboard/buyer/notifications', [App\Http\Controllers\BuyerController::class, 'notifications'])->name('buyer.notifications');
    Route::get('/api/buyer/notifications/unread', function () {
        $user = \Illuminate\Support\Facades\Auth::user();
        $notifications = \App\Models\Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json(['success' => true, 'data' => $notifications]);
    })->name('buyer.notifications.unread');
    Route::post('/dashboard/buyer/notifications/{id}/read', [App\Http\Controllers\BuyerController::class, 'markNotificationRead'])->name('buyer.notifications.read');
    Route::delete('/dashboard/buyer/notifications/{id}', [App\Http\Controllers\BuyerController::class, 'deleteNotification'])->name('buyer.notifications.delete');

    Route::get('/dashboard/buyer/discover', [App\Http\Controllers\BuyerController::class, 'discover'])->name('buyer.discover');
    Route::get('/dashboard/buyer/bids', [App\Http\Controllers\BuyerController::class, 'myBids'])->name('buyer.bids');
    Route::get('/dashboard/buyer/saved', [App\Http\Controllers\BuyerController::class, 'saved'])->name('buyer.saved');
    Route::get('/dashboard/buyer/logistics', [App\Http\Controllers\BuyerController::class, 'logistics'])->name('buyer.logistics');
    Route::get('/dashboard/buyer/orders', [App\Http\Controllers\BuyerController::class, 'orders'])->name('buyer.orders');
    Route::post('/dashboard/buyer/orders/{id}/cancel', [App\Http\Controllers\BuyerController::class, 'cancelOrder'])->name('orders.cancel');
    Route::get('/dashboard/buyer/orders/{id}/invoice', [App\Http\Controllers\BuyerController::class, 'downloadInvoice'])->name('orders.invoice');
    Route::get('/dashboard/buyer/account', [App\Http\Controllers\BuyerController::class, 'account'])->name('buyer.account');
    Route::post('/dashboard/buyer/account/profile', [App\Http\Controllers\BuyerController::class, 'updateAccountProfile'])->name('buyer.account.profile');
    Route::post('/dashboard/buyer/account/password', [App\Http\Controllers\BuyerController::class, 'updateAccountPassword'])->name('buyer.account.password');
    Route::post('/dashboard/buyer/account/bank', [App\Http\Controllers\BuyerController::class, 'saveBank'])->name('buyer.account.bank');
    Route::post('/dashboard/buyer/account/card', [App\Http\Controllers\BuyerController::class, 'saveCard'])->name('buyer.account.card');

    // Cart & Checkout
    Route::post('/cart/add', [App\Http\Controllers\BuyerController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [App\Http\Controllers\BuyerController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove', [App\Http\Controllers\BuyerController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/dashboard/buyer/checkout', [App\Http\Controllers\BuyerController::class, 'checkout'])->name('checkout');
    Route::post('/saved/toggle', [App\Http\Controllers\BuyerController::class, 'toggleSaved'])->name('saved.toggle');

    // Settings
    Route::get('/dashboard/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('farmer.settings');
    Route::post('/dashboard/settings/profile', [App\Http\Controllers\SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/dashboard/settings/notifications', [App\Http\Controllers\SettingsController::class, 'updateNotifications'])->name('settings.notifications');
    Route::post('/dashboard/settings/security', [App\Http\Controllers\SettingsController::class, 'updateSecurity'])->name('settings.security');
    Route::post('/dashboard/settings/delete', [App\Http\Controllers\SettingsController::class, 'deleteAccount'])->name('settings.delete');
    Route::post('/dashboard/settings/bank', [App\Http\Controllers\SettingsController::class, 'addBank'])->name('settings.bank');
    Route::post('/dashboard/settings/bank/{index}', [App\Http\Controllers\SettingsController::class, 'updateBank'])->name('settings.bank.update');
    Route::post('/dashboard/settings/card', [App\Http\Controllers\SettingsController::class, 'addCard'])->name('settings.card');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/help', function () {
    return view('help');
});

Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    $content = "You have received a new inquiry from FarmDirect Contact Form:\n\n"
        . "Name: {$data['name']}\n"
        . "Email: {$data['email']}\n"
        . "Subject: {$data['subject']}\n"
        . "Message:\n{$data['message']}";

    Mail::raw($content, function ($mail) use ($data) {
        $mail->to('examgenai2005@gmail.com')
            ->subject('FarmDirect Inquiry: ' . $data['subject'])
            ->replyTo($data['email'], $data['name']);
    });

    return back()->with('success', 'Your message has been sent successfully. We will be in touch soon!');
});

Route::get('/about', function () {
    return view('about');
});
