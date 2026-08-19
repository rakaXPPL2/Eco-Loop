<?php

use App\Http\Controllers\EcoLoop\AdminController;
use App\Http\Controllers\EcoLoop\CartController;
use App\Http\Controllers\EcoLoop\CheckoutController;
use App\Http\Controllers\EcoLoop\ComplaintController;
use App\Http\Controllers\EcoLoop\DashboardController;
use App\Http\Controllers\EcoLoop\EcoShopController;
use App\Http\Controllers\EcoLoop\HomeController;
use App\Http\Controllers\EcoLoop\LeaderboardController;
use App\Http\Controllers\EcoLoop\MessageController;
use App\Http\Controllers\EcoLoop\OrderController;
use App\Http\Controllers\EcoLoop\ProductController;
use App\Http\Controllers\EcoLoop\StoreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return view('landing');
})->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Public Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/eco-shop', [EcoShopController::class, 'index'])->name('eco-shop');
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');
Route::get('/stores/{store}', [StoreController::class, 'show'])->name('stores.show');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Store Routes (Sellers only)
    Route::middleware('can:sell')->group(function () {
        Route::get('/store', [StoreController::class, 'index'])->name('store.index');
        Route::get('/store/create', [StoreController::class, 'create'])->name('store.create');
        Route::post('/store', [StoreController::class, 'store'])->name('store.store');
        Route::get('/store/edit', [StoreController::class, 'edit'])->name('store.edit');
        Route::patch('/store', [StoreController::class, 'update'])->name('store.update');
    });

    // Allow authenticated users (no email verification required) to redeem rewards
    Route::post('/eco-shop/redeem', [EcoShopController::class, 'redeem'])->name('eco-shop.redeem');
    Route::post('/eco-shop/redemptions/{redemption}/claim', [EcoShopController::class, 'claim'])->name('eco-shop.redemptions.claim');

    // Existing authenticated users do not need email verification to access the app.
    // New registrations still require an email address at signup.
    // Cart & Checkout - BUYERS ONLY
    Route::middleware('can:buy')->group(function () {
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');
        Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::get('/checkout/payment/{order}', [CheckoutController::class, 'payment'])->name('checkout.payment');
        Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
    });

    // Product Creation - SELLERS ONLY
    Route::middleware('can:sell')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // Chat - BUYERS ONLY
    Route::middleware('can:buy')->group(function () {
        Route::get('/products/{product}/chat', [MessageController::class, 'productChat'])->name('products.chat');
        Route::post('/products/{product}/chat', [MessageController::class, 'sendToSeller'])->name('products.chat.send');
    });

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply');

    // Complaints
    Route::get('/complaints', [ComplaintController::class, 'userIndex'])->name('complaints.index');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/statistics', [DashboardController::class, 'statistics'])->name('dashboard.statistics');
    Route::get('/dashboard/orders', [DashboardController::class, 'orders'])->name('dashboard.orders');
    Route::get('/dashboard/vouchers', [DashboardController::class, 'vouchers'])->name('dashboard.vouchers');
    Route::get('/dashboard/products', [DashboardController::class, 'products'])->name('dashboard.products');
    Route::get('/dashboard/notifications', [DashboardController::class, 'notifications'])->name('dashboard.notifications');
    Route::post('/dashboard/notifications/{notification}/read', [DashboardController::class, 'markNotificationAsRead'])->name('dashboard.notifications.read');
    Route::post('/dashboard/notifications/mark-all-read', [DashboardController::class, 'markAllNotificationsAsRead'])->name('dashboard.notifications.mark-all-read');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/status', function (
        \App\Models\Order $order
    ) {
        return redirect()->route('orders.show', $order);
    })->name('orders.status');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/orders/{order}/shipping-proof', [OrderController::class, 'uploadShippingProof'])->name('orders.shipping-proof');
    Route::post('/orders/{order}/confirm-delivery', [OrderController::class, 'confirmDelivery'])->name('orders.confirm-delivery');

    // Admin Routes - ADMIN ONLY
    Route::prefix('admin')->name('admin.')->middleware('can:admin')->group(function () {
        Route::get('/monitoring', [AdminController::class, 'monitoring'])->name('monitoring');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/statistics', [AdminController::class, 'statistics'])->name('statistics');

        Route::get('/complaints', [AdminController::class, 'complaints'])->name('complaints');
        Route::patch('/complaints/{complaint}', [AdminController::class, 'complaintUpdate'])->name('complaints.update');

        Route::get('/products', [AdminController::class, 'products'])->name('products');
        // Admin user management
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::post('/users/{user}/password', [AdminController::class, 'updatePassword'])->name('users.password');
        Route::post('/users/{user}/block', [AdminController::class, 'toggleBlock'])->name('users.block');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::patch('/products/{product}/approve', [AdminController::class, 'approveProduct'])->name('products.approve');
        Route::patch('/products/{product}/reject', [AdminController::class, 'rejectProduct'])->name('products.reject');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
        Route::patch('/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
        Route::get('/rewards', [AdminController::class, 'rewards'])->name('rewards');
        Route::get('/redemptions', [AdminController::class, 'redemptions'])->name('redemptions');
        Route::post('/redemptions/{redemption}/approve', [AdminController::class, 'approveRedemption'])->name('redemptions.approve');
        Route::post('/redemptions/{redemption}/reject', [AdminController::class, 'rejectRedemption'])->name('redemptions.reject');
        Route::get('/badges', [AdminController::class, 'badges'])->name('badges');
        Route::get('/stores', [AdminController::class, 'stores'])->name('stores');
        Route::patch('/stores/{store}/verify', [AdminController::class, 'verifyStore'])->name('stores.verify');
        Route::get('/regions', [AdminController::class, 'regions'])->name('regions');
        Route::post('/regions', [AdminController::class, 'storeRegion'])->name('regions.store');
        Route::get('/messages', [AdminController::class, 'messages'])->name('messages');

        // Payment Management
        Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
        Route::post('/payments/{order}/confirm', [AdminController::class, 'confirmPayment'])->name('payments.confirm');
        Route::post('/payments/{order}/reject', [AdminController::class, 'rejectPayment'])->name('payments.reject');
    });

    // API Routes
    Route::prefix('api')->group(function () {
        Route::get('/notifications/poll', function () {
            $lastId = request('last_id', 0);
            $notifications = \App\Models\Notification::where('user_id', auth()->id())
                ->where('id', '>', $lastId)
                ->where('is_read', false)
                ->orderBy('id', 'desc')
                ->limit(10)
                ->get(['id', 'type', 'title', 'message', 'data']);
            return response()->json(['notifications' => $notifications]);
        })->name('api.notifications.poll');
    });
});

require __DIR__.'/auth.php';
