<x-eco-loop-layout title="Monitoring - Eco-Loop">
    <div class="flex min-h-screen">
        <!-- Admin Sidebar -->
        <x-admin-sidebar :stats="[
            'pending_stores' => $stats['pending_stores'] ?? 0,
            'pending_complaints' => $stats['pending_complaints'] ?? 0
        ]" />

        <!-- Main Content -->
        <div class="flex-1 min-h-screen">
            <!-- Admin Header with Light Theme -->
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-emerald-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div class="flex items-center gap-3 md:gap-4 animate-fade-in-up">
                            <div class="w-12 h-12 md:w-16 md:h-16 rounded-xl md:rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-200">
                                <i class="fas fa-chart-line text-white text-xl md:text-2xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Monitoring & Statistik</h1>
                                <p class="text-emerald-600 text-sm md:text-base">Ringkasan performa platform minggu ini</p>
                            </div>
                        </div>
                        <div class="glass-card-light p-3 md:p-4 animate-fade-in-up" style="animation-delay: 200ms;">
                            <div class="flex items-center gap-2 text-emerald-700 text-sm md:text-base">
                                <i class="fas fa-leaf"></i>
                                <span class="font-medium">{{ number_format($stats['total_carbon'] ?? 0, 1) }} kg Total Karbon Terselamatkan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">

                <!-- Today's Quick Stats -->
                <div class="mb-6 md:mb-8 animate-fade-in-up">
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-calendar-day text-emerald-500"></i>
                        Statistik Hari Ini
                    </h2>

                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
                        <div class="bg-white rounded-xl p-4 md:p-5 border border-emerald-100 shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                                    <i class="fas fa-shopping-bag text-emerald-600 text-lg md:text-xl"></i>
                                </div>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $stats['today_orders'] ?? 0 }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Pesanan Baru</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 md:p-5 border border-emerald-100 shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-coins text-green-600 text-lg md:text-xl"></i>
                                </div>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800">Rp {{ number_format($stats['today_revenue'] ?? 0, 0, ',', '.') }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Pendapatan</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 md:p-5 border border-emerald-100 shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-teal-100 flex items-center justify-center">
                                    <i class="fas fa-cloud text-teal-600 text-lg md:text-xl"></i>
                                </div>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ number_format($stats['today_carbon'] ?? 0, 1) }}</p>
                            <p class="text-xs md:text-sm text-gray-500">kg CO2 Dihemat</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 md:p-5 border border-amber-100 shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                                    <i class="fas fa-clock text-amber-600 text-lg md:text-xl"></i>
                                </div>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $stats['pending_orders'] ?? 0 }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Menunggu Pembayaran</p>
                        </div>
                    </div>
                </div>

                <!-- Weekly Sales Chart Section -->
                <div class="mb-6 md:mb-8 animate-fade-in-up" style="animation-delay: 100ms;">
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-line text-emerald-500"></i>
                        Grafik Penjualan Minggu Ini
                    </h2>

                    <!-- Weekly Summary Cards -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-4">
                        <div class="glass-card-light p-3 md:p-4 text-center">
                            <p class="text-2xl md:text-3xl font-bold text-emerald-600">Rp {{ number_format($weeklySales['weekly_total'] ?? 0, 0, ',', '.') }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Total Penjualan</p>
                        </div>
                        <div class="glass-card-light p-3 md:p-4 text-center">
                            <p class="text-2xl md:text-3xl font-bold text-purple-600">{{ $weeklySales['weekly_orders'] ?? 0 }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Jumlah Pesanan</p>
                        </div>
                        <div class="glass-card-light p-3 md:p-4 text-center">
                            <p class="text-2xl md:text-3xl font-bold text-teal-600">{{ $stats['total_users'] ?? 0 }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Total Pengguna</p>
                        </div>
                        <div class="glass-card-light p-3 md:p-4 text-center">
                            <p class="text-2xl md:text-3xl font-bold text-amber-600">{{ $stats['pending_complaints'] ?? 0 }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Pengaduan Pending</p>
                        </div>
                    </div>

                    <!-- Chart Container -->
                    <div class="glass-card-light p-4 md:p-6 overflow-x-auto">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 gap-2">
                            <h3 class="font-semibold text-gray-700 text-sm md:text-base">Grafik Penjualan 7 Hari Terakhir</h3>
                            <div class="flex items-center gap-4 text-xs md:text-sm whitespace-nowrap">
                                <span class="flex items-center gap-1">
                                    <span class="w-3 h-3 rounded bg-emerald-500"></span> Penjualan
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="w-3 h-3 rounded bg-purple-400"></span> Pesanan
                                </span>
                            </div>
                        </div>

                        <!-- Simple Bar Chart using CSS -->
                        <div class="flex items-end justify-between gap-1 md:gap-2 h-40 md:h-52 min-w-[500px]">
                            @foreach($weeklySales['labels'] as $index => $label)
                                @php
                                    $maxSales = max($weeklySales['sales']) > 0 ? max($weeklySales['sales']) : 1;
                                    $salesHeight = ($weeklySales['sales'][$index] / $maxSales) * 100;
                                    $ordersHeight = count($weeklySales['orders']) > 0 && max($weeklySales['orders']) > 0
                                        ? ($weeklySales['orders'][$index] / max($weeklySales['orders'])) * 100
                                        : 0;
                                @endphp
                                <div class="flex-1 flex flex-col items-center gap-1">
                                    <!-- Sales Bar -->
                                    <div class="w-full bg-gradient-to-t from-emerald-500 to-emerald-300 rounded-t-md transition-all duration-500 hover:from-emerald-600 hover:to-emerald-400 min-h-[4px]"
                                         style="height: {{ max($salesHeight, 2) }}%"
                                         title="Rp {{ number_format($weeklySales['sales'][$index], 0, ',', '.') }}">
                                    </div>
                                    <!-- Orders Bar -->
                                    <div class="w-full bg-gradient-to-t from-purple-500 to-purple-300 rounded-t-md transition-all duration-500 hover:from-purple-600 hover:to-purple-400 min-h-[4px]"
                                         style="height: {{ max($ordersHeight, 2) }}%"
                                         title="{{ $weeklySales['orders'][$index] }} pesanan">
                                    </div>
                                    <!-- Day Label -->
                                    <span class="text-xs text-gray-500 mt-2">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Top Sellers & Buyers -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6 md:mb-8">
                    <!-- Top Sellers -->
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden animate-fade-in-up">
                        <div class="bg-gradient-to-r from-emerald-50 to-transparent p-4 md:p-5 border-b border-gray-100">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-store text-emerald-500"></i>
                                Top Penjual Minggu Ini
                            </h3>
                        </div>
                        <div class="p-4 overflow-x-auto">
                            @if($topSellersThisWeek->count() > 0)
                                <div class="space-y-3">
                                    @foreach($topSellersThisWeek as $index => $seller)
                                        <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-gradient-to-br {{ $index === 0 ? 'from-yellow-400 to-amber-500' : 'from-emerald-400 to-teal-500' }} flex items-center justify-center text-white font-bold text-sm">
                                                {{ $index + 1 }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-gray-800 truncate">{{ $seller->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $seller->orders_count }} pesanan</p>
                                            </div>
                                            <div class="text-right flex-shrink-0">
                                                <p class="font-bold text-emerald-600">{{ number_format($seller->total_carbon_saved, 1) }} kg</p>
                                                <p class="text-xs text-gray-400">CO2</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-store text-gray-300 text-4xl mb-3"></i>
                                    <p class="text-gray-500 text-sm">Belum ada penjualan minggu ini</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Top Buyers -->
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden animate-fade-in-up">
                        <div class="bg-gradient-to-r from-purple-50 to-transparent p-4 md:p-5 border-b border-gray-100">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-shopping-cart text-purple-500"></i>
                                Top Pembeli Minggu Ini
                            </h3>
                        </div>
                        <div class="p-4 overflow-x-auto">
                            @if($topBuyersThisWeek->count() > 0)
                                <div class="space-y-3">
                                    @foreach($topBuyersThisWeek as $index => $buyer)
                                        <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-gradient-to-br {{ $index === 0 ? 'from-yellow-400 to-amber-500' : 'from-purple-400 to-pink-500' }} flex items-center justify-center text-white font-bold text-sm">
                                                {{ $index + 1 }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-gray-800 truncate">{{ $buyer->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $buyer->orders_count }} pesanan</p>
                                            </div>
                                            <div class="text-right flex-shrink-0">
                                                <p class="font-bold text-purple-600">{{ number_format($buyer->total_carbon_saved, 1) }} kg</p>
                                                <p class="text-xs text-gray-400">CO2</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-shopping-cart text-gray-300 text-4xl mb-3"></i>
                                    <p class="text-gray-500 text-sm">Belum ada pembelian minggu ini</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent Orders -->
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden animate-fade-in-up">
                        <div class="bg-gradient-to-r from-blue-50 to-transparent p-4 md:p-5 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-shopping-bag text-blue-500"></i>
                                Pesanan Terbaru
                            </h3>
                            <a href="{{ route('admin.orders') }}" class="text-emerald-600 text-sm hover:underline">Lihat Semua</a>
                        </div>
                        <div class="p-4 overflow-x-auto">
                            <div class="space-y-3">
                                @forelse($recentOrders->take(5) as $order)
                                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                        <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-receipt text-emerald-600"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-gray-800 truncate">{{ $order->order_number }}</p>
                                            <p class="text-xs text-gray-500">{{ $order->user->name ?? 'Unknown' }} &bull; {{ $order->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="text-right flex-shrink-0">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-amber-100 text-amber-700',
                                                    'processing' => 'bg-blue-100 text-blue-700',
                                                    'shipped' => 'bg-purple-100 text-purple-700',
                                                    'completed' => 'bg-green-100 text-green-700',
                                                    'cancelled' => 'bg-red-100 text-red-700',
                                                ];
                                            @endphp
                                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                            <p class="text-xs text-gray-400 mt-1">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8">
                                        <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                                        <p class="text-gray-500 text-sm">Belum ada pesanan</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Pending Payments -->
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden animate-fade-in-up">
                        <div class="bg-gradient-to-r from-amber-50 to-transparent p-4 md:p-5 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-credit-card text-amber-500"></i>
                                Menunggu Pembayaran
                            </h3>
                            <a href="{{ route('admin.payments') }}" class="text-emerald-600 text-sm hover:underline">Lihat Semua</a>
                        </div>
                        <div class="p-4 overflow-x-auto">
                            @if($pendingPayments->count() > 0)
                                <div class="space-y-3">
                                    @foreach($pendingPayments as $payment)
                                        <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                            <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-clock text-amber-600"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-gray-800 truncate">{{ $payment->order_number }}</p>
                                                <p class="text-xs text-gray-500">{{ $payment->user->name ?? 'Unknown' }} &bull; {{ $payment->payment_method }}</p>
                                            </div>
                                            <div class="text-right flex-shrink-0">
                                                <p class="font-bold text-amber-600">Rp {{ number_format($payment->total_amount, 0, ',', '.') }}</p>
                                                <a href="{{ route('admin.payments') }}" class="text-xs text-emerald-600 hover:underline">Konfirmasi</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-check-circle text-green-300 text-4xl mb-3"></i>
                                    <p class="text-gray-500 text-sm">Tidak ada pembayaran tertunda</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Overview -->
                <div class="mt-6 md:mt-8 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3 md:gap-4 animate-fade-in-up">
                    <a href="{{ route('admin.users') }}" class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all text-center group">
                        <div class="w-10 h-10 mx-auto mb-2 rounded-lg bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                        <p class="text-xl font-bold text-gray-800">{{ $stats['total_users'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500">Total User</p>
                    </a>

                    <a href="{{ route('admin.products') }}" class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all text-center group">
                        <div class="w-10 h-10 mx-auto mb-2 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <i class="fas fa-box text-emerald-600"></i>
                        </div>
                        <p class="text-xl font-bold text-gray-800">{{ $stats['total_products'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500">Produk</p>
                    </a>

                    <a href="{{ route('admin.stores') }}" class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all text-center group">
                        <div class="w-10 h-10 mx-auto mb-2 rounded-lg bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-store text-purple-600"></i>
                        </div>
                        <p class="text-xl font-bold text-gray-800">{{ $stats['total_stores'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500">Toko</p>
                    </a>

                    <a href="{{ route('admin.orders') }}" class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all text-center group">
                        <div class="w-10 h-10 mx-auto mb-2 rounded-lg bg-teal-100 flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-teal-600"></i>
                        </div>
                        <p class="text-xl font-bold text-gray-800">{{ $stats['total_orders'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500">Pesanan</p>
                    </a>

                    <a href="{{ route('admin.complaints') }}" class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md hover:border-amber-200 transition-all text-center group">
                        <div class="w-10 h-10 mx-auto mb-2 rounded-lg bg-amber-100 flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-amber-600"></i>
                        </div>
                        <p class="text-xl font-bold text-gray-800">{{ $stats['pending_complaints'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500">Pengaduan</p>
                    </a>

                    <a href="{{ route('admin.payments') }}" class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md hover:border-amber-200 transition-all text-center group">
                        <div class="w-10 h-10 mx-auto mb-2 rounded-lg bg-orange-100 flex items-center justify-center">
                            <i class="fas fa-credit-card text-orange-600"></i>
                        </div>
                        <p class="text-xl font-bold text-gray-800">{{ $stats['pending_orders'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500">Bayar</p>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-eco-loop-layout>
