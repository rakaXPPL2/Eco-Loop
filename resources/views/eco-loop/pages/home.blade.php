<x-eco-loop-layout title="Beranda - Eco-Loop">
    <div class="min-h-screen bg-gradient-to-br from-emerald-50/30 via-white to-teal-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
            <!-- Hero Section -->
            <div class="relative bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl p-8 md:p-12 text-center overflow-hidden shadow-xl shadow-emerald-500/20 animate-fade-in-up">
                <!-- Decorative leaves -->
                <div class="absolute top-4 left-4 text-4xl opacity-20 animate-bounce" style="animation-duration: 3s;">
                    <i class="fas fa-leaf text-white"></i>
                </div>
                <div class="absolute top-8 right-8 text-2xl opacity-20 animate-bounce" style="animation-duration: 4s; animation-delay: 0.5s;">
                    <i class="fas fa-seedling text-emerald-200"></i>
                </div>
                <div class="absolute bottom-4 right-12 text-3xl opacity-15 animate-bounce" style="animation-duration: 5s; animation-delay: 1s;">
                    <i class="fas fa-leaf text-white"></i>
                </div>

                <div class="relative">
                    <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md rounded-full px-5 py-2 mb-6 border border-white/30">
                        <i class="fas fa-sparkles text-emerald-200 animate-pulse"></i>
                        <span class="text-sm font-medium text-white">Platform Belanja Ramah Lingkungan</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                        Halo, <span class="bg-gradient-to-r from-emerald-200 via-teal-200 to-green-200 bg-clip-text text-transparent">{{ auth()->user()->name }}</span>!
                    </h1>
                    <p class="text-xl text-white/90 max-w-2xl mx-auto mb-8">
                        <i class="fas fa-earth-americas text-emerald-200 mr-2"></i>
                        Bersama kita bisa mengurangi jejak karbon dan menyelamatkan bumi
                    </p>

                    <!-- Main CTA -->
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('products.index') }}" class="group inline-flex items-center gap-3 px-8 py-4 bg-white text-emerald-600 font-bold rounded-2xl hover:from-emerald-50 hover:to-teal-50 transition-all shadow-xl hover:shadow-2xl hover:scale-105">
                            <i class="fas fa-store text-lg group-hover:animate-bounce"></i>
                            Jelajahi Produk
                        </a>
                        <a href="{{ route('eco-shop') }}" class="group inline-flex items-center gap-3 px-8 py-4 bg-white/10 backdrop-blur-md text-white font-bold rounded-2xl border border-white/30 hover:bg-white/20 transition-all hover:scale-105">
                            <i class="fas fa-gift text-lg text-emerald-200 group-hover:animate-spin" style="animation-duration: 3s;"></i>
                            Eco-Shop
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 stagger-children">
                <!-- Carbon Saved -->
                <div class="bg-white rounded-2xl p-5 border border-emerald-100 hover:border-emerald-300 transition-all duration-500 hover:shadow-lg hover:shadow-emerald-500/10 animate-fade-in-up group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:shadow-emerald-400/50 transition-all">
                            <i class="fas fa-cloud text-white text-2xl"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mb-1">Karbon Anda</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ auth()->user()->total_carbon_saved }}" data-decimals="1">0</span>
                        <span class="text-lg font-medium text-emerald-600">kg CO₂</span>
                    </div>
                </div>

                <!-- Vouchers -->
                <div class="bg-white rounded-2xl p-5 border border-amber-100 hover:border-amber-300 transition-all duration-500 hover:shadow-lg hover:shadow-amber-500/10 animate-fade-in-up group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:shadow-amber-400/50 transition-all">
                            <i class="fas fa-ticket text-white text-2xl"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mb-1">Voucher</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ auth()->user()->total_vouchers }}">0</span>
                        <span class="text-lg font-medium text-amber-600">kupon</span>
                    </div>
                </div>

                <!-- Orders -->
                <div class="bg-white rounded-2xl p-5 border border-blue-100 hover:border-blue-300 transition-all duration-500 hover:shadow-lg hover:shadow-blue-500/10 animate-fade-in-up group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-400 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:shadow-blue-400/50 transition-all">
                            <i class="fas fa-shopping-bag text-white text-2xl"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mb-1">Transaksi</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ auth()->user()->total_orders }}">0</span>
                        <span class="text-lg font-medium text-blue-600">pesanan</span>
                    </div>
                </div>

                <!-- Rank -->
                <div class="bg-white rounded-2xl p-5 border border-purple-100 hover:border-purple-300 transition-all duration-500 hover:shadow-lg hover:shadow-purple-500/10 animate-fade-in-up group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-400 to-pink-600 flex items-center justify-center shadow-lg shadow-purple-500/30 group-hover:shadow-purple-400/50 transition-all">
                            <i class="fas fa-trophy text-white text-2xl"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mb-1">Peringkat</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-bold text-gray-800">#</span>
                        <span class="text-3xl font-bold text-gray-800 counter" data-target="{{ auth()->user()->rank }}">0</span>
                    </div>
                </div>
            </div>

            <!-- Categories Section -->
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm animate-fade-in-up">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-teal-500/30">
                            <i class="fas fa-th-large text-white"></i>
                        </div>
                        Kategori Produk
                    </h2>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                           class="bg-gray-50 rounded-2xl p-5 text-center border border-gray-100 hover:border-emerald-300 transition-all duration-300 group hover:shadow-lg hover:scale-105">
                            <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center transition-transform group-hover:scale-110"
                                 style="{{ $category->getBackgroundStyle() }}">
                                <i class="{{ $category->icon ?? 'fa-box' }} text-3xl" style="{{ $category->getTextStyle() }}"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $category->name }}</h3>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                {{ $category->products_count ?? 0 }} produk
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Featured Eco Products Section -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-fade-in-up">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-transparent">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-green-500/30">
                                <i class="fas fa-leaf text-white"></i>
                            </div>
                            Produk Eco Terbaru
                        </h2>
                        <a href="{{ route('products.index') }}" class="group inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-100 text-emerald-700 font-semibold rounded-xl border border-emerald-200 hover:bg-emerald-200 transition-all">
                            Lihat Semua <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                @if($latestProducts->count() > 0)
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach($latestProducts as $product)
                                <x-eco-loop::product-card :product="$product" />
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-box-open text-4xl text-gray-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Produk</h3>
                        <p class="text-gray-500 mb-6">Jadilah yang pertama menambahkan produk!</p>
                        @if(auth()->user()->canSell())
                            <a href="{{ route('products.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all shadow-lg shadow-emerald-500/30">
                                <i class="fas fa-plus mr-2"></i> Jual Produk
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Leaderboard Section -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-fade-in-up">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-transparent">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-400 to-pink-600 flex items-center justify-center shadow-lg shadow-purple-500/30">
                                <i class="fas fa-trophy text-white"></i>
                            </div>
                            Peringkat Teratas
                        </h2>
                        <a href="{{ route('leaderboard') }}" class="group inline-flex items-center gap-2 px-5 py-2.5 bg-purple-100 text-purple-700 font-semibold rounded-xl border border-purple-200 hover:bg-purple-200 transition-all">
                            Lihat Peringkat <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
                        @foreach($topUsers->take(5) as $index => $user)
                            <div class="bg-gray-50 rounded-2xl p-4 text-center hover:shadow-lg transition-all duration-300 {{ $user->id === auth()->id() ? 'ring-2 ring-emerald-400 shadow-lg' : '' }}">
                                <div class="relative mb-4">
                                    @if($index === 0)
                                        <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-yellow-300 via-yellow-400 to-amber-500 flex items-center justify-center shadow-xl shadow-yellow-500/30 ring-4 ring-yellow-400/30">
                                            <i class="fas fa-crown text-white text-2xl"></i>
                                        </div>
                                    @elseif($index === 1)
                                        <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-gray-200 to-gray-400 flex items-center justify-center shadow-lg ring-4 ring-gray-300/30">
                                            <i class="fas fa-medal text-white text-2xl"></i>
                                        </div>
                                    @elseif($index === 2)
                                        <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-amber-600 to-amber-800 flex items-center justify-center shadow-lg ring-4 ring-amber-600/30">
                                            <i class="fas fa-medal text-white text-2xl"></i>
                                        </div>
                                    @else
                                        <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center border-2 border-emerald-400">
                                            <span class="text-white font-bold text-2xl">{{ $index + 1 }}</span>
                                        </div>
                                    @endif
                                </div>

                                <p class="font-bold text-gray-800 truncate mb-1">{{ $user->name }}</p>
                                <div class="flex items-center justify-center gap-2 mb-2">
                                    <i class="fas fa-leaf text-emerald-500 text-xs"></i>
                                    <span class="text-emerald-600 font-semibold">{{ number_format($user->total_carbon_saved, 1) }} kg</span>
                                </div>

                                @if($user->id === auth()->id())
                                    <span class="inline-flex items-center gap-1 text-xs text-emerald-700 font-semibold bg-emerald-100 px-3 py-1 rounded-full border border-emerald-200">
                                        <i class="fas fa-star"></i> Anda
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            @if(auth()->user()->canSell())
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm animate-fade-in-up">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/30">
                        <i class="fas fa-store text-white"></i>
                    </div>
                    Menu Penjual
                </h2>

                <div class="grid md:grid-cols-3 gap-6">
                    <a href="{{ route('products.create') }}" class="group bg-gray-50 rounded-2xl p-6 text-center border border-gray-100 hover:border-emerald-300 transition-all hover:shadow-lg hover:shadow-emerald-500/10 hover:scale-105">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform">
                            <i class="fas fa-plus text-white text-3xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg mb-2">Jual Produk</h3>
                        <p class="text-sm text-gray-500">Tambahkan produk baru untuk dijual</p>
                    </a>

                    <a href="{{ route('dashboard.products') }}" class="group bg-gray-50 rounded-2xl p-6 text-center border border-gray-100 hover:border-blue-300 transition-all hover:shadow-lg hover:shadow-blue-500/10 hover:scale-105">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                            <i class="fas fa-box text-white text-3xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg mb-2">Produk Saya</h3>
                        <p class="text-sm text-gray-500">Kelola produk yang Anda jual</p>
                    </a>

                    <a href="{{ route('dashboard.orders') }}" class="group bg-gray-50 rounded-2xl p-6 text-center border border-gray-100 hover:border-purple-300 transition-all hover:shadow-lg hover:shadow-purple-500/10 hover:scale-105">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center shadow-lg shadow-purple-500/30 group-hover:scale-110 transition-transform">
                            <i class="fas fa-shopping-bag text-white text-3xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg mb-2">Pesanan</h3>
                        <p class="text-sm text-gray-500">Lihat pesanan dari pembeli</p>
                    </a>
                </div>
            </div>
            @endif

            <!-- CTA Section -->
            <div class="relative bg-gradient-to-br from-emerald-500 via-teal-500 to-green-500 rounded-3xl p-8 md:p-12 text-center overflow-hidden shadow-xl shadow-emerald-500/20 animate-fade-in-up">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/4"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/4"></div>

                <div class="relative">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-white flex items-center justify-center shadow-xl">
                        <i class="fas fa-seedling text-4xl text-emerald-500 animate-bounce" style="animation-duration: 2s;"></i>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Mulai Berbelanja Sekarang!</h2>
                    <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">Setiap pembelian membantu mengurangi jejak karbon dan menyelamatkan bumi untuk generasi mendatang</p>
                    <a href="{{ route('products.index') }}" class="group inline-flex items-center gap-3 px-10 py-5 bg-white text-emerald-600 font-bold rounded-2xl hover:shadow-2xl hover:scale-105 text-lg transition-all">
                        <i class="fas fa-store text-xl group-hover:animate-pulse"></i>
                        Lihat Katalog Produk
                    </a>
                </div>
            </div>
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
