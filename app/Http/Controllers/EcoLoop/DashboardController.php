<?php

namespace App\Http\Controllers\EcoLoop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Notification;
use App\Models\Badge;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load(['cart', 'badges', 'store']);

        // Get top 5 eco savers for leaderboard preview
        $topUsers = User::where('total_carbon_saved', '>', 0)
            ->orderByDesc('total_carbon_saved')
            ->take(5)
            ->get();

        // Base stats for all users
        $stats = [
            'total_carbon' => $user->total_carbon_saved ?? 0,
            'total_orders' => $user->total_orders ?? 0,
            'total_vouchers' => $user->total_vouchers ?? 0,
        ];

        // Role-specific stats and data
        if ($user->isAdmin()) {
            // Admin: Platform-wide stats
            $stats['total_users'] = User::count();
            $stats['total_products'] = Product::count();
            $stats['total_sales'] = Order::where('status', 'completed')->sum('total_amount');
            $stats['pending_orders'] = Order::where('status', 'pending')->count();
            $stats['active_sellers'] = User::where('role', 'seller')->count();
            $stats['active_buyers'] = User::where('role', 'buyer')->count();

            // Recent platform orders
            $recentOrders = Order::with(['user'])
                ->latest()
                ->take(5)
                ->get();

            // New users this week
            $newUsersThisWeek = User::where('created_at', '>=', now()->startOfWeek())->count();

            // Top products
            $topProducts = Product::with('category')
                ->withCount('orderItems')
                ->orderByDesc('order_items_count')
                ->take(5)
                ->get();

        } elseif ($user->isSeller()) {
            // Seller: Their store stats
            $stats['products_sold'] = $user->products()
                ->whereHas('orderItems.order', function ($q) {
                    $q->where('status', 'completed');
                })
                ->withCount('orderItems')
                ->get()
                ->sum('order_items_count');
            $stats['products_listed'] = $user->products()->count();
            $stats['pending_orders'] = Order::whereHas('items', function ($q) use ($user) {
                $q->whereHas('product', fn($pq) => $pq->where('user_id', $user->id));
            })
            ->where('status', 'pending')
            ->count();
            $stats['total_earnings'] = Order::whereHas('items', function ($q) use ($user) {
                $q->whereHas('product', fn($pq) => $pq->where('user_id', $user->id));
            })
            ->where('status', 'completed')
            ->sum('total_amount');

            // Seller's incoming orders
            $recentOrders = Order::whereHas('items', function ($query) use ($user) {
                $query->whereHas('product', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            })
            ->with(['user', 'items.product'])
            ->latest()
            ->take(5)
            ->get();

            // Seller's products
            $sellerProducts = $user->products()
                ->with('category')
                ->latest()
                ->take(5)
                ->get();

            // Low stock products
            $lowStockProducts = $user->products()
                ->where('stock', '<', 5)
                ->count();

        } else {
            // Buyer-specific stats
            $stats['products_bought'] = $user->orders()->count();
            $stats['active_vouchers'] = $user->vouchers()->active()->count();
            $stats['pending_orders'] = $user->orders()->where('status', 'pending')->count();

            // Buyer's recent orders
            $recentOrders = $user->orders()
                ->with(['items.product.category'])
                ->latest()
                ->take(5)
                ->get();

            // Recently viewed/wishlist products (if available)
            $recentProducts = collect([]);
        }

        $recentNotifications = $user->notifications()
            ->latest()
            ->take(5)
            ->get();

        $badges = $user->badges;

        return view('eco-loop.pages.dashboard.index', compact(
            'stats',
            'recentOrders',
            'recentNotifications',
            'badges',
            'topUsers',
            ...($user->isAdmin() ? ['newUsersThisWeek', 'topProducts'] : []),
            ...($user->isSeller() ? ['sellerProducts', 'lowStockProducts'] : []),
            ...($user->isBuyer() ? ['recentProducts'] : [])
        ));
    }

    public function orders()
    {
        $user = auth()->user();

        if ($user->isSeller()) {
            // Sellers see orders where their products were purchased
            $orders = Order::whereHas('items', function ($query) use ($user) {
                $query->whereHas('product', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            })
            ->with(['items.product' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }, 'user'])
            ->latest()
            ->paginate(10);
        } else {
            // Buyers see their own orders
            $orders = $user->orders()
                ->with(['items.product.seller'])
                ->latest()
                ->paginate(10);
        }

        return view('eco-loop.pages.dashboard.orders', compact('orders'));
    }

    public function vouchers()
    {
        $user = auth()->user();

        $activeVouchers = $user->vouchers()
            ->active()
            ->orderBy('expires_at')
            ->get();

        $pendingRedemptions = $user->redemptions()
            ->with('reward')
            ->whereIn('status', ['pending', 'completed'])
            ->latest()
            ->get();

        $expiredVouchers = $user->vouchers()
            ->where('status', 'expired')
            ->latest()
            ->take(10)
            ->get();

        $redeemedVouchers = $user->vouchers()
            ->where('status', 'redeemed')
            ->latest()
            ->take(10)
            ->get();

        // Stats for the view
        $totalCarbonSaved = $user->total_carbon_saved ?? 0;
        $totalPoints = $user->total_vouchers ?? 0;

        return view('eco-loop.pages.dashboard.vouchers', compact(
            'activeVouchers',
            'pendingRedemptions',
            'expiredVouchers',
            'redeemedVouchers',
            'totalCarbonSaved',
            'totalPoints'
        ));
    }

    public function products()
    {
        $products = auth()->user()->products()
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('eco-loop.pages.dashboard.products', compact('products'));
    }

    public function notifications()
    {
        $notifications = auth()->user()->notifications()
            ->latest()
            ->paginate(20);

        return view('eco-loop.pages.dashboard.notifications', compact('notifications'));
    }

    public function markNotificationAsRead(Notification $notification)
    {
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->markAsRead();

        return back();
    }

    /**
     * Mark all notifications as read for the authenticated user.
     */
    public function markAllNotificationsAsRead()
    {
        auth()->user()->notifications()
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return back()->with('success', 'Semua notifikasi telah dibaca');
    }

    /**
     * Seller Statistics Page
     */
    public function statistics()
    {
        $user = auth()->user();

        if (!$user->isSeller()) {
            abort(403);
        }

        // Get monthly data for charts (last 12 months)
        $monthlyData = $this->getSellerMonthlyData($user);

        // Top products by sales
        $topProducts = $user->products()
            ->withCount(['orderItems' => fn($q) => $q->whereHas('order', fn($oq) => $oq->where('status', 'completed'))])
            ->orderByDesc('order_items_count')
            ->take(5)
            ->get();

        // Sales by category
        $salesByCategory = $this->getSellerSalesByCategory($user);

        // Growth metrics
        $growthMetrics = $this->getSellerGrowthMetrics($user);

        // Best selling days
        $bestDays = $this->getBestSellingDays($user);

        return view('eco-loop.pages.dashboard.statistics', compact(
            'monthlyData',
            'topProducts',
            'salesByCategory',
            'growthMetrics',
            'bestDays'
        ));
    }

    /**
     * Get seller's monthly data for charts
     */
    private function getSellerMonthlyData($user)
    {
        $labels = [];
        $sales = [];
        $orders = [];
        $carbon = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();

            $monthData = Order::whereHas('items', function ($q) use ($user) {
                $q->where('seller_id', $user->id);
            })
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->where('status', 'completed')
            ->get();

            $labels[] = $date->format('M');
            $sales[] = $monthData->sum('total_amount');
            $orders[] = $monthData->count();
            $carbon[] = $monthData->sum('total_carbon_saved');
        }

        return [
            'labels' => $labels,
            'sales' => $sales,
            'orders' => $orders,
            'carbon' => $carbon,
        ];
    }

    /**
     * Get seller's sales by category
     */
    private function getSellerSalesByCategory($user)
    {
        return \App\Models\Category::whereHas('products', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
        ->withCount(['products' => function ($q) use ($user) {
            $q->where('user_id', $user->id);
        }])
        ->withSum(['products' => function ($q) use ($user) {
            $q->where('user_id', $user->id)
              ->whereHas('orderItems.order', fn($oq) => $oq->where('status', 'completed'));
        }], 'price')
        ->get();
    }

    /**
     * Get seller's growth metrics
     */
    private function getSellerGrowthMetrics($user)
    {
        $currentMonth = now();
        $lastMonth = now()->subMonth();

        // Current month
        $currentOrders = Order::whereHas('items', fn($q) => $q->where('seller_id', $user->id))
            ->whereBetween('created_at', [$currentMonth->copy()->startOfMonth(), $currentMonth->copy()->endOfMonth()])
            ->where('status', 'completed');

        $currentRevenue = (clone $currentOrders)->sum('total_amount');
        $currentOrdersCount = (clone $currentOrders)->count();

        // Last month
        $lastMonthOrders = Order::whereHas('items', fn($q) => $q->where('seller_id', $user->id))
            ->whereBetween('created_at', [$lastMonth->copy()->startOfMonth(), $lastMonth->copy()->endOfMonth()])
            ->where('status', 'completed');

        $lastRevenue = (clone $lastMonthOrders)->sum('total_amount');
        $lastOrdersCount = (clone $lastMonthOrders)->count();

        // Calculate growth
        $revenueGrowth = $lastRevenue > 0 ? (($currentRevenue - $lastRevenue) / $lastRevenue) * 100 : 0;
        $ordersGrowth = $lastOrdersCount > 0 ? (($currentOrdersCount - $lastOrdersCount) / $lastOrdersCount) * 100 : 0;

        return [
            'revenue' => [
                'current' => $currentRevenue,
                'last' => $lastRevenue,
                'growth' => round($revenueGrowth, 1),
            ],
            'orders' => [
                'current' => $currentOrdersCount,
                'last' => $lastOrdersCount,
                'growth' => round($ordersGrowth, 1),
            ],
        ];
    }

    /**
     * Get best selling days
     */
    private function getBestSellingDays($user)
    {
        $days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dayOrders = Order::whereHas('items', fn($q) => $q->where('seller_id', $user->id))
                ->whereDate('created_at', $date)
                ->where('status', 'completed')
                ->get();

            $days[] = [
                'day' => $date->format('D'),
                'orders' => $dayOrders->count(),
                'revenue' => $dayOrders->sum('total_amount'),
            ];
        }

        return $days;
    }
}
