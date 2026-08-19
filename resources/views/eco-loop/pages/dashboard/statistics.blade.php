<x-eco-loop-layout title="Statistik Penjual - Eco-Loop">
    <!-- Seller Dashboard Header -->
    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <div class="text-white">
                        <h1 class="text-2xl md:text-3xl font-bold">Statistik Toko</h1>
                        <p class="text-emerald-100">Analisis performa penjualan Anda</p>
                    </div>
                </div>
                <a href="{{ route('dashboard') }}" class="hidden md:flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 rounded-xl text-white transition-all">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Growth Metrics -->
        <div class="mb-8 animate-fade-in-up">
            <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-chart-line text-emerald-500"></i>
                Performa Bulan Ini vs Bulan Lalu
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Revenue Growth -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
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
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-500 text-sm">Pesanan</span>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $growthMetrics['orders']['growth'] >= 0 ? 'bg-purple-100 text-purple-700' : 'bg-red-100 text-red-700' }}">
                            <i class="fas fa-arrow-{{ $growthMetrics['orders']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                            {{ abs($growthMetrics['orders']['growth']) }}%
                        </span>
                    </div>
                    <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $growthMetrics['orders']['current'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">Bulan lalu: {{ $growthMetrics['orders']['last'] }} pesanan</p>
                </div>

                <!-- This Month -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-500 text-sm">Rata-rata/Order</span>
                    </div>
                    <p class="text-2xl md:text-3xl font-bold text-emerald-600">
                        @if($growthMetrics['orders']['current'] > 0)
                            Rp {{ number_format($growthMetrics['revenue']['current'] / $growthMetrics['orders']['current'], 0, ',', '.') }}
                        @else
                            Rp 0
                        @endif
                    </p>
                    <p class="text-xs text-gray-400 mt-1">Per pesanan</p>
                </div>

                <!-- Total -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-500 text-sm">Total Produk</span>
                    </div>
                    <p class="text-2xl md:text-3xl font-bold text-gray-800">{{ $topProducts->count() > 0 ? $topProducts->first()->order_items_count + ($topProducts->count() - 1) : 0 }}+</p>
                    <p class="text-xs text-gray-400 mt-1">Produk terjual</p>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid lg:grid-cols-2 gap-6 mb-8">
            <!-- Revenue Chart -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 100ms;">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-chart-area text-emerald-500"></i>
                        Pendapatan per Bulan
                    </h3>
                    <span class="text-xs text-gray-400">12 bulan terakhir</span>
                </div>

                <div class="h-64 flex items-end justify-between gap-1">
                    @foreach($monthlyData['labels'] as $index => $label)
                        @php
                            $maxSales = max($monthlyData['sales']) ?: 1;
                            $height = ($monthlyData['sales'][$index] / $maxSales) * 100;
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

            <!-- Orders Chart -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 200ms;">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-chart-bar text-purple-500"></i>
                        Pesanan per Bulan
                    </h3>
                    <span class="text-xs text-gray-400">12 bulan terakhir</span>
                </div>

                <div class="h-64 flex items-end justify-between gap-1">
                    @foreach($monthlyData['labels'] as $index => $label)
                        @php
                            $maxOrders = max($monthlyData['orders']) ?: 1;
                            $height = ($monthlyData['orders'][$index] / $maxOrders) * 100;
                        @endphp
                        <div class="flex-1 flex flex-col items-center group relative">
                            <div class="w-full bg-gradient-to-t from-purple-500 to-purple-300 rounded-t-lg transition-all duration-500 hover:from-purple-600 hover:to-purple-400 min-h-[4px]"
                                 style="height: {{ max($height, 3) }}%;">
                            </div>
                            <span class="text-xs text-gray-400 mt-2 hidden group-hover:block absolute -bottom-6 whitespace-nowrap">{{ $label }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Last 7 Days & Top Products -->
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Last 7 Days Performance -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 300ms;">
                <h3 class="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fas fa-calendar-week text-teal-500"></i>
                    7 Hari Terakhir
                </h3>

                <div class="space-y-3">
                    @foreach($bestDays as $day)
                        <div class="flex items-center gap-3 p-2 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-teal-100 to-teal-200 flex items-center justify-center">
                                <span class="text-xs font-bold text-teal-700">{{ substr($day['day'], 0, 1) }}</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">{{ $day['day'] }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-emerald-600">Rp {{ number_format($day['revenue'], 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-400">{{ $day['orders'] }} pesanan</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Top Products -->
            <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 400ms;">
                <h3 class="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="fas fa-trophy text-amber-500"></i>
                    Produk Terlaris
                </h3>

                @if($topProducts->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-100">
                                    <th class="text-left py-3 px-2 text-xs font-semibold text-gray-500 uppercase">Produk</th>
                                    <th class="text-center py-3 px-2 text-xs font-semibold text-gray-500 uppercase">Terjual</th>
                                    <th class="text-right py-3 px-2 text-xs font-semibold text-gray-500 uppercase">Harga</th>
                                    <th class="text-right py-3 px-2 text-xs font-semibold text-gray-500 uppercase">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($topProducts as $index => $product)
                                    <tr class="hover:bg-emerald-50 transition-colors">
                                        <td class="py-3 px-2">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                                                    <span class="font-bold text-emerald-600">#{{ $index + 1 }}</span>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-800">{{ Str::limit($product->name, 25) }}</p>
                                                    <p class="text-xs text-gray-400">{{ $product->category->name ?? 'Tanpa Kategori' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-2 text-center">
                                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold">
                                                {{ $product->order_items_count }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-2 text-right text-gray-600">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 px-2 text-right font-semibold text-emerald-600">
                                            Rp {{ number_format($product->price * $product->order_items_count, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-box-open text-3xl text-gray-300"></i>
                        </div>
                        <p class="text-gray-500">Belum ada produk terjual</p>
                        <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600 transition-colors">
                            <i class="fas fa-plus"></i>
                            Tambah Produk
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sales by Category -->
        <div class="mt-6 bg-white rounded-2xl p-6 shadow-sm border border-gray-100 animate-fade-in-up" style="animation-delay: 500ms;">
            <h3 class="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                <i class="fas fa-tags text-indigo-500"></i>
                Penjualan per Kategori
            </h3>

            @if($salesByCategory->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @php
                        $maxRevenue = $salesByCategory->max('products_sum_price') ?: 1;
                    @endphp
                    @foreach($salesByCategory as $category)
                        @php
                            $percentage = ($category->products_sum_price ?? 0) / $maxRevenue * 100;
                        @endphp
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <div class="flex items-center justify-between mb-2">
                                <span class="flex items-center gap-2 font-semibold text-gray-700">
                                    <i class="{{ $category->icon ?? 'fas fa-folder' }} text-indigo-500"></i>
                                    {{ $category->name }}
                                </span>
                                <span class="text-xs text-gray-400">{{ $category->products_count }} produk</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden mb-2">
                                <div class="h-full bg-gradient-to-r from-indigo-500 to-indigo-400 rounded-full transition-all duration-500"
                                     style="width: {{ $percentage }}%"></div>
                            </div>
                            <p class="text-right font-bold text-indigo-600">
                                Rp {{ number_format($category->products_sum_price ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-center py-8">Belum ada data penjualan per kategori</p>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="mt-6 grid md:grid-cols-3 gap-4 animate-fade-in-up" style="animation-delay: 600ms;">
            <a href="{{ route('dashboard.products') }}" class="flex items-center gap-4 p-4 bg-white rounded-xl shadow-sm border border-gray-100 hover:border-emerald-300 hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                    <i class="fas fa-box text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Kelola Produk</p>
                    <p class="text-sm text-gray-500">Tambah atau edit produk</p>
                </div>
            </a>

            <a href="{{ route('dashboard.orders') }}" class="flex items-center gap-4 p-4 bg-white rounded-xl shadow-sm border border-gray-100 hover:border-purple-300 hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-shopping-bag text-purple-600 text-xl"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Lihat Pesanan</p>
                    <p class="text-sm text-gray-500">Kelola pesanan masuk</p>
                </div>
            </a>

            <a href="{{ route('store.edit') }}" class="flex items-center gap-4 p-4 bg-white rounded-xl shadow-sm border border-gray-100 hover:border-teal-300 hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-xl bg-teal-100 flex items-center justify-center">
                    <i class="fas fa-store text-teal-600 text-xl"></i>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Pengaturan Toko</p>
                    <p class="text-sm text-gray-500">Update info toko</p>
                </div>
            </a>
        </div>
    </div>
</x-eco-loop-layout>
