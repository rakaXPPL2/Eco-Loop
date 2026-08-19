<x-eco-loop-layout title="Panel Admin - Eco-Loop">
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
                                <i class="fas fa-shield-alt text-white text-xl md:text-2xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Panel Admin</h1>
                                <p class="text-emerald-600 text-sm md:text-base">Kelola platform Eco-Loop</p>
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
                <!-- Admin Notice -->
                <div class="glass-card-light p-3 md:p-4 mb-6 md:mb-8 animate-fade-in-up border-l-4 border-amber-400">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg md:rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-amber-600 text-sm md:text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-amber-800 text-sm md:text-base">Mode Administrator</h3>
                            <p class="text-xs md:text-sm text-gray-600">Sebagai admin, Anda bertugas memantau dan menanggapi pengaduan. Gunakan akun Pembeli atau Penjual untuk bertransaksi.</p>
                        </div>
                    </div>
                </div>

                <!-- Weekly Sales Chart Section -->
                <div class="mb-6 md:mb-8 animate-fade-in-up" style="animation-delay: 100ms;">
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-line text-emerald-500"></i>
                        Proses Penjualan Minggu Ini
                    </h2>

                    <!-- Weekly Summary Cards -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-4">
                        <div class="glass-card-light p-3 md:p-4 text-center">
                            <p class="text-2xl md:text-3xl font-bold text-emerald-600">{{ number_format($weeklySales['weekly_total'], 0, ',', '.') }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Total Penjualan (Rp)</p>
                        </div>
                        <div class="glass-card-light p-3 md:p-4 text-center">
                            <p class="text-2xl md:text-3xl font-bold text-purple-600">{{ $weeklySales['weekly_orders'] }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Jumlah Pesanan</p>
                        </div>
                        <div class="glass-card-light p-3 md:p-4 text-center">
                            <p class="text-2xl md:text-3xl font-bold text-teal-600">{{ array_sum($weeklySales['sales']) > 0 ? round(array_sum($weeklySales['sales']) / array_sum($weeklySales['orders']) / 1000) : 0 }}K</p>
                            <p class="text-xs md:text-sm text-gray-500">Rata-rata Pesanan (Rb)</p>
                        </div>
                        <div class="glass-card-light p-3 md:p-4 text-center">
                            <p class="text-2xl md:text-3xl font-bold text-amber-600">{{ $stats['pending_complaints'] ?? 0 }}</p>
                            <p class="text-xs md:text-sm text-gray-500">Pengaduan Pending</p>
                        </div>
                    </div>

                    <!-- Chart Container -->
                    <div class="glass-card-light p-4 md:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-700 text-sm md:text-base">Grafik Penjualan 7 Hari Terakhir</h3>
                            <div class="flex items-center gap-4 text-xs md:text-sm">
                                <span class="flex items-center gap-1">
                                    <span class="w-3 h-3 rounded bg-emerald-500"></span> Penjualan
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="w-3 h-3 rounded bg-purple-400"></span> Pesanan
                                </span>
                            </div>
                        </div>

                        <!-- Simple Bar Chart using CSS -->
                        <div class="flex items-end justify-between gap-1 md:gap-2 h-40 md:h-52">
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
                                    <div class="w-full flex flex-col items-center">
                                        <div class="w-full bg-gradient-to-t from-emerald-500 to-emerald-300 rounded-t-lg transition-all duration-500 hover:opacity-80 relative group min-h-[4px]"
                                             style="height: {{ max($salesHeight, 5) }}%;">
                                            @if($weeklySales['sales'][$index] > 0)
                                                <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                                    Rp {{ number_format($weeklySales['sales'][$index], 0, ',', '.') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Orders Bar (secondary) -->
                                    <div class="w-full bg-gradient-to-t from-purple-400 to-purple-300 rounded-t-lg transition-all duration-500 hover:opacity-80 relative group min-h-[4px]"
                                         style="height: {{ max($ordersHeight, 5) }}%;">
                                        @if($weeklySales['orders'][$index] > 0)
                                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-purple-600 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                                {{ $weeklySales['orders'][$index] }} pesanan
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Day Label -->
                                    <span class="text-xs text-gray-500 mt-2">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Sales Details per Day -->
                        <div class="mt-4 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-2">
                            @foreach($weeklySales['labels'] as $index => $label)
                                <div class="text-center p-2 bg-gray-50 rounded-lg">
                                    <p class="text-xs text-gray-500 mb-1">{{ $label }}</p>
                                    <p class="text-sm font-semibold text-emerald-600">Rp {{ number_format($weeklySales['sales'][$index], 0, ',', '.') }}</p>
                                    <p class="text-xs text-purple-500">{{ $weeklySales['orders'][$index] }} pesanan</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Stats Cards - Light Theme - Responsive Grid -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 mb-6 md:mb-8 stagger-children">
                    <!-- Pending Complaints -->
                    <div class="glass-card-light animate-fade-in-up hover-lift group">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center justify-between mb-3 md:mb-4">
                                <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-gradient-to-br from-amber-100 to-orange-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-exclamation-circle text-amber-600 text-lg md:text-2xl"></i>
                                </div>
                                <span class="px-2 md:px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                                    <i class="fas fa-clock mr-1"></i>Pending
                                </span>
                            </div>
                            <p class="text-2xl md:text-4xl font-bold text-gray-800 mb-1">{{ $stats['pending_complaints'] ?? 0 }}</p>
                            <p class="text-gray-500 text-xs md:text-sm">Pengaduan Pending</p>
                        </div>
                        <div class="h-1 bg-gradient-to-r from-amber-400 to-orange-400 rounded-b-xl md:rounded-b-2xl"></div>
                    </div>

                    <!-- Pending Stores -->
                    <div class="glass-card-light animate-fade-in-up hover-lift group" style="animation-delay: 100ms;">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center justify-between mb-3 md:mb-4">
                                <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-gradient-to-br from-blue-100 to-cyan-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-store text-blue-600 text-lg md:text-2xl"></i>
                                </div>
                                <span class="px-2 md:px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                    <i class="fas fa-clock mr-1"></i>Verifikasi
                                </span>
                            </div>
                            <p class="text-2xl md:text-4xl font-bold text-gray-800 mb-1">{{ $stats['pending_stores'] ?? 0 }}</p>
                            <p class="text-gray-500 text-xs md:text-sm">Toko Pending</p>
                        </div>
                        <div class="h-1 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-b-xl md:rounded-b-2xl"></div>
                    </div>

                    <!-- Total Sellers -->
                    <div class="glass-card-light animate-fade-in-up hover-lift group" style="animation-delay: 200ms;">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center justify-between mb-3 md:mb-4">
                                <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-gradient-to-br from-emerald-100 to-green-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-users-cog text-emerald-600 text-lg md:text-2xl"></i>
                                </div>
                                <span class="px-2 md:px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                    <i class="fas fa-chart-line mr-1"></i>Aktif
                                </span>
                            </div>
                            <p class="text-2xl md:text-4xl font-bold text-gray-800 mb-1">{{ $stats['total_sellers'] ?? 0 }}</p>
                            <p class="text-gray-500 text-xs md:text-sm">Total Penjual</p>
                        </div>
                        <div class="h-1 bg-gradient-to-r from-emerald-400 to-green-400 rounded-b-xl md:rounded-b-2xl"></div>
                    </div>

                    <!-- Total Carbon -->
                    <div class="glass-card-light animate-fade-in-up hover-lift group" style="animation-delay: 300ms;">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center justify-between mb-3 md:mb-4">
                                <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-gradient-to-br from-teal-100 to-cyan-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-leaf text-teal-600 text-lg md:text-2xl"></i>
                                </div>
                                <span class="px-2 md:px-3 py-1 rounded-full text-xs font-semibold bg-teal-100 text-teal-700">
                                    <i class="fas fa-globe mr-1"></i>Impact
                                </span>
                            </div>
                            <p class="text-xl md:text-3xl font-bold text-gray-800 mb-1">{{ number_format($stats['total_carbon'] ?? 0, 1) }} <span class="text-base md:text-lg text-emerald-600">kg</span></p>
                            <p class="text-gray-500 text-xs md:text-sm">Total Karbon Terselamatkan</p>
                        </div>
                        <div class="h-1 bg-gradient-to-r from-teal-400 to-cyan-400 rounded-b-xl md:rounded-b-2xl"></div>
                    </div>
                </div>

                <!-- Quick Management Links - Responsive Grid -->
                <div class="mb-6 md:mb-8 animate-fade-in-up" style="animation-delay: 400ms;">
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-bolt text-emerald-500"></i>
                        Manajemen Cepat
                    </h2>
                    <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-5 gap-2 md:gap-4">
                        <a href="{{ route('admin.complaints') }}" class="glass-card-light p-3 md:p-4 text-center hover-lift group">
                            <div class="w-10 h-10 md:w-12 md:h-12 mx-auto mb-2 md:mb-3 rounded-lg md:rounded-xl bg-gradient-to-br from-amber-100 to-orange-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-exclamation-circle text-xl md:text-2xl text-amber-600"></i>
                            </div>
                            <p class="font-semibold text-gray-700 text-xs md:text-sm">Pengaduan</p>
                            @if(($stats['pending_complaints'] ?? 0) > 0)
                                <span class="inline-block mt-1 md:mt-2 px-1.5 md:px-2 py-0.5 md:py-1 bg-red-100 text-red-600 text-xs font-bold rounded-full animate-pulse">{{ $stats['pending_complaints'] }}</span>
                            @endif
                        </a>
                        <a href="{{ route('admin.stores') }}" class="glass-card-light p-3 md:p-4 text-center hover-lift group">
                            <div class="w-10 h-10 md:w-12 md:h-12 mx-auto mb-2 md:mb-3 rounded-lg md:rounded-xl bg-gradient-to-br from-blue-100 to-cyan-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-store text-xl md:text-2xl text-blue-600"></i>
                            </div>
                            <p class="font-semibold text-gray-700 text-xs md:text-sm">Toko</p>
                        </a>
                        <a href="{{ route('admin.orders') }}" class="glass-card-light p-3 md:p-4 text-center hover-lift group">
                            <div class="w-10 h-10 md:w-12 md:h-12 mx-auto mb-2 md:mb-3 rounded-lg md:rounded-xl bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-shopping-bag text-xl md:text-2xl text-purple-600"></i>
                            </div>
                            <p class="font-semibold text-gray-700 text-xs md:text-sm">Transaksi</p>
                        </a>
                        <a href="{{ route('admin.regions') }}" class="glass-card-light p-3 md:p-4 text-center hover-lift group">
                            <div class="w-10 h-10 md:w-12 md:h-12 mx-auto mb-2 md:mb-3 rounded-lg md:rounded-xl bg-gradient-to-br from-teal-100 to-emerald-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-map-marked-alt text-xl md:text-2xl text-teal-600"></i>
                            </div>
                            <p class="font-semibold text-gray-700 text-xs md:text-sm">Region</p>
                        </a>
                        <a href="{{ route('admin.users') }}" class="glass-card-light p-3 md:p-4 text-center hover-lift group">
                            <div class="w-10 h-10 md:w-12 md:h-12 mx-auto mb-2 md:mb-3 rounded-lg md:rounded-xl bg-gradient-to-br from-pink-100 to-rose-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-users text-xl md:text-2xl text-pink-600"></i>
                            </div>
                            <p class="font-semibold text-gray-700 text-xs md:text-sm">Pengguna</p>
                        </a>
                    </div>
                </div>

                <!-- Two Column Layout for Tables - Responsive -->
                <div class="grid lg:grid-cols-2 gap-4 md:gap-8">
                    <!-- Pending Complaints -->
                    <div class="glass-card-light overflow-hidden animate-fade-in-up" style="animation-delay: 500ms;">
                        <div class="p-4 md:p-6 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <h3 class="text-base md:text-lg font-bold text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-exclamation-circle text-amber-500"></i> Pengaduan Pending
                                </h3>
                                <a href="{{ route('admin.complaints') }}" class="text-emerald-600 hover:text-emerald-700 text-xs md:text-sm font-medium flex items-center gap-1">
                                    Lihat Semua <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-100 max-h-[350px] md:max-h-[400px] overflow-y-auto">
                            @forelse($recentComplaints as $complaint)
                                <div class="p-3 md:p-4 hover:bg-emerald-50 transition-colors">
                                    <div class="flex items-start gap-2 md:gap-3">
                                        <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg md:rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-exclamation text-amber-600 text-sm"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-semibold text-gray-800 truncate text-sm">{{ $complaint->subject }}</span>
                                                <span class="px-1.5 md:px-2 py-0.5 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full">
                                                    {{ ucfirst($complaint->status) }}
                                                </span>
                                            </div>
                                            <p class="text-xs md:text-sm text-gray-500 line-clamp-1 md:line-clamp-2">{{ Str::limit($complaint->description, 50) }}</p>
                                            <div class="flex items-center gap-2 md:gap-4 mt-1 md:mt-2 text-xs text-gray-400">
                                                <span><i class="fas fa-user mr-1"></i>{{ $complaint->user->name }}</span>
                                                <span><i class="fas fa-clock mr-1"></i>{{ $complaint->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 md:p-12 text-center">
                                    <div class="w-12 h-12 md:w-16 md:h-16 mx-auto mb-3 md:mb-4 rounded-full bg-emerald-100 flex items-center justify-center">
                                        <i class="fas fa-check-circle text-3xl md:text-4xl text-emerald-500"></i>
                                    </div>
                                    <p class="text-gray-500 text-sm">Tidak ada pengaduan pending</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="glass-card-light overflow-hidden animate-fade-in-up" style="animation-delay: 600ms;">
                        <div class="p-4 md:p-6 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <h3 class="text-base md:text-lg font-bold text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-shopping-bag text-purple-500"></i> Transaksi Terbaru
                                </h3>
                                <a href="{{ route('admin.orders') }}" class="text-emerald-600 hover:text-emerald-700 text-xs md:text-sm font-medium flex items-center gap-1">
                                    Lihat Semua <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="glass-table-header-light">
                                    <tr>
                                        <th class="px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-emerald-700 uppercase tracking-wider">Order</th>
                                        <th class="px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-emerald-700 uppercase tracking-wider hidden sm:table-cell">Total</th>
                                        <th class="px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-emerald-700 uppercase tracking-wider hidden md:table-cell">Karbon</th>
                                        <th class="px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-emerald-700 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($recentOrders as $order)
                                        <tr class="hover:bg-emerald-50 transition-colors">
                                            <td class="px-3 md:px-4 py-3 md:py-4">
                                                <span class="font-mono text-emerald-600 font-semibold text-xs md:text-sm">{{ $order->order_number }}</span>
                                                <p class="text-xs text-gray-400 hidden sm:block">{{ $order->user->name }}</p>
                                            </td>
                                            <td class="px-3 md:px-4 py-3 md:py-4 text-gray-800 font-semibold text-xs md:text-sm hidden sm:table-cell">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                            <td class="px-3 md:px-4 py-3 md:py-4 hidden md:table-cell">
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 md:py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                                                    <i class="fas fa-leaf mr-0.5 md:mr-1"></i>{{ number_format($order->total_carbon_saved, 1) }} kg
                                                </span>
                                            </td>
                                            <td class="px-3 md:px-4 py-3 md:py-4">
                                                @php
                                                    $statusColors = [
                                                        'pending' => 'status-pending',
                                                        'completed' => 'status-completed',
                                                        'cancelled' => 'status-cancelled',
                                                    ];
                                                @endphp
                                                <span class="inline-block px-2 py-0.5 md:py-1 rounded-full text-xs font-semibold {{ $statusColors[$order->status] ?? '' }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-8 md:py-12 text-center text-gray-400">
                                                <i class="fas fa-inbox text-2xl md:text-3xl text-gray-300 mb-2 block"></i>
                                                Belum ada transaksi
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- System Health Indicators - Responsive Grid -->
                <div class="mt-6 md:mt-8 animate-fade-in-up" style="animation-delay: 700ms;">
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-heartbeat text-red-500"></i>
                        Status Sistem
                    </h2>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 md:gap-4">
                        <div class="glass-card-light p-3 md:p-4">
                            <div class="flex items-center gap-2 md:gap-3">
                                <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg md:rounded-xl bg-emerald-100 flex items-center justify-center">
                                    <i class="fas fa-server text-emerald-600 text-sm md:text-base"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 font-semibold text-sm md:text-base">Server</p>
                                    <p class="text-emerald-600 text-xs md:text-sm flex items-center gap-1">
                                        <i class="fas fa-check-circle"></i> Online
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="glass-card-light p-3 md:p-4">
                            <div class="flex items-center gap-2 md:gap-3">
                                <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg md:rounded-xl bg-emerald-100 flex items-center justify-center">
                                    <i class="fas fa-database text-emerald-600 text-sm md:text-base"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 font-semibold text-sm md:text-base">Database</p>
                                    <p class="text-emerald-600 text-xs md:text-sm flex items-center gap-1">
                                        <i class="fas fa-check-circle"></i> Connected
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="glass-card-light p-3 md:p-4">
                            <div class="flex items-center gap-2 md:gap-3">
                                <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg md:rounded-xl bg-emerald-100 flex items-center justify-center">
                                    <i class="fas fa-shield-virus text-emerald-600 text-sm md:text-base"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 font-semibold text-sm md:text-base">Keamanan</p>
                                    <p class="text-emerald-600 text-xs md:text-sm flex items-center gap-1">
                                        <i class="fas fa-check-circle"></i> Protected
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="glass-card-light p-3 md:p-4">
                            <div class="flex items-center gap-2 md:gap-3">
                                <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg md:rounded-xl bg-emerald-100 flex items-center justify-center">
                                    <i class="fas fa-cloud text-emerald-600 text-sm md:text-base"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 font-semibold text-sm md:text-base">API</p>
                                    <p class="text-emerald-600 text-xs md:text-sm flex items-center gap-1">
                                        <i class="fas fa-check-circle"></i> Active
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
