<x-eco-loop-layout title="Eco-Shop - Eco-Loop">

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-eco-green via-eco-emerald to-eco-teal overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-eco-teal opacity-20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="animate-fade-in-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/90 backdrop-blur-sm rounded-full text-emerald-700 font-semibold text-sm mb-6 shadow-md shadow-green-500/20 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        <i class="fas fa-gift"></i>
                        <span>Tukar Poin Jadi Hadiah</span>
                    </div>

                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Eco-Shop
                    </h1>

                    <p class="text-lg text-white/90 mb-8">
                        Tukarkan Poin Karbon Anda dengan hadiah menarik. Semakin banyak berkarbon, semakin banyak hadiah!
                    </p>
                </div>

                <!-- User Points Card -->
                <div class="bg-white rounded-2xl shadow-2xl p-8 transform transition-all duration-500 hover:scale-[1.02] animate-fade-in-right">
                    <div class="text-center mb-6">
                        <p class="text-sm text-gray-600 uppercase tracking-wide mb-2">Poin Karbon Anda</p>
                        <div class="flex items-center justify-center gap-2">
                            <div class="w-12 h-12 rounded-full gradient-eco flex items-center justify-center shadow-lg">
                                <i class="fas fa-coins text-white text-xl"></i>
                            </div>
                            <span class="text-5xl font-bold text-gradient-eco">{{ number_format($userPoints ?? 0) }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-eco-cream rounded-xl p-4 text-center transform transition-all duration-300 hover:scale-105 cursor-default">
                            <i class="fas fa-ticket-alt text-2xl text-eco-amber mb-2"></i>
                            <p class="text-xl font-bold text-gray-800">{{ $vouchersRedeemed ?? 0 }}</p>
                            <p class="text-xs text-gray-600">Voucher Ditukar</p>
                        </div>
                        <div class="bg-eco-cream rounded-xl p-4 text-center transform transition-all duration-300 hover:scale-105 cursor-default">
                            <i class="fas fa-leaf text-2xl text-emerald-600 mb-2"></i>
                            <p class="text-xl font-bold text-gray-800">{{ number_format($totalCarbonSaved ?? 0, 1) }}</p>
                            <p class="text-xs text-gray-600">kg CO2 dihemat</p>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-gradient-to-r from-eco-green-light to-eco-cream rounded-xl">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-info-circle text-emerald-600 mr-2"></i>
                            Kumpulkan lebih banyak poin dengan membeli atau menjual produk eco-friendly!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rewards Grid -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in-up">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 flex items-center justify-center gap-2">
                    <i class="fas fa-gem text-purple-500"></i>
                    Reward Tersedia
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Pilih hadiah yang Anda inginkan. Setiap hadiah memiliki persyaratan poin yang berbeda.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 stagger-children">
                @forelse($rewards as $reward)
                    <div class="card-eco group overflow-hidden transform transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl animate-scale-in">
                        <!-- Reward Image -->
                        <div class="relative h-48 bg-gradient-to-br from-eco-cream to-gray-100 flex items-center justify-center overflow-hidden">
                            @if(isset($reward->image) && $reward->image)
                                <img src="{{ $reward->image }}" alt="{{ $reward->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-20 h-20 rounded-full bg-eco-green-light flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110">
                                    <i class="fas {{ $reward->icon ?? 'fa-gift' }} text-4xl text-emerald-600"></i>
                                </div>
                            @endif

                            <!-- Points Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="px-3 py-1 bg-eco-green text-white rounded-full text-sm font-bold shadow-lg transform transition-all duration-300 hover:scale-110">
                                    <i class="fas fa-coins mr-1"></i>
                                    {{ number_format($reward->points_required) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5">
                            <h3 class="font-bold text-gray-800 text-lg mb-2 group-hover:text-emerald-600 transition-colors duration-300">
                                {{ $reward->name }}
                            </h3>

                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                {{ $reward->description ?? 'Reward menarik dari Eco-Loop' }}
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <i class="fas fa-tag text-eco-amber"></i>
                                    <span>{{ $reward->stock ?? 'Tersedia' }}</span>
                                </div>

                                @auth
                                    @if(($userPoints ?? 0) >= $reward->points_required)
                                        <form action="{{ route('eco-shop.redeem') }}" method="POST" class="inline" onsubmit="return confirm('Tukar reward ini?')">
                                            @csrf
                                            <input type="hidden" name="reward_id" value="{{ $reward->id }}">
                                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-eco-green to-emerald-500 text-white text-sm font-semibold rounded-lg hover:from-emerald-500 hover:to-eco-green transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-1">
                                                <i class="fas fa-exchange-alt"></i>
                                                Tukar
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg text-sm cursor-not-allowed flex items-center gap-2">
                                            <i class="fas fa-lock"></i>
                                            Butuh {{ number_format($reward->points_required - ($userPoints ?? 0)) }} lagi
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 py-2 border-2 border-eco-green text-emerald-600 text-sm font-semibold rounded-lg hover:bg-eco-green hover:text-white transition-all duration-300">
                                        <i class="fas fa-sign-in-alt"></i>
                                        Login
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-16">
                        <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center transform transition-transform duration-300 hover:scale-110">
                            <i class="fas fa-gift text-4xl text-gray-300"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Reward</h3>
                        <p class="text-gray-600">Reward akan segera ditambahkan. Stay tuned!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- How to Earn Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 flex items-center justify-center gap-2">
                    <i class="fas fa-hand-holding-usd text-emerald-600"></i>
                    Cara Mendapatkan Poin
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Banyak cara untuk mengumpulkan Poin Karbon dan menukar dengan hadiah!
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 transform transition-all duration-500 hover:-translate-y-3 hover:shadow-xl rounded-2xl">
                    <div class="w-20 h-20 mx-auto mb-4 rounded-full gradient-eco flex items-center justify-center shadow-lg transform transition-transform duration-300 hover:scale-110">
                        <i class="fas fa-shopping-bag text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Beli Produk</h3>
                    <p class="text-gray-600">Setiap pembelian menghasilkan Poin Karbon berdasarkan berat dan kategori produk.</p>
                    <div class="mt-4 inline-flex items-center gap-2 badge-eco transform transition-transform duration-300 hover:scale-105">
                        <i class="fas fa-plus"></i>
                        <span>+10-100 poin/transaksi</span>
                    </div>
                </div>

                <div class="text-center p-6 transform transition-all duration-500 hover:-translate-y-3 hover:shadow-xl rounded-2xl">
                    <div class="w-20 h-20 mx-auto mb-4 rounded-full gradient-eco flex items-center justify-center shadow-lg transform transition-transform duration-300 hover:scale-110">
                        <i class="fas fa-upload text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Jual Produk</h3>
                    <p class="text-gray-600">Produk yang terjual juga menghasilkan poin sebagai apresiasi kontribusi Anda.</p>
                    <div class="mt-4 inline-flex items-center gap-2 badge-eco transform transition-transform duration-300 hover:scale-105">
                        <i class="fas fa-plus"></i>
                        <span>+5-50 poin/produk</span>
                    </div>
                </div>

                <div class="text-center p-6 transform transition-all duration-500 hover:-translate-y-3 hover:shadow-xl rounded-2xl">
                    <div class="w-20 h-20 mx-auto mb-4 rounded-full gradient-eco flex items-center justify-center shadow-lg transform transition-transform duration-300 hover:scale-110">
                        <i class="fas fa-recycle text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Aktivitas Lainnya</h3>
                    <p class="text-gray-600">Ulasan produk, referral teman, dan event khusus juga memberikan poin bonus!</p>
                    <div class="mt-4 inline-flex items-center gap-2 badge-eco transform transition-transform duration-300 hover:scale-105">
                        <i class="fas fa-plus"></i>
                        <span>+bonus poin</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 gradient-eco-soft">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <div class="w-20 h-20 mx-auto mb-6 rounded-full gradient-eco flex items-center justify-center shadow-xl transform transition-transform duration-300 hover:scale-110">
                <i class="fas fa-store text-white text-3xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                Mulai Kumpulkan Poin Sekarang!
            </h2>
            <p class="text-gray-600 mb-8 text-lg">
                Belanja di Eco-Loop dan dapatkan hadiah menarik dari poin karbon Anda.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-eco-green to-emerald-500 text-white text-lg font-bold rounded-xl hover:from-emerald-500 hover:to-eco-green transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                    <i class="fas fa-shopping-bag"></i>
                    Belanja Sekarang
                </a>
                <a href="{{ route('products.create') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 border-3 border-eco-green text-emerald-600 text-lg font-bold rounded-xl bg-white hover:bg-eco-green hover:text-white transition-all duration-300">
                    <i class="fas fa-plus"></i>
                    Jual Produk
                </a>
            </div>
        </div>
    </section>

</x-eco-loop-layout>
