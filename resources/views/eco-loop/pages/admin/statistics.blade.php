<x-eco-loop-layout title="Statistik Platform - Admin">
    <div class="flex min-h-screen">
        <!-- Admin Sidebar -->
        <x-admin-sidebar :stats="[
            'pending_stores' => $stats['pending_stores'] ?? 0,
            'pending_complaints' => $stats['pending_complaints'] ?? 0
        ]" />

        <!-- Main Content -->
        <div class="flex-1 min-h-screen">
            <!-- Header -->
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-emerald-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div class="flex items-center gap-3 md:gap-4 animate-fade-in-up">
                            <div class="w-12 h-12 md:w-16 md:h-16 rounded-xl md:rounded-2xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center shadow-lg shadow-purple-200">
                                <i class="fas fa-chart-bar text-white text-xl md:text-2xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Statistik Platform</h1>
                                <p class="text-purple-600 text-sm md:text-base">Analisis performa dan insight bisnis</p>
                            </div>
                        </div>
                        <div class="glass-card-light px-4 py-2 animate-fade-in-up">
                            <span class="text-purple-700 text-sm">
                                <i class="fas fa-calendar mr-2"></i>{{ now()->format('F Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
                <!-- Growth Metrics -->
                <div class="mb-6 md:mb-8 animate-fade-in-up">
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-line text-purple-500"></i>
                        Performa Bulan Ini vs Bulan Lalu
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                        <!-- Revenue Growth -->
                        <div class="glass-card-light p-4 md:p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-500 text-sm">Pendapatan</span>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $growthMetrics['revenue']['growth'] >= 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    <i class="fas fa-arrow-{{ $growthMetrics['revenue']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                    {{ abs($growthMetrics['revenue']['growth']) }}%
                                </span>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800">Rp {{ number_format($growthMetrics['revenue']['current'], 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-400 mt-1">Bulan lalu: Rp {{ number_format($growthMetrics['revenue']['last'], 0, ',', '.') }}</p>
                        </div>

                        <!-- Orders Growth -->
                        <div class="glass-card-light p-4 md:p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-500 text-sm">Pesanan</span>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $growthMetrics['orders']['growth'] >= 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    <i class="fas fa-arrow-{{ $growthMetrics['orders']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                    {{ abs($growthMetrics['orders']['growth']) }}%
                                </span>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $growthMetrics['orders']['current'] }}</p>
                            <p class="text-xs text-gray-400 mt-1">Bulan lalu: {{ $growthMetrics['orders']['last'] }} pesanan</p>
                        </div>

                        <!-- Users Growth -->
                        <div class="glass-card-light p-4 md:p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-500 text-sm">Pengguna Baru</span>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $growthMetrics['new_users']['growth'] >= 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    <i class="fas fa-arrow-{{ $growthMetrics['new_users']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                    {{ abs($growthMetrics['new_users']['growth']) }}%
                                </span>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $growthMetrics['new_users']['current'] }}</p>
                            <p class="text-xs text-gray-400 mt-1">Bulan lalu: {{ $growthMetrics['new_users']['last'] }} pengguna</p>
                        </div>
                    </div>
                </div>

                <!-- Overview Stats -->
                <div class="mb-6 md:mb-8 animate-fade-in-up" style="animation-delay: 100ms;">
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-tachometer-alt text-emerald-500"></i>
                        Ringkasan Platform
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        <div class="glass-card-light p-4 text-center hover-lift">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ number_format($stats['total_users']) }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Total Pengguna</p>
                        </div>

                        <div class="glass-card-light p-4 text-center hover-lift">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-200 flex items-center justify-center">
                                <i class="fas fa-store text-emerald-600 text-xl"></i>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ number_format($stats['total_sellers']) }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Total Penjual</p>
                        </div>

                        <div class="glass-card-light p-4 text-center hover-lift">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
                                <i class="fas fa-box text-purple-600 text-xl"></i>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ number_format($stats['total_products']) }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Total Produk</p>
                        </div>

                        <div class="glass-card-light p-4 text-center hover-lift">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center">
                                <i class="fas fa-shopping-bag text-amber-600 text-xl"></i>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ number_format($stats['total_orders']) }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Total Pesanan</p>
                        </div>

                        <div class="glass-card-light p-4 text-center hover-lift col-span-2 md:col-span-4 lg:col-span-1">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gradient-to-br from-teal-100 to-teal-200 flex items-center justify-center">
                                <i class="fas fa-leaf text-teal-600 text-xl"></i>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ number_format($stats['total_carbon'], 1) }} kg</p>
                            <p class="text-xs md:text-sm text-gray-500">Karbon Terselamatkan</p>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid lg:grid-cols-2 gap-6 md:gap-8 mb-6 md:mb-8">
                    <!-- Monthly Revenue Chart -->
                    <div class="glass-card-light p-4 md:p-6 animate-fade-in-up" style="animation-delay: 200ms;">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fas fa-chart-area text-emerald-500"></i>
                                Pendapatan per Bulan
                            </h3>
                            <span class="text-sm text-gray-400">12 bulan terakhir</span>
                        </div>

                        <div class="h-64 flex items-end justify-between gap-1">
                            @foreach($monthlyTrends['labels'] as $index => $label)
                                @php
                                    $maxRevenue = max(array_column($monthlyTrends['data'], 'revenue')) ?: 1;
                                    $height = ($monthlyTrends['data'][$index]['revenue'] / $maxRevenue) * 100;
                                @endphp
                                <div class="flex-1 flex flex-col items-center group relative">
                                    <div class="w-full bg-gradient-to-t from-emerald-500 to-emerald-300 rounded-t-lg transition-all duration-500 hover:from-emerald-600 hover:to-emerald-400 min-h-[4px]"
                                         style="height: {{ max($height, 3) }}%;">
                                    </div>
                                    <span class="text-xs text-gray-400 mt-2 hidden group-hover:block absolute -bottom-6 whitespace-nowrap">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Carbon Savings Chart -->
                    <div class="glass-card-light p-4 md:p-6 animate-fade-in-up" style="animation-delay: 300ms;">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fas fa-leaf text-teal-500"></i>
                                Karbon Terselamatkan
                            </h3>
                            <span class="text-sm text-gray-400">12 bulan terakhir</span>
                        </div>

                        <div class="h-64 flex items-end justify-between gap-1">
                            @foreach($carbonByMonth['labels'] as $index => $label)
                                @php
                                    $maxCarbon = max($carbonByMonth['data']) ?: 1;
                                    $height = ($carbonByMonth['data'][$index] / $maxCarbon) * 100;
                                @endphp
                                <div class="flex-1 flex flex-col items-center group relative">
                                    <div class="w-full bg-gradient-to-t from-teal-500 to-teal-300 rounded-t-lg transition-all duration-500 hover:from-teal-600 hover:to-teal-400 min-h-[4px]"
                                         style="height: {{ max($height, 3) }}%;">
                                    </div>
                                    <span class="text-xs text-gray-400 mt-2 hidden group-hover:block absolute -bottom-6 whitespace-nowrap">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Status & Top Performers -->
                <div class="grid lg:grid-cols-3 gap-6 md:gap-8 mb-6 md:mb-8">
                    <!-- Order Status Distribution -->
                    <div class="glass-card-light p-4 md:p-6 animate-fade-in-up" style="animation-delay: 400ms;">
                        <h3 class="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                            <i class="fas fa-pie-chart text-purple-500"></i>
                            Distribusi Status Pesanan
                        </h3>

                        <div class="space-y-3">
                            @php
                                $total = array_sum($orderStatusDistribution);
                                $statusColors = [
                                    'pending' => 'bg-amber-500',
                                    'processing' => 'bg-blue-500',
                                    'shipped' => 'bg-purple-500',
                                    'completed' => 'bg-emerald-500',
                                    'cancelled' => 'bg-red-500',
                                ];
                            @endphp
                            @foreach($orderStatusDistribution as $status => $count)
                                @php
                                    $percentage = $total > 0 ? ($count / $total) * 100 : 0;
                                @endphp
                                <div>
                                    <div class="flex items-center justify-between text-sm mb-1">
                                        <span class="text-gray-600 capitalize">{{ ucfirst($status) }}</span>
                                        <span class="font-semibold text-gray-800">{{ $count }} ({{ number_format($percentage, 1) }}%)</span>
                                    </div>
                                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full {{ $statusColors[$status] }} rounded-full transition-all duration-500"
                                             style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Top Sellers -->
                    <div class="glass-card-light p-4 md:p-6 animate-fade-in-up" style="animation-delay: 500ms;">
                        <h3 class="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                            <i class="fas fa-trophy text-amber-500"></i>
                            Top 5 Penjual
                        </h3>

                        <div class="space-y-3">
                            @forelse($topSellers->take(5) as $index => $seller)
                                <div class="flex items-center gap-3 p-2 hover:bg-emerald-50 rounded-lg transition-colors">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white font-bold text-sm">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-800 truncate">{{ $seller->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $seller->products_count }} produk</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-emerald-600">Rp {{ number_format($seller->products_sum_price ?? 0, 0, ',', '.') }}</p>
                                        <p class="text-xs text-gray-400">total penjualan</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-400 text-center py-4">Belum ada data penjual</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Top Buyers -->
                    <div class="glass-card-light p-4 md:p-6 animate-fade-in-up" style="animation-delay: 600ms;">
                        <h3 class="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                            <i class="fas fa-star text-yellow-500"></i>
                            Top 5 Pembeli
                        </h3>

                        <div class="space-y-3">
                            @forelse($topBuyers->take(5) as $index => $buyer)
                                <div class="flex items-center gap-3 p-2 hover:bg-emerald-50 rounded-lg transition-colors">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-800 truncate">{{ $buyer->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $buyer->orders_count ?? 0 }} pesanan</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-purple-600">Rp {{ number_format($buyer->orders_sum_total_amount ?? 0, 0, ',', '.') }}</p>
                                        <p class="text-xs text-gray-400">total belanja</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-400 text-center py-4">Belum ada data pembeli</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Category Performance & Revenue by Region -->
                <div class="grid lg:grid-cols-2 gap-6 md:gap-8">
                    <!-- Category Performance -->
                    <div class="glass-card-light p-4 md:p-6 animate-fade-in-up" style="animation-delay: 700ms;">
                        <h3 class="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                            <i class="fas fa-tags text-indigo-500"></i>
                            Performa Kategori
                        </h3>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="glass-table-header-light">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-emerald-700 uppercase">Kategori</th>
                                        <th class="px-4 py-3 text-center text-xs font-semibold text-emerald-700 uppercase">Produk</th>
                                        <th class="px-4 py-3 text-right text-xs font-semibold text-emerald-700 uppercase">Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($categoryPerformance->take(8) as $category)
                                        <tr class="hover:bg-emerald-50 transition-colors">
                                            <td class="px-4 py-3">
                                                <span class="flex items-center gap-2">
                                                    <i class="{{ $category->icon ?? 'fas fa-folder' }} text-indigo-500"></i>
                                                    {{ $category->name }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-center text-gray-600">{{ $category->products_count }}</td>
                                            <td class="px-4 py-3 text-right font-semibold text-emerald-600">
                                                Rp {{ number_format($category->products_sum_price ?? 0, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-8 text-center text-gray-400">Belum ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Revenue by Region -->
                    <div class="glass-card-light p-4 md:p-6 animate-fade-in-up" style="animation-delay: 800ms;">
                        <h3 class="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                            <i class="fas fa-map-marked-alt text-rose-500"></i>
                            Pendapatan per Region
                        </h3>

                        <div class="space-y-3">
                            @php
                                $maxRevenue = $revenueByRegion->max('revenue') ?: 1;
                            @endphp
                            @forelse($revenueByRegion->take(8) as $region)
                                @php
                                    $percentage = ($region->revenue ?? 0) / $maxRevenue * 100;
                                @endphp
                                <div class="flex items-center gap-3">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-sm font-medium text-gray-700">{{ $region->name }}</span>
                                            <span class="text-xs text-gray-500">{{ $region->users_count }} pengguna</span>
                                        </div>
                                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full bg-gradient-to-r from-rose-400 to-rose-500 rounded-full transition-all duration-500"
                                                 style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800 whitespace-nowrap">
                                        Rp {{ number_format($region->revenue ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-gray-400 text-center py-8">Belum ada data region</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
