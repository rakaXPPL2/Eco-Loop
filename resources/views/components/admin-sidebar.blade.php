<!-- Admin Sidebar Navigation -->
<div x-data="{ mobileOpen: false }" class="flex flex-col w-64 h-screen sticky top-0 bg-white border-r border-gray-200">
    <!-- Mobile Toggle Button -->
    <button @click="mobileOpen = !mobileOpen" class="lg:hidden fixed bottom-4 right-4 z-50 w-14 h-14 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 shadow-lg flex items-center justify-center shadow-xl">
        <i class="fas fa-bars text-white text-lg"></i>
    </button>

    <!-- Mobile Overlay -->
    <div x-show="mobileOpen" @click="mobileOpen = false" x-transition class="lg:hidden fixed inset-0 bg-black/50 z-40"></div>

    <!-- Sidebar Content -->
    <div :class="mobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" class="fixed lg:sticky top-0 left-0 z-50 lg:z-auto w-72 lg:w-64 h-screen flex flex-col transition-transform duration-300 ease-in-out bg-white border-r border-gray-100 shadow-2xl lg:shadow-none">
    <!-- Logo Area -->
    <div class="p-4 md:p-6 border-b border-gray-100">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-200">
                <i class="fas fa-shield-alt text-white"></i>
            </div>
            <div>
                <span class="text-gray-800 font-bold">Eco-Loop</span>
                <span class="block text-xs text-emerald-600">Admin Panel</span>
            </div>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 p-3 md:p-4 space-y-1 overflow-y-auto custom-scrollbar">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 rounded-xl transition-all text-sm md:text-base {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
            <i class="fas fa-home w-5"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Statistics -->
        <a href="{{ route('admin.statistics') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 rounded-xl transition-all text-sm md:text-base {{ request()->routeIs('admin.statistics') ? 'bg-purple-100 text-purple-700 border border-purple-200' : 'text-gray-600 hover:bg-purple-50 hover:text-purple-700' }}">
            <i class="fas fa-chart-bar w-5"></i>
            <span class="font-medium">Statistik</span>
        </a>

        <!-- Divider -->
        <div class="py-3 md:py-4">
            <p class="px-3 md:px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Manajemen</p>
        </div>

        <!-- Users -->
        <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 rounded-xl transition-all text-sm md:text-base {{ request()->routeIs('admin.users') ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
            <i class="fas fa-users w-5"></i>
            <span class="font-medium">Pengguna</span>
        </a>

        <!-- Products -->
        <a href="{{ route('admin.products') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 rounded-xl transition-all text-sm md:text-base {{ request()->routeIs('admin.products') ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
            <i class="fas fa-box w-5"></i>
            <span class="font-medium">Produk</span>
        </a>

        <!-- Orders -->
        <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 rounded-xl transition-all text-sm md:text-base {{ request()->routeIs('admin.orders') ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
            <i class="fas fa-shopping-bag w-5"></i>
            <span class="font-medium">Pesanan</span>
        </a>

        <!-- Stores -->
        <a href="{{ route('admin.stores') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 rounded-xl transition-all text-sm md:text-base {{ request()->routeIs('admin.stores') ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
            <i class="fas fa-store w-5"></i>
            <span class="font-medium">Toko</span>
            @if(isset($stats['pending_stores']) && $stats['pending_stores'] > 0)
                <span class="ml-auto px-1.5 md:px-2 py-0.5 bg-amber-500 text-white text-xs font-bold rounded-full">{{ $stats['pending_stores'] }}</span>
            @endif
        </a>

        <!-- Divider -->
        <div class="py-3 md:py-4">
            <p class="px-3 md:px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Monitoring</p>
        </div>

        <!-- Complaints -->
        <a href="{{ route('admin.complaints') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 rounded-xl transition-all text-sm md:text-base {{ request()->routeIs('admin.complaints') ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
            <i class="fas fa-exclamation-circle w-5"></i>
            <span class="font-medium">Pengaduan</span>
            @if(isset($stats['pending_complaints']) && $stats['pending_complaints'] > 0)
                <span class="ml-auto px-1.5 md:px-2 py-0.5 bg-red-500 text-white text-xs font-bold rounded-full animate-pulse">{{ $stats['pending_complaints'] }}</span>
            @endif
        </a>

        <!-- Messages -->
        <a href="{{ route('admin.messages') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 rounded-xl transition-all text-sm md:text-base {{ request()->routeIs('admin.messages') ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
            <i class="fas fa-comments w-5"></i>
            <span class="font-medium">Pesan</span>
        </a>

        <!-- Divider -->
        <div class="py-3 md:py-4">
            <p class="px-3 md:px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Konfigurasi</p>
        </div>

        <!-- Categories -->
        <a href="{{ route('admin.categories') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 rounded-xl transition-all text-sm md:text-base {{ request()->routeIs('admin.categories') ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
            <i class="fas fa-tags w-5"></i>
            <span class="font-medium">Kategori</span>
        </a>

        <!-- Regions -->
        <a href="{{ route('admin.regions') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 rounded-xl transition-all text-sm md:text-base {{ request()->routeIs('admin.regions') ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
            <i class="fas fa-map-marked-alt w-5"></i>
            <span class="font-medium">Region</span>
        </a>

        <!-- Badges -->
        <a href="{{ route('admin.badges') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 rounded-xl transition-all text-sm md:text-base {{ request()->routeIs('admin.badges') ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
            <i class="fas fa-award w-5"></i>
            <span class="font-medium">Lencana</span>
        </a>

        <!-- Rewards -->
        <a href="{{ route('admin.rewards') }}" class="flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 rounded-xl transition-all text-sm md:text-base {{ request()->routeIs('admin.rewards') ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
            <i class="fas fa-gift w-5"></i>
            <span class="font-medium">Hadiah</span>
        </a>
    </nav>

    <!-- User Section -->
    <div class="p-3 md:p-4 border-t border-gray-100">
        <div class="flex items-center gap-3 p-2 md:p-3 rounded-xl bg-gray-50">
            <div class="w-9 h-9 md:w-10 md:h-10 rounded-lg bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center shadow-lg flex-shrink-0">
                <span class="text-white font-bold text-sm md:text-base">{{ substr(auth()->user()?->name ?? 'A', 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-gray-800 font-semibold text-xs md:text-sm truncate">{{ auth()->user()?->name ?? 'Administrator' }}</p>
                <p class="text-emerald-600 text-xs">Administrator</p>
            </div>
            @if(auth()->check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            @endif
        </div>
    </div>
    </div>
</div>
