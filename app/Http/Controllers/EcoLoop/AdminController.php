<?php

namespace App\Http\Controllers\EcoLoop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Reward;
use App\Models\User;
use App\Models\Badge;
use App\Models\Store;
use App\Models\Region;
use App\Models\Message;
use App\Models\Complaint;
use App\Models\Voucher;
use App\Models\Notification;
use App\Models\Redemption;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    // Middleware is handled in routes/web.php with 'middleware('can:admin)'
    // No constructor needed

    /**
     * Admin Monitoring Dashboard - Landing page for admin after login
     */
    public function monitoring()
    {
        // Quick Stats for Today
        $todayOrders = Order::whereDate('created_at', today())
            ->where('status', '!=', 'cancelled')
            ->get();

        // Get stats
        $stats = [
            'total_users' => User::count(),
            'total_sellers' => User::where('role', 'seller')->count(),
            'total_buyers' => User::where('role', 'buyer')->count(),
            'total_products' => Product::count(),
            'pending_products' => Product::where('is_active', false)->count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->where('payment_status', 'pending')->count(),
            'total_carbon' => User::sum('total_carbon_saved'),
            'total_stores' => Store::count(),
            'pending_complaints' => Complaint::pending()->count(),
            'pending_stores' => Store::where('is_verified', false)->count(),
            // Today's stats
            'today_orders' => $todayOrders->count(),
            'today_revenue' => $todayOrders->where('status', 'completed')->sum('total_amount'),
            'today_carbon' => $todayOrders->sum('total_carbon_saved'),
        ];

        // Get recent orders
        $recentOrders = Order::with('user')
            ->latest()
            ->take(10)
            ->get();

        // Get pending payments
        $pendingPayments = Order::with('user')
            ->where('payment_status', 'pending')
            ->where('status', 'pending')
            ->where('payment_method', '!=', 'cod')
            ->latest()
            ->take(5)
            ->get();

        // Get recent complaints
        $recentComplaints = Complaint::with('user')
            ->pending()
            ->latest()
            ->take(5)
            ->get();

        // Calculate weekly sales data (last 7 days)
        $weeklySales = $this->getWeeklySalesData();

        // Top sellers this week
        $topSellersThisWeek = User::where('role', 'seller')
            ->withCount(['orders' => function ($q) {
                $q->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                  ->where('status', 'completed');
            }])
            ->orderBy('orders_count', 'desc')
            ->take(5)
            ->get();

        // Top buyers this week
        $topBuyersThisWeek = User::where('role', 'buyer')
            ->withCount(['orders' => function ($q) {
                $q->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                  ->where('status', 'completed');
            }])
            ->orderBy('orders_count', 'desc')
            ->take(5)
            ->get();

        return view('eco-loop.pages.admin.monitoring', compact(
            'stats',
            'recentOrders',
            'pendingPayments',
            'recentComplaints',
            'weeklySales',
            'topSellersThisWeek',
            'topBuyersThisWeek'
        ));
    }

    public function dashboard()
    {
        // Get stats
        $stats = [
            'total_users' => User::count(),
            'total_sellers' => User::where('role', 'seller')->count(),
            'total_buyers' => User::where('role', 'buyer')->count(),
            'total_products' => Product::count(),
            'pending_products' => Product::where('is_active', false)->count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->where('payment_status', 'pending')->count(),
            'total_carbon' => User::sum('total_carbon_saved'),
            'total_stores' => Store::count(),
            'pending_complaints' => Complaint::pending()->count(),
            'pending_stores' => Store::where('is_verified', false)->count(),
        ];

        // Get recent complaints
        $recentComplaints = Complaint::with('user')
            ->pending()
            ->latest()
            ->take(5)
            ->get();

        // Get recent orders
        $recentOrders = Order::with('user')
            ->latest()
            ->take(10)
            ->get();

        // Get pending payments
        $pendingPayments = Order::with('user')
            ->where('payment_status', 'pending')
            ->where('status', 'pending')
            ->where('payment_method', '!=', 'cod') // COD doesn't need payment confirmation
            ->latest()
            ->take(5)
            ->get();

        // Calculate weekly sales data (last 7 days)
        $weeklySales = $this->getWeeklySalesData();

        return view('eco-loop.pages.admin.dashboard', compact('stats', 'recentComplaints', 'recentOrders', 'pendingPayments', 'weeklySales'));
    }

    /**
     * Get weekly sales data for the chart
     */
    private function getWeeklySalesData()
    {
        $salesData = [];
        $labels = [];
        $sales = [];
        $orders = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $startOfDay = $date->copy()->startOfDay();
            $endOfDay = $date->copy()->endOfDay();

            $dayOrders = Order::whereBetween('created_at', [$startOfDay, $endOfDay])
                ->where('status', '!=', 'cancelled')
                ->get();

            $dayTotal = $dayOrders->sum('total_amount');
            $dayCount = $dayOrders->count();

            $labels[] = $date->format('D');
            $sales[] = (int) $dayTotal;
            $orders[] = $dayCount;
        }

        // Calculate weekly totals
        $weekStart = Carbon::now()->subDays(6)->startOfDay();
        $weekEnd = Carbon::now()->endOfDay();

        $weeklyTotalSales = Order::whereBetween('created_at', [$weekStart, $weekEnd])
            ->where('status', '!=', 'cancelled')
            ->sum('total_amount');

        $weeklyTotalOrders = Order::whereBetween('created_at', [$weekStart, $weekEnd])
            ->where('status', '!=', 'cancelled')
            ->count();

        return [
            'labels' => $labels,
            'sales' => $sales,
            'orders' => $orders,
            'weekly_total' => $weeklyTotalSales,
            'weekly_orders' => $weeklyTotalOrders,
        ];
    }

    // ==================== PAYMENT MANAGEMENT ====================

    /**
     * List all pending payments
     */
    public function payments(Request $request)
    {
        $query = Order::with(['user', 'items.product'])
            ->where('payment_status', 'pending')
            ->where('status', 'pending');

        // Filter by payment method
        if ($request->has('method') && $request->method) {
            $query->where('payment_method', $request->method);
        }

        // Filter by status
        if ($request->has('filter') && $request->filter) {
            switch ($request->filter) {
                case 'expired':
                    $query->where('payment_expires_at', '<', now());
                    break;
                case 'pending':
                    $query->where(function ($q) {
                        $q->whereNull('payment_expires_at')
                          ->orWhere('payment_expires_at', '>=', now());
                    });
                    break;
            }
        }

        $payments = $query->latest()->paginate(20);

        // Get stats
        $paymentStats = [
            'pending' => Order::where('payment_status', 'pending')->where('status', 'pending')->count(),
            'paid_today' => Order::whereDate('payment_paid_at', today())->count(),
            'total_pending_amount' => Order::where('payment_status', 'pending')
                ->where('status', 'pending')
                ->sum('total_amount'),
        ];

        return view('eco-loop.pages.admin.payments', compact('payments', 'paymentStats'));
    }

    /**
     * Confirm payment for an order
     */
    public function confirmPayment(Order $order)
    {
        if (!$order->canBeConfirmed()) {
            return back()->with('error', 'Pesanan tidak dapat dikonfirmasi pembayarannya.');
        }

        // Confirm via PaymentService
        $this->paymentService->confirmPayment($order);

        // Create voucher for buyer and sellers
        $this->createOrderVouchers($order);

        return back()->with('success', "Pembayaran pesanan {$order->order_number} berhasil dikonfirmasi!");
    }

    /**
     * Reject payment for an order
     */
    public function rejectPayment(Request $request, Order $order)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        if (!$order->canBeConfirmed()) {
            return back()->with('error', 'Pesanan tidak dapat ditolak pembayarannya.');
        }

        // Mark as failed
        $this->paymentService->markPaymentFailed($order, $validated['reason']);

        // Restore product stock
        foreach ($order->items as $item) {
            $item->product->increment('stock', $item->quantity);
            if ($item->product->stock > 0) {
                $item->product->update(['status' => 'available']);
            }
        }

        return back()->with('success', "Pembayaran pesanan {$order->order_number} ditolak. Stok produk telah dikembalikan.");
    }

    /**
     * Create vouchers after payment confirmation
     */
    protected function createOrderVouchers(Order $order): void
    {
        $user = $order->user;

        // Create voucher for buyer (1 point per 0.1 kg CO2)
        $points = (int) ($order->total_carbon_saved * 10);
        Voucher::create([
            'user_id' => $user->id,
            'order_id' => $order->id,
            'code' => Voucher::generateCode(),
            'carbon_amount' => $order->total_carbon_saved,
            'points' => $points,
            'status' => 'active',
            'expires_at' => now()->addDays(30),
        ]);

        $user->addVoucher($points);

        // Create voucher for each seller
        foreach ($order->items->groupBy('seller_id') as $sellerId => $items) {
            $sellerCarbon = $items->sum('carbon_saved');
            $sellerPoints = (int) ($sellerCarbon * 10);

            Voucher::create([
                'user_id' => $sellerId,
                'order_id' => $order->id,
                'code' => Voucher::generateCode(),
                'carbon_amount' => $sellerCarbon,
                'points' => $sellerPoints,
                'status' => 'active',
                'expires_at' => now()->addDays(30),
            ]);

            // Notify seller
            Notification::create([
                'user_id' => $sellerId,
                'type' => 'order',
                'title' => 'Pesanan Baru!',
                'message' => "Pesanan {$order->order_number} telah dibayar. +{$sellerPoints} voucher karbon!",
                'is_read' => false,
            ]);
        }

        // Notify buyer
        Notification::create([
            'user_id' => $user->id,
            'type' => 'order',
            'title' => 'Pesanan Diproses!',
            'message' => "Pesanan {$order->order_number} sedang diproses. +{$points} voucher karbon!",
            'is_read' => false,
        ]);
    }

    // ==================== EXISTING METHODS ====================

    // Users Management
    public function users()
    {
        $users = User::with('region')
            ->latest()
            ->paginate(20);

        return view('eco-loop.pages.admin.users', compact('users'));
    }

    // Show create form
    public function createUser()
    {
        $regions = Region::orderBy('name')->get();
        return view('eco-loop.pages.admin.users-form', compact('regions'));
    }

    // Store new user
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:8',
            'role' => ['required', Rule::in(['admin','seller','buyer','user'])],
            'region_id' => 'nullable|exists:regions,id',
            'phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:1000',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            $validated['password'] = Hash::make('password');
        }

        User::create($validated);

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dibuat.');
    }

    // Edit user
    public function editUser(User $user)
    {
        $regions = Region::orderBy('name')->get();
        return view('eco-loop.pages.admin.users-form', compact('user', 'regions'));
    }

    // Update user
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users','email')->ignore($user->id)],
            'role' => ['required', Rule::in(['admin','seller','buyer','user'])],
            'region_id' => 'nullable|exists:regions,id',
            'phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:1000',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Update password
    public function updatePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update(['password' => Hash::make($validated['password'])]);

        return redirect()->route('admin.users')->with('success', 'Password pengguna berhasil diubah.');
    }

    // Toggle block/unblock user
    public function toggleBlock(User $user)
    {
        $user->update(['is_blocked' => !$user->is_blocked]);
        $status = $user->is_blocked ? 'diblokir' : 'diaktifkan';
        return redirect()->route('admin.users')->with('success', "Pengguna berhasil {$status}.");
    }

    // Destroy (delete) user
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus.');
    }

    // Products Management
    public function products(Request $request)
    {
        $query = Product::with(['user', 'category']);

        // Filter by approval status
        if ($request->has('filter') && $request->filter) {
            switch ($request->filter) {
                case 'pending':
                    $query->where('is_active', false);
                    break;
                case 'approved':
                    $query->where('is_active', true);
                    break;
            }
        }

        $products = $query->latest()->paginate(20);

        return view('eco-loop.pages.admin.products', compact('products'));
    }

    // Approve Product
    public function approveProduct(Product $product)
    {
        $product->update(['is_active' => true]);

        return back()->with('success', "Produk '{$product->name}' berhasil disetujui dan ditampilkan ke publik.");
    }

    // Reject Product
    public function rejectProduct(Product $product)
    {
        $product->update(['is_active' => false]);

        return back()->with('info', "Produk '{$product->name}' ditolak.");
    }

    // Orders Management
    public function orders(Request $request)
    {
        $query = Order::with(['user']);

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->has('payment_status') && $request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->latest()->paginate(20);

        return view('eco-loop.pages.admin.orders', compact('orders'));
    }

    // Categories Management
    public function categories()
    {
        $categories = Category::withCount('products')->get();

        return view('eco-loop.pages.admin.categories', compact('categories'));
    }

    public function updateCategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'carbon_value_per_kg' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $category->update($validated);

        return back()->with('success', 'Kategori berhasil diperbarui');
    }

    // Stores Management
    public function stores()
    {
        $stores = Store::with(['user', 'region'])
            ->withCount('user')
            ->latest()
            ->paginate(20);

        return view('eco-loop.pages.admin.stores', compact('stores'));
    }

    public function verifyStore(Store $store)
    {
        $store->update(['is_verified' => !$store->is_verified]);

        $status = $store->is_verified ? 'diverifikasi' : 'dibatalkan verifikasi';
        return back()->with('success', "Toko berhasil {$status}");
    }

    // Regions Management
    public function regions()
    {
        $regions = Region::withCount(['users', 'stores'])
            ->latest()
            ->paginate(20);

        return view('eco-loop.pages.admin.regions', compact('regions'));
    }

    public function storeRegion(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        Region::create($validated);

        return back()->with('success', 'Region berhasil ditambahkan');
    }

    // Messages (view all conversations)
    public function messages()
    {
        $messages = Message::with(['sender', 'receiver', 'product'])
            ->latest()
            ->paginate(30);

        return view('eco-loop.pages.admin.messages', compact('messages'));
    }

    // Rewards Management
    public function rewards()
    {
        $rewards = Reward::all();

        return view('eco-loop.pages.admin.rewards', compact('rewards'));
    }

    // Rewards redemption queue
    public function redemptions()
    {
        $redemptions = Redemption::with(['user', 'reward', 'voucher'])
            ->latest()
            ->paginate(20);

        return view('eco-loop.pages.admin.redemptions', compact('redemptions'));
    }

    public function approveRedemption(Redemption $redemption)
    {
        if ($redemption->status !== 'pending') {
            return back()->with('info', 'Permintaan penukaran ini sudah diproses sebelumnya.');
        }

        DB::transaction(function () use ($redemption) {
            if (!$redemption->voucher_id) {
                $voucher = Voucher::create([
                    'user_id' => $redemption->user_id,
                    'order_id' => null,
                    'code' => Voucher::generateCode(),
                    'carbon_amount' => 0,
                    'points' => (int) ($redemption->points_spent ?? 0),
                    'status' => 'active',
                    'expires_at' => now()->addDays(30),
                ]);

                $redemption->voucher_id = $voucher->id;
            }

            $redemption->status = 'completed';
            $redemption->notes = trim(($redemption->notes ?: '') . ' Disetujui admin.');
            $redemption->save();

            Notification::create([
                'user_id' => $redemption->user_id,
                'type' => 'reward',
                'title' => 'Hadiah Disetujui',
                'message' => "Penukaran '{$redemption->reward->name}' telah disetujui dan voucher siap masuk ke inbox Anda.",
                'is_read' => false,
            ]);
        });

        return back()->with('success', 'Penukaran hadiah berhasil disetujui dan voucher dibuat untuk pengguna.');
    }

    public function rejectRedemption(Request $request, Redemption $redemption)
    {
        if ($redemption->status !== 'pending') {
            return back()->with('info', 'Permintaan penukaran ini tidak sedang menunggu persetujuan.');
        }

        $reason = trim((string) $request->input('reason', 'Penukaran ditolak oleh admin.'));

        DB::transaction(function () use ($redemption, $reason) {
            $redemption->status = 'cancelled';
            $redemption->notes = trim(($redemption->notes ?: '') . ' ' . $reason);
            $redemption->save();

            $user = $redemption->user;
            if ($user) {
                $user->increment('total_vouchers', (int) ($redemption->points_spent ?? 0));
            }
        });

        return back()->with('success', 'Penukaran hadiah ditolak dan poin telah dikembalikan ke pengguna.');
    }

    // Badges Management
    public function badges()
    {
        $badges = Badge::all();

        return view('eco-loop.pages.admin.badges', compact('badges'));
    }

    // Complaints Management - List
    public function complaints()
    {
        $query = Complaint::with(['user', 'order']);

        if (request('status') && request('status') !== 'all') {
            $query->where('status', request('status'));
        }

        $complaints = $query->latest()->paginate(20);

        return view('eco-loop.pages.admin.complaints', compact('complaints'));
    }

    // Complaints - Update
    public function complaintUpdate(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewing,resolved,rejected',
            'response' => 'required|string|max:2000',
        ]);

        $complaint->update([
            'status' => $validated['status'],
            'response' => $validated['response'],
            'resolved_at' => in_array($validated['status'], ['resolved', 'rejected']) ? now() : null,
        ]);

        return redirect()->back()->with('success', 'Pengaduan berhasil diperbarui');
    }

    // ==================== STATISTICS PAGE ====================

    /**
     * Display detailed statistics page
     */
    public function statistics()
    {
        // Overview Stats
        $stats = [
            'total_users' => User::count(),
            'total_sellers' => User::where('role', 'seller')->count(),
            'total_buyers' => User::where('role', 'buyer')->count(),
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
            'total_carbon' => User::sum('total_carbon_saved'),
            'total_stores' => Store::count(),
        ];

        // Monthly Trends (Last 12 months)
        $monthlyTrends = $this->getMonthlyTrends();

        // Category Performance
        $categoryPerformance = $this->getCategoryPerformance();

        // Top Performers
        $topSellers = User::where('role', 'seller')
            ->withCount(['products'])
            ->withSum([
                'products' => function ($q) {
                    $q->whereHas('orderItems.order', fn($oq) => $oq->where('status', 'completed'));
                }
            ], 'price')
            ->orderBy('products_sum_price', 'desc')
            ->take(10)
            ->get();

        $topBuyers = User::where('role', 'buyer')
            ->withSum(['orders' => fn($q) => $q->where('status', 'completed')], 'total_amount')
            ->orderBy('orders_sum_total_amount', 'desc')
            ->take(10)
            ->get();

        // Carbon Savings by Month
        $carbonByMonth = $this->getCarbonByMonth();

        // Order Status Distribution
        $orderStatusDistribution = [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        // Revenue by Region
        $revenueByRegion = $this->getRevenueByRegion();

        // Growth Metrics
        $growthMetrics = $this->getGrowthMetrics();

        return view('eco-loop.pages.admin.statistics', compact(
            'stats',
            'monthlyTrends',
            'categoryPerformance',
            'topSellers',
            'topBuyers',
            'carbonByMonth',
            'orderStatusDistribution',
            'revenueByRegion',
            'growthMetrics'
        ));
    }

    /**
     * Get monthly trends for the last 12 months
     */
    private function getMonthlyTrends()
    {
        $data = [];
        $labels = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();

            $monthOrders = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('status', '!=', 'cancelled')
                ->get();

            $labels[] = $date->format('M Y');
            $data[] = [
                'orders' => $monthOrders->count(),
                'revenue' => $monthOrders->sum('total_amount'),
                'carbon' => $monthOrders->sum('total_carbon_saved'),
            ];
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get category performance
     */
    private function getCategoryPerformance()
    {
        return Category::withCount(['products'])
            ->withSum([
                'products' => function ($q) {
                    $q->whereHas('orderItems.order', fn($oq) => $oq->where('status', 'completed'));
                }
            ], 'price')
            ->withSum([
                'products' => function ($q) {
                    $q->whereHas('orderItems.order', fn($oq) => $oq->where('status', 'completed'));
                }
            ], 'stock')
            ->orderBy('products_count', 'desc')
            ->get();
    }

    /**
     * Get carbon savings by month
     */
    private function getCarbonByMonth()
    {
        $data = [];
        $labels = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();

            $carbon = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('status', '!=', 'cancelled')
                ->sum('total_carbon_saved');

            $labels[] = $date->format('M');
            $data[] = round($carbon, 2);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get revenue by region
     */
    private function getRevenueByRegion()
    {
        // Use joins and conditional aggregation to compute revenue per region
        return Region::select('regions.*')
            ->selectRaw('COUNT(DISTINCT users.id) as users_count')
            ->selectRaw("COALESCE(SUM(CASE WHEN orders.status = 'completed' THEN orders.total_amount ELSE 0 END), 0) as revenue")
            ->leftJoin('users', 'users.region_id', 'regions.id')
            ->leftJoin('orders', 'orders.user_id', 'users.id')
            ->groupBy('regions.id')
            ->orderBy('revenue', 'desc')
            ->take(10)
            ->get();
    }

    /**
     * Get growth metrics (compare with last month)
     */
    private function getGrowthMetrics()
    {
        $currentMonth = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        // Current month stats
        $currentOrders = Order::whereBetween('created_at', [
            $currentMonth->copy()->startOfMonth(),
            $currentMonth->copy()->endOfMonth()
        ])->where('status', '!=', 'cancelled');

        $currentRevenue = (clone $currentOrders)->sum('total_amount');
        $currentOrderCount = (clone $currentOrders)->count();

        // Last month stats
        $lastMonthOrders = Order::whereBetween('created_at', [
            $lastMonth->copy()->startOfMonth(),
            $lastMonth->copy()->endOfMonth()
        ])->where('status', '!=', 'cancelled');

        $lastRevenue = (clone $lastMonthOrders)->sum('total_amount');
        $lastOrderCount = (clone $lastMonthOrders)->count();

        // Calculate growth percentages
        $revenueGrowth = $lastRevenue > 0 ? (($currentRevenue - $lastRevenue) / $lastRevenue) * 100 : 0;
        $orderGrowth = $lastOrderCount > 0 ? (($currentOrderCount - $lastOrderCount) / $lastOrderCount) * 100 : 0;

        // New users this month vs last month
        $currentNewUsers = User::whereBetween('created_at', [
            $currentMonth->copy()->startOfMonth(),
            $currentMonth->copy()->endOfMonth()
        ])->count();

        $lastNewUsers = User::whereBetween('created_at', [
            $lastMonth->copy()->startOfMonth(),
            $lastMonth->copy()->endOfMonth()
        ])->count();

        $userGrowth = $lastNewUsers > 0 ? (($currentNewUsers - $lastNewUsers) / $lastNewUsers) * 100 : 0;

        return [
            'revenue' => [
                'current' => $currentRevenue,
                'last' => $lastRevenue,
                'growth' => round($revenueGrowth, 1),
            ],
            'orders' => [
                'current' => $currentOrderCount,
                'last' => $lastOrderCount,
                'growth' => round($orderGrowth, 1),
            ],
            'new_users' => [
                'current' => $currentNewUsers,
                'last' => $lastNewUsers,
                'growth' => round($userGrowth, 1),
            ],
        ];
    }
}
