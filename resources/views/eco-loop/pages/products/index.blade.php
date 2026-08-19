<x-eco-loop-layout title="Katalog Produk - Eco-Loop">
    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 py-12 relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/4 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-4xl font-bold text-white mb-4 animate-fade-in-up">
                <i class="fas fa-store mr-3"></i> Katalog Produk
            </h1>
            <p class="text-white/90 text-lg animate-fade-in-up delay-100">
                <i class="fas fa-leaf mr-2"></i>Pilihan barang bekas, rumput, dan sisa makanan untuk kurangi jejak karbon
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <div class="lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24 transform transition-all duration-500 hover:shadow-xl">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-filter text-emerald-500"></i> Filter
                    </h3>

                    <!-- Search -->
                    <form action="{{ route('products.index') }}" method="GET" class="mb-6">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Cari produk..."
                                   class="w-full px-4 py-3 pl-10 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
                        </div>
                        <button type="submit" class="w-full mt-3 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold rounded-xl hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </form>

                    <!-- Categories -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-folder text-emerald-500"></i> Kategori
                        </h4>
                        <div class="space-y-2">
                            <a href="{{ route('products.index') }}"
                               class="block px-4 py-3 rounded-xl transition-all duration-300 flex items-center gap-2 {{ !request('category') ? 'bg-gradient-to-r from-emerald-500 to-teal-600 text-white shadow-md' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-600' }}">
                                <i class="fas fa-th-large"></i> Semua Kategori
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                                   class="block px-4 py-3 rounded-xl transition-all duration-300 flex items-center justify-between {{ request('category') == $category->slug ? 'bg-gradient-to-r from-emerald-500 to-teal-600 text-white shadow-md' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-600' }}">
                                    <span class="flex items-center gap-2">
                                        <i class="{{ $category->icon }}"></i>
                                        {{ $category->name }}
                                    </span>
                                    <span class="text-xs text-gray-600 bg-white/20 px-2 py-1 rounded-full">{{ $category->products_count ?? 0 }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sort -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-sort text-emerald-500"></i> Urutkan
                        </h4>
                        <form action="{{ route('products.index') }}" method="GET" id="sort-form">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            <select name="sort" onchange="document.getElementById('sort-form').submit()" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 bg-white">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                                <option value="carbon_high" {{ request('sort') == 'carbon_high' ? 'selected' : '' }}>Karbon Tertinggi</option>
                            </select>
                        </form>
                    </div>

                    <!-- Active Filters -->
                    @if(request()->hasAny(['category', 'search', 'sort']))
                        <a href="{{ route('products.index') }}" class="block w-full px-6 py-3 border-2 border-emerald-500 text-emerald-600 font-semibold rounded-xl hover:bg-emerald-500 hover:text-white transition-all duration-300 text-center flex items-center justify-center gap-2">
                            <i class="fas fa-times"></i> Hapus Filter
                        </a>
                    @endif
                </div>
            </div>

            <!-- Products Grid -->
            <div class="flex-1">
                <div class="flex justify-between items-center mb-6 animate-fade-in-up">
                    <p class="text-gray-600 flex items-center gap-2">
                        <i class="fas fa-list text-emerald-500"></i>
                        Menampilkan <span class="font-bold text-emerald-600">{{ $products->count() }}</span> dari
                        <span class="font-bold">{{ $products->total() }}</span> produk
                    </p>
                </div>

                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <x-eco-loop::product-card :product="$product" />
                        @endforeach
                    </div>

                    <div class="mt-8 flex justify-center">
                        {{ $products->withQueryString()->links() }}
                    </div>
                @else
                    <div class="text-center py-16 bg-white rounded-2xl shadow-lg">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center transform transition-transform duration-300 hover:scale-110">
                            <i class="fas fa-search text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">Produk Tidak Ditemukan</h3>
                        <p class="text-gray-600 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold rounded-xl hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-redo"></i> Reset Filter
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-eco-loop-layout>
