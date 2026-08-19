<x-eco-loop-layout title="Dashboard">
    @php
        $user = auth()->user();
        $isAdmin = $user->isAdmin();
        $isSeller = $user->isSeller();
        $isBuyer = $user->isBuyer();
    @endphp

    <div class="min-h-screen bg-gradient-to-br from-emerald-50/30 via-white to-teal-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
            <!-- Welcome Hero Section - Role Based -->
            <div class="relative bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl p-8 overflow-hidden shadow-xl shadow-emerald-500/20 animate-fade-in-up">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/4"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/4"></div>

                <div class="relative flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md rounded-full px-4 py-2 mb-4 border border-white/30">
                            <i class="fas fa-leaf text-emerald-200 animate-pulse"></i>
                            <span class="text-sm font-medium text-white">
                                @if($isAdmin)
                                    Administrator Platform
                                @elseif($isSeller)
                                    Penjual Eco-Friendly
                                @else
                                    Pembeli Hijau
                                @endif
                            </span>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">
                            <span class="bg-gradient-to-r from-emerald-200 via-teal-200 to-green-200 bg-clip-text text-transparent">
                                @if($isAdmin)
                                    Selamat Datang, {{ $user->name }}!
                                @else
                                    Selamat Datang, {{ $user->name }}!
                                @endif
                            </span>
                        </h1>
                        <p class="text-lg text-white/90 flex items-center gap-2">
                            <i class="fas fa-globe-americas text-emerald-200"></i>
                            @if($isAdmin)
                                Kelola platform Eco-Loop dengan baik! 🌱
                            @elseif($isSeller)
                                Kelola produk Anda dan berkontribusi untuk bumi!
                            @else
                                Setiap pembelian membantu menyelamatkan bumi! 🌍
                            @endif
                        </p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/30">
                            @if($isAdmin)
                                <i class="fas fa-shield-alt text-4xl text-emerald-200"></i>
                            @elseif($isSeller)
                                <i class="fas fa-store text-4xl text-emerald-200"></i>
                            @else
                                <i class="fas fa-seedling text-4xl text-emerald-200"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards with Animated Counters - Role Based -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 stagger-children">
                @if($isAdmin)
                    <!-- Admin Stats -->
                    <!-- Total Users -->
                    <div class="bg-white rounded-2xl p-5 border border-emerald-100 hover:border-emerald-300 transition-all duration-500 hover:shadow-lg hover:shadow-emerald-500/10 animate-fade-in-up group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:shadow-emerald-400/50 transition-all">
                                <i class="fas fa-users text-white text-lg"></i>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-user-friends text-emerald-600 text-xs"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Total Pengguna</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ $stats['total_users'] ?? 0 }}">0</span>
                            <span class="text-sm font-medium text-gray-500">orang</span>
                        </div>
                        <div class="mt-2 h-1 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-400 rounded-full progress-bar" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Total Products -->
                    <div class="bg-white rounded-2xl p-5 border border-teal-100 hover:border-teal-300 transition-all duration-500 hover:shadow-lg hover:shadow-teal-500/10 animate-fade-in-up group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center shadow-lg shadow-teal-500/30 group-hover:shadow-teal-400/50 transition-all">
                                <i class="fas fa-box text-white text-lg"></i>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center">
                                <i class="fas fa-boxes text-teal-600 text-xs"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Total Produk</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ $stats['total_products'] ?? 0 }}">0</span>
                            <span class="text-sm font-medium text-gray-500">item</span>
                        </div>
                        <div class="mt-2 h-1 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-teal-500 to-cyan-400 rounded-full progress-bar" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Pending Orders -->
                    <div class="bg-white rounded-2xl p-5 border border-orange-100 hover:border-orange-300 transition-all duration-500 hover:shadow-lg hover:shadow-orange-500/10 animate-fade-in-up group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center shadow-lg shadow-orange-500/30 group-hover:shadow-orange-400/50 transition-all">
                                <i class="fas fa-clock text-white text-lg"></i>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center">
                                <i class="fas fa-hourglass-half text-orange-600 text-xs"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Menunggu Diproses</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ $stats['pending_orders'] ?? 0 }}">0</span>
                            <span class="text-sm font-medium text-gray-500">pesanan</span>
                        </div>
                        <div class="mt-2 h-1 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-orange-500 to-amber-400 rounded-full progress-bar" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Total Sales -->
                    <div class="bg-white rounded-2xl p-5 border border-green-100 hover:border-green-300 transition-all duration-500 hover:shadow-lg hover:shadow-green-500/10 animate-fade-in-up group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center shadow-lg shadow-green-500/30 group-hover:shadow-green-400/50 transition-all">
                                <i class="fas fa-coins text-white text-lg"></i>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-green-600 text-xs"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Total Penjualan</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-2xl font-bold text-gray-800">Rp</span>
                            <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ $stats['total_sales'] ?? 0 }}" data-decimals="0">0</span>
                        </div>
                        <div class="mt-2 h-1 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-500 to-lime-400 rounded-full progress-bar" style="width: 0%"></div>
                        </div>
                    </div>

                @elseif($isSeller)
                    <!-- Seller Stats -->
                    <!-- Carbon Saved -->
                    <div class="bg-white rounded-2xl p-5 border border-emerald-100 hover:border-emerald-300 transition-all duration-500 hover:shadow-lg hover:shadow-emerald-500/10 animate-fade-in-up group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:shadow-emerald-400/50 transition-all">
                                <i class="fas fa-cloud text-white text-lg"></i>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-leaf text-emerald-600 text-xs"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Karbon Dihemat</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ $stats['total_carbon'] }}" data-decimals="1">0</span>
                            <span class="text-lg font-medium text-gray-500">kg</span>
                        </div>
                        <div class="mt-2 h-1 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-400 rounded-full progress-bar" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Pending Orders -->
                    <div class="bg-white rounded-2xl p-5 border border-teal-100 hover:border-teal-300 transition-all duration-500 hover:shadow-lg hover:shadow-teal-500/10 animate-fade-in-up group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center shadow-lg shadow-teal-500/30 group-hover:shadow-teal-400/50 transition-all">
                                <i class="fas fa-shopping-bag text-white text-lg"></i>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center">
                                <i class="fas fa-bell text-teal-600 text-xs"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Pesanan Masuk</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ $stats['pending_orders'] ?? 0 }}">0</span>
                            <span class="text-sm font-medium text-gray-500">baru</span>
                        </div>
                        <div class="mt-2 h-1 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-teal-500 to-cyan-400 rounded-full progress-bar" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Products Listed -->
                    <div class="bg-white rounded-2xl p-5 border border-green-100 hover:border-green-300 transition-all duration-500 hover:shadow-lg hover:shadow-green-500/10 animate-fade-in-up group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center shadow-lg shadow-green-500/30 group-hover:shadow-green-400/50 transition-all">
                                <i class="fas fa-box text-white text-lg"></i>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-list text-green-600 text-xs"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Produk Saya</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ $stats['products_listed'] ?? 0 }}">0</span>
                            <span class="text-sm font-medium text-gray-500">item</span>
                        </div>
                        <div class="mt-2 h-1 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-500 to-lime-400 rounded-full progress-bar" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Products Sold -->
                    <div class="bg-white rounded-2xl p-5 border border-amber-100 hover:border-amber-300 transition-all duration-500 hover:shadow-lg hover:shadow-amber-500/10 animate-fade-in-up group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:shadow-amber-400/50 transition-all">
                                <i class="fas fa-check-circle text-white text-lg"></i>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center">
                                <i class="fas fa-star text-amber-600 text-xs"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Produk Terjual</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ $stats['products_sold'] ?? 0 }}">0</span>
                            <span class="text-sm font-medium text-gray-500">unit</span>
                        </div>
                        <div class="mt-2 h-1 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-amber-500 to-yellow-400 rounded-full progress-bar" style="width: 0%"></div>
                        </div>
                    </div>

                @else
                    <!-- Buyer Stats -->
                    <!-- Carbon Saved -->
                    <div class="bg-white rounded-2xl p-5 border border-emerald-100 hover:border-emerald-300 transition-all duration-500 hover:shadow-lg hover:shadow-emerald-500/10 animate-fade-in-up group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:shadow-emerald-400/50 transition-all">
                                <i class="fas fa-cloud text-white text-lg"></i>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-leaf text-emerald-600 text-xs"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Karbon Dihemat</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ $stats['total_carbon'] }}" data-decimals="1">0</span>
                            <span class="text-lg font-medium text-gray-500">kg</span>
                        </div>
                        <div class="mt-2 h-1 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-400 rounded-full progress-bar" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Total Orders -->
                    <div class="bg-white rounded-2xl p-5 border border-teal-100 hover:border-teal-300 transition-all duration-500 hover:shadow-lg hover:shadow-teal-500/10 animate-fade-in-up group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center shadow-lg shadow-teal-500/30 group-hover:shadow-teal-400/50 transition-all">
                                <i class="fas fa-shopping-bag text-white text-lg"></i>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-teal-600 text-xs"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Pesanan Saya</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ $stats['total_orders'] }}">0</span>
                            <span class="text-sm font-medium text-gray-500">transaksi</span>
                        </div>
                        <div class="mt-2 h-1 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-teal-500 to-cyan-400 rounded-full progress-bar" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Vouchers -->
                    <div class="bg-white rounded-2xl p-5 border border-green-100 hover:border-green-300 transition-all duration-500 hover:shadow-lg hover:shadow-green-500/10 animate-fade-in-up group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center shadow-lg shadow-green-500/30 group-hover:shadow-green-400/50 transition-all">
                                <i class="fas fa-ticket-alt text-white text-lg"></i>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-gift text-green-600 text-xs"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Voucher Saya</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ $stats['total_vouchers'] }}">0</span>
                            <span class="text-sm font-medium text-gray-500">kupon</span>
                        </div>
                        <div class="mt-2 h-1 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-500 to-lime-400 rounded-full progress-bar" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Rank -->
                    <div class="bg-white rounded-2xl p-5 border border-amber-100 hover:border-amber-300 transition-all duration-500 hover:shadow-lg hover:shadow-amber-500/10 animate-fade-in-up group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-purple-600 flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:shadow-amber-400/50 transition-all">
                                <i class="fas fa-trophy text-white text-lg"></i>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center">
                                <i class="fas fa-star text-amber-600 text-xs"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-1">Peringkat Anda</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-gray-800">#</span>
                            <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ $user->rank ?? 0 }}">0</span>
                        </div>
                        <div class="mt-2 h-1 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-amber-500 to-yellow-400 rounded-full progress-bar" style="width: 0%"></div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Orders - White Card -->
                <div class="lg:col-span-2 bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-fade-in-up">
                    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-transparent">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                                    <i class="fas fa-shopping-bag text-white"></i>
                                </div>
                                @if($isAdmin)
                                    Pesanan Terbaru
                                @elseif($isSeller)
                                    Pesanan Masuk
                                @else
                                    Pesanan Saya
                                @endif
                            </h2>
                            <a href="{{ route('dashboard.orders') }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-semibold flex items-center gap-1 transition-all hover:gap-2">
                                Lihat Semua <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-4 space-y-3">
                        @forelse($recentOrders as $order)
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 hover:border-emerald-200 transition-all duration-300 group">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center group-hover:from-emerald-200 group-hover:to-teal-200 transition-all">
                                            <i class="fas fa-box text-emerald-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $order->order_number }}</p>
                                            <p class="text-sm text-gray-500 flex items-center gap-1">
                                                @if($isAdmin)
                                                    <i class="fas fa-user text-gray-400"></i> {{ $order->user->name ?? 'Unknown' }}
                                                @elseif($isSeller)
                                                    <i class="fas fa-user text-gray-400"></i> {{ $order->user->name ?? 'Pembeli' }}
                                                @else
                                                    <i class="fas fa-calendar text-gray-400"></i> {{ $order->created_at->format('d M Y') }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-gray-800">Rp {{ number_format($order->total, 0) }}</p>
                                        <p class="text-sm text-emerald-600 flex items-center justify-end gap-1">
                                            <i class="fas fa-leaf text-xs"></i> {{ $order->carbon_saved ?? 0 }} kg
                                        </p>
                                    </div>
                                </div>
                                <!-- Order Status Badge -->
                                <div class="mt-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                        @if($order->status === 'completed') bg-green-100 text-green-800
                                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                        @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                                        @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        <i class="fas fa-circle text-xs mr-1"></i>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-inbox text-3xl text-gray-300"></i>
                                </div>
                                <p class="text-gray-500 mb-4">Belum ada pesanan</p>
                                @if($user->canBuy())
                                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all shadow-lg shadow-emerald-500/30">
                                        <i class="fas fa-store"></i> Mulai Belanja
                                    </a>
                                @elseif($isSeller)
                                    <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all shadow-lg shadow-emerald-500/30">
                                        <i class="fas fa-plus"></i> Tambah Produk
                                    </a>
                                @endif
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions - White Card -->
                    <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-fade-in-up">
                        <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-amber-50 to-transparent">
                            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/30">
                                    <i class="fas fa-bolt text-white"></i>
                                </div>
                                Aksi Cepat
                            </h2>
                        </div>
                        <div class="p-4 space-y-2">
                            @if($isAdmin)
                                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-emerald-50 transition-all group">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-users text-white"></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Kelola Pengguna</span>
                                </a>
                                <a href="{{ route('admin.products') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-blue-50 transition-all group">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-box text-white"></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Kelola Produk</span>
                                </a>
                                <a href="{{ route('dashboard.orders') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-purple-50 transition-all group">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-shopping-bag text-white"></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Semua Pesanan</span>
                                </a>
                            @elseif($isSeller)
                                <a href="{{ route('products.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-emerald-50 transition-all group">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-plus text-white"></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Tambah Produk</span>
                                </a>
                                <a href="{{ route('dashboard.products') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-blue-50 transition-all group">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-box text-white"></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Kelola Produk</span>
                                </a>
                                <a href="{{ route('dashboard.orders') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-purple-50 transition-all group">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-shopping-bag text-white"></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Lihat Pesanan</span>
                                </a>
                            @else
                                <a href="{{ route('products.index') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-emerald-50 transition-all group">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-store text-white"></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Jelajahi Produk</span>
                                </a>
                                <a href="{{ route('cart.index') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-amber-50 transition-all group">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-shopping-cart text-white"></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Keranjang Saya</span>
                                </a>
                                <a href="{{ route('eco-shop') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-pink-50 transition-all group">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i class="fas fa-gift text-white"></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Eco-Shop</span>
                                </a>
                            @endif
                            <a href="{{ route('leaderboard') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-purple-50 transition-all group">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-trophy text-white"></i>
                                </div>
                                <span class="font-semibold text-gray-700">Peringkat</span>
                            </a>
                        </div>
                    </div>

                    <!-- Eco Impact Badge -->
                    <div class="bg-white rounded-2xl p-6 border border-emerald-100 shadow-sm animate-fade-in-up">
                        <div class="text-center">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-xl shadow-emerald-500/30 animate-pulse">
                                <i class="fas fa-earth-americas text-3xl text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Dampak Eco Anda</h3>
                            <p class="text-gray-500 text-sm mb-4">Setara dengan menanam</p>
                            <div class="flex items-center justify-center gap-2 mb-4">
                                <span class="text-4xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                                    {{ number_format($stats['total_carbon'] / 21, 1) }}
                                </span>
                                <span class="text-gray-600 text-lg">pohon</span>
                            </div>
                            <p class="text-xs text-gray-400">*Berdasarkan rata-rata penyerapan CO2</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leaderboard Preview -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-fade-in-up">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-transparent">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-400 to-pink-600 flex items-center justify-center shadow-lg shadow-purple-500/30">
                                <i class="fas fa-trophy text-white"></i>
                            </div>
                            Top 5 Eco Savers
                        </h2>
                        <a href="{{ route('leaderboard') }}" class="text-sm text-purple-600 hover:text-purple-700 font-semibold flex items-center gap-1 transition-all hover:gap-2">
                            Lihat Peringkat <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
                <div class="p-4">
                    @if($topUsers && $topUsers->count() > 0)
                        <div class="grid grid-cols-5 gap-4">
                            @foreach($topUsers->take(5) as $index => $leader)
                                <div class="bg-gray-50 rounded-xl p-4 text-center hover:shadow-lg transition-all duration-300 {{ $leader->id === auth()->id() ? 'ring-2 ring-emerald-400' : '' }}">
                                    <div class="relative mb-3">
                                        @if($index === 0)
                                            <div class="w-14 h-14 mx-auto rounded-full bg-gradient-to-br from-yellow-400 to-amber-500 flex items-center justify-center shadow-lg shadow-yellow-500/30">
                                                <i class="fas fa-crown text-white text-xl"></i>
                                            </div>
                                        @elseif($index === 1)
                                            <div class="w-14 h-14 mx-auto rounded-full bg-gradient-to-br from-gray-300 to-gray-500 flex items-center justify-center shadow-lg">
                                                <i class="fas fa-medal text-white text-xl"></i>
                                            </div>
                                        @elseif($index === 2)
                                            <div class="w-14 h-14 mx-auto rounded-full bg-gradient-to-br from-amber-600 to-amber-800 flex items-center justify-center shadow-lg">
                                                <i class="fas fa-medal text-white text-xl"></i>
                                            </div>
                                        @else
                                            <div class="w-14 h-14 mx-auto rounded-full bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center">
                                                <span class="text-white font-bold text-xl">{{ $index + 1 }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="font-semibold text-gray-800 text-sm truncate">{{ $leader->name }}</p>
                                    <p class="text-emerald-600 text-xs mt-1">
                                        <i class="fas fa-leaf mr-1"></i>{{ number_format($leader->total_carbon_saved ?? 0, 1) }} kg
                                    </p>
                                    @if($leader->id === auth()->id())
                                        <span class="inline-block mt-2 text-xs text-emerald-700 font-semibold bg-emerald-100 px-2 py-1 rounded-full">Anda</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-leaf text-2xl text-gray-300"></i>
                            </div>
                            <p class="text-gray-500">Belum ada data leaderboard</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Admin Only: Platform Overview Section -->
            @if($isAdmin && isset($newUsersThisWeek))
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-fade-in-up">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-transparent">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-400 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                                <i class="fas fa-chart-line text-white"></i>
                            </div>
                            Ringkasan Platform
                        </h2>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center p-4 bg-emerald-50 rounded-xl">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-user-friends text-emerald-600"></i>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['active_sellers'] ?? 0 }}</p>
                            <p class="text-sm text-gray-500">Penjual Aktif</p>
                        </div>
                        <div class="text-center p-4 bg-blue-50 rounded-xl">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-shopping-bag text-blue-600"></i>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['active_buyers'] ?? 0 }}</p>
                            <p class="text-sm text-gray-500">Pembeli Aktif</p>
                        </div>
                        <div class="text-center p-4 bg-purple-50 rounded-xl">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-calendar-week text-purple-600"></i>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $newUsersThisWeek }}</p>
                            <p class="text-sm text-gray-500">Pengguna Baru (Minggu Ini)</p>
                        </div>
                        <div class="text-center p-4 bg-amber-50 rounded-xl">
                            <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-amber-100 flex items-center justify-center">
                                <i class="fas fa-box text-amber-600"></i>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['pending_orders'] ?? 0 }}</p>
                            <p class="text-sm text-gray-500">Menunggu Diproses</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate counters
            const counters = document.querySelectorAll('.counter');
            const speed = 200;

            const animateCounter = (counter) => {
                const target = +counter.getAttribute('data-target');
                const decimals = counter.getAttribute('data-decimals') || 0;
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.min((count + increment).toFixed(decimals), target);
                    requestAnimationFrame(() => animateCounter(counter));
                } else {
                    counter.innerText = target.toFixed(decimals);
                }
            };

            // Animate progress bars
            const progressBars = document.querySelectorAll('.progress-bar');
            progressBars.forEach((bar, index) => {
                setTimeout(() => {
                    bar.style.width = (40 + Math.random() * 60) + '%';
                    bar.style.transition = 'width 2s ease-out';
                }, index * 150);
            });

            // Intersection Observer for counters
            const observerOptions = {
                threshold: 0.5,
                rootMargin: '0px'
            };

            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        counterObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            counters.forEach(counter => counterObserver.observe(counter));
        });
    </script>
    @endpush
</x-eco-loop-layout>
