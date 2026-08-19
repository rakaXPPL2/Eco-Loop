<nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm" x-data="{ open: false, mobileMenu: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <i class="fas fa-leaf text-white text-lg"></i>
                </div>
                <span class="text-xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Eco-Loop</span>
            </a>

            <!-- Desktop Navigation - Light Theme -->
            <div class="hidden md:flex items-center gap-1">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.*') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.products') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.products') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-store mr-1"></i> Produk
                        </a>
                        <a href="{{ route('leaderboard') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('leaderboard') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-trophy mr-1"></i> Peringkat
                        </a>

                    @elseif(auth()->user()->isSeller())
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-home mr-1"></i> Dasbor
                        </a>
                        <a href="{{ route('dashboard.statistics') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard.statistics') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:bg-purple-50 hover:text-purple-700' }} transition-all">
                            <i class="fas fa-chart-bar mr-1"></i> Statistik
                        </a>
                        <a href="{{ route('dashboard.products') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard.products') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-box mr-1"></i> Produk
                        </a>
                        <a href="{{ route('dashboard.orders') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard.orders') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-shopping-bag mr-1"></i> Pesanan
                        </a>
                        <a href="{{ route('leaderboard') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('leaderboard') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-trophy mr-1"></i> Peringkat
                        </a>
                        <a href="{{ route('eco-shop') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('eco-shop') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-gift mr-1"></i> Eco-Shop
                        </a>

                    @else
                        <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-home mr-1"></i> Beranda
                        </a>
                        <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('products.*') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-store mr-1"></i> Katalog
                        </a>
                        <a href="{{ route('cart.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('cart.*') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-shopping-cart mr-1"></i> Keranjang
                        </a>
                        <a href="{{ route('dashboard.orders') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard.orders') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-receipt mr-1"></i> Pesanan
                        </a>
                        <a href="{{ route('leaderboard') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('leaderboard') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-trophy mr-1"></i> Peringkat
                        </a>
                        <a href="{{ route('eco-shop') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('eco-shop') ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }} transition-all">
                            <i class="fas fa-gift mr-1"></i> Eco-Shop
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Right Side - User Menu -->
            <div class="flex items-center gap-3">
                <!-- Cart for Buyers -->
                @auth
                    @if(auth()->user()->canBuy())
                        @php
                            $cartCount = auth()->user()->cart ? auth()->user()->cart->item_count : 0;
                        @endphp
                        <button onclick="toggleCart()" class="relative p-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            @if($cartCount > 0)
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-gradient-to-r from-orange-500 to-amber-500 text-white text-xs rounded-full flex items-center justify-center font-bold shadow-lg">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </button>
                    @endif

                <!-- User Dropdown -->
                <div class="relative">
                    <button @click="open = !open" class="flex items-center gap-2 p-1.5 rounded-xl hover:bg-emerald-50 transition-all">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center text-white font-bold text-sm shadow-lg"
                             style="background: linear-gradient(135deg, {{ auth()->user()->isAdmin() ? '#9333ea' : (auth()->user()->isSeller() ? '#22c55e' : '#2563eb') }} 0%, {{ auth()->user()->isAdmin() ? '#7c3aed' : (auth()->user()->isSeller() ? '#16a34a' : '#1d4ed8') }} 100%)">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden lg:block text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" x-transition
                         class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden z-50">
                        <!-- User Info Header -->
                        <div class="px-4 py-4 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-transparent">
                            <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                    <i class="fas fa-leaf mr-1"></i>
                                    {{ number_format(auth()->user()->total_carbon_saved, 1) }} kg
                                </span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold {{ auth()->user()->isAdmin() ? 'bg-purple-100 text-purple-700 border-purple-200' : (auth()->user()->isSeller() ? 'bg-emerald-100 text-emerald-700 border-emerald-200' : 'bg-blue-100 text-blue-700 border-blue-200') }} border">
                                    {{ auth()->user()->isAdmin() ? 'Admin' : (auth()->user()->isSeller() ? 'Penjual' : 'Pembeli') }}
                                </span>
                            </div>
                        </div>

                        <!-- Menu Items -->
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-all">
                            <i class="fas fa-user w-5"></i> Dasbor Saya
                        </a>

                        @if(auth()->user()->isSeller())
                            <a href="{{ route('dashboard.products') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-all">
                                <i class="fas fa-box w-5"></i> Produk Saya
                            </a>
                        @endif

                        <a href="{{ route('dashboard.vouchers') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-all">
                            <i class="fas fa-ticket-alt w-5"></i> Voucher
                        </a>
                        <a href="{{ route('dashboard.notifications') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-all">
                            <i class="fas fa-bell w-5"></i> Notifikasi
                        </a>

                        @if(auth()->user()->isAdmin())
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-purple-700 hover:bg-purple-50 transition-all">
                                <i class="fas fa-cog w-5"></i> Panel Admin
                            </a>
                        @endif

                        <div class="border-t border-gray-100 mt-1 pt-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-red-600 hover:bg-red-50 transition-all">
                                <i class="fas fa-sign-out-alt w-5"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenu" x-transition class="md:hidden pb-4">
            <div class="flex flex-col gap-1 bg-gray-50 rounded-xl p-3 border border-gray-100">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 font-medium transition-all">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.products') }}" class="px-4 py-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 font-medium transition-all">
                            <i class="fas fa-store mr-2"></i> Produk
                        </a>

                    @elseif(auth()->user()->isSeller())
                        <a href="{{ route('dashboard') }}" class="px-4 py-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 font-medium transition-all">
                            <i class="fas fa-home mr-2"></i> Dasbor
                        </a>
                        <a href="{{ route('dashboard.products') }}" class="px-4 py-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 font-medium transition-all">
                            <i class="fas fa-box mr-2"></i> Produk
                        </a>
                        <a href="{{ route('dashboard.orders') }}" class="px-4 py-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 font-medium transition-all">
                            <i class="fas fa-shopping-bag mr-2"></i> Pesanan
                        </a>

                    @else
                        <a href="{{ route('home') }}" class="px-4 py-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 font-medium transition-all">
                            <i class="fas fa-home mr-2"></i> Beranda
                        </a>
                        <a href="{{ route('products.index') }}" class="px-4 py-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 font-medium transition-all">
                            <i class="fas fa-store mr-2"></i> Katalog
                        </a>
                        <a href="{{ route('cart.index') }}" class="px-4 py-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 font-medium transition-all">
                            <i class="fas fa-shopping-cart mr-2"></i> Keranjang
                        </a>
                        <a href="{{ route('dashboard.orders') }}" class="px-4 py-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 font-medium transition-all">
                            <i class="fas fa-receipt mr-2"></i> Pesanan
                        </a>
                    @endif

                    <a href="{{ route('leaderboard') }}" class="px-4 py-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 font-medium transition-all">
                        <i class="fas fa-trophy mr-2"></i> Peringkat
                    </a>
                    <a href="{{ route('eco-shop') }}" class="px-4 py-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 font-medium transition-all">
                        <i class="fas fa-gift mr-2"></i> Eco-Shop
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleCart() {
        const sidebar = document.getElementById('cart-sidebar');
        const overlay = document.getElementById('cart-overlay');

        sidebar.classList.toggle('translate-x-full');
        overlay.classList.toggle('hidden');
    }
</script>
