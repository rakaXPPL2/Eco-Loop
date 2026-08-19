<x-eco-loop-layout title="{{ $product->name }} - Eco-Loop">

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-emerald-600 transition-colors">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('products.index') }}" class="hover:text-emerald-600 transition-colors">Produk</a>
                <span class="mx-2">/</span>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-emerald-600 transition-colors">{{ $product->category->name }}</a>
                <span class="mx-2">/</span>
                <span class="text-gray-700">{{ Str::limit($product->name, 30) }}</span>
            </nav>
        </div>
    </div>

    <!-- Product Detail -->
    <section class="py-8 bg-gradient-to-br from-emerald-50/30 via-white to-teal-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12">

                <!-- Left Column: Image Gallery -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 group">
                        <div class="aspect-square bg-gradient-to-br from-emerald-100 to-teal-50 flex items-center justify-center overflow-hidden">
                            @if($product->image)
                                <img id="mainImage"
                                     src="{{ $product->image }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas {{ $product->category->icon ?? 'fa-box' }} text-6xl text-emerald-200"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Carbon Badge Overlay -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center gap-1 px-4 py-2 bg-white/95 backdrop-blur-sm rounded-xl shadow-lg text-emerald-700 font-bold">
                                <i class="fas fa-leaf"></i>
                                {{ $product->carbon_display }}
                            </span>
                        </div>

                        <!-- Share Button -->
                        <div class="absolute top-4 right-4">
                            <button onclick="copyProductLink()" class="w-10 h-10 bg-white/95 backdrop-blur-sm rounded-xl shadow-lg flex items-center justify-center text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 transition-all" title="Bagikan">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>

                        <!-- Stock Badge -->
                        @if($product->stock <= 5 && $product->stock > 0)
                            <div class="absolute bottom-4 left-4">
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-500 text-white text-sm font-bold rounded-lg shadow-lg animate-pulse">
                                    <i class="fas fa-fire"></i> Tersisa {{ $product->stock }} unit!
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Product Guarantees -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-leaf text-emerald-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Eco-Friendly</p>
                                <p class="text-sm font-semibold text-gray-800">Ramah Lingkungan</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-truck text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Pengiriman</p>
                                <p class="text-sm font-semibold text-gray-800">Gratis Ongkir</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Product Info -->
                <div class="space-y-6">
                    <!-- Category & Title -->
                    <div>
                        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                           class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold mb-3 hover:bg-emerald-200 transition-colors">
                            <i class="fas {{ $product->category->icon ?? 'fa-folder' }}"></i>
                            {{ $product->category->name }}
                        </a>

                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
                            {{ $product->name }}
                        </h1>
                    </div>

                    <!-- Price & Quick Stats -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                        <div class="flex items-baseline gap-3 mb-4">
                            <span class="text-4xl font-bold text-emerald-600">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                            <span class="text-lg text-gray-500">/ unit</span>
                        </div>

                        <div class="grid grid-cols-4 gap-3">
                            <div class="text-center p-3 bg-gray-50 rounded-xl">
                                <p class="text-2xl font-bold text-gray-800">{{ $product->weight }}</p>
                                <p class="text-xs text-gray-500">kg</p>
                            </div>
                            <div class="text-center p-3 bg-gray-50 rounded-xl">
                                @php
                                    $conditionLabels = [
                                        'new' => 'Baru',
                                        'like_new' => 'Spt Baru',
                                        'good' => 'Bagus',
                                        'fair' => 'Cukup',
                                    ];
                                @endphp
                                <p class="text-lg font-bold text-gray-800">{{ $conditionLabels[$product->condition] ?? ucfirst($product->condition) }}</p>
                                <p class="text-xs text-gray-500">Kondisi</p>
                            </div>
                            @if($product->city)
                            <div class="text-center p-3 bg-emerald-50 rounded-xl">
                                <p class="text-lg font-bold text-emerald-600 flex items-center justify-center gap-1">
                                    <i class="fas fa-map-marker-alt text-sm"></i>
                                </p>
                                <p class="text-xs text-emerald-600">{{ $product->city }}</p>
                            </div>
                            @endif
                            <div class="text-center p-3 {{ $product->stock > 0 ? 'bg-emerald-50' : 'bg-red-50' }} rounded-xl">
                                <p class="text-2xl font-bold {{ $product->stock > 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                    {{ $product->stock }}
                                </p>
                                <p class="text-xs text-gray-500">Stok</p>
                            </div>
                        </div>
                    </div>

                    <!-- Carbon Impact Card -->
                    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl p-6 text-white shadow-lg shadow-emerald-500/20">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-earth-americas text-3xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-emerald-100">Dampak Lingkungan Positif</p>
                                <p class="text-3xl font-bold">{{ $product->carbon_saved }} kg CO₂</p>
                                <p class="text-sm text-emerald-200">yang dihemat per unit</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stock Status -->
                    @if($product->stock > 0)
                        <div class="flex items-center gap-2 text-emerald-600">
                            <div class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></div>
                            <span class="font-semibold">{{ $product->stock }} unit tersedia</span>
                        </div>
                    @else
                        <div class="flex items-center gap-2 text-red-500 bg-red-50 p-4 rounded-xl border border-red-200">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <span class="font-semibold">Stok Habis - Harap tunggu restock</span>
                        </div>
                    @endif

                    <!-- Add to Cart Section -->
                    @auth
                        @if($product->stock > 0)
                            @if(isset($canBuy) && $canBuy)
                                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                                        @csrf
                                        <div class="flex items-center gap-4">
                                            <label class="text-sm font-semibold text-gray-700">Jumlah:</label>
                                            <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden">
                                                <button type="button" onclick="decrementQty()" class="px-4 py-3 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}"
                                                       class="w-20 text-center border-0 focus:ring-0 font-bold bg-transparent text-lg">
                                                <button type="button" onclick="incrementQty({{ $product->stock }})" class="px-4 py-3 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-2 text-lg">
                                            <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                                        </button>
                                    </form>
                                </div>

                                <!-- Chat with Seller -->
                                <a href="{{ route('products.chat', $product) }}"
                                   class="block w-full py-4 px-6 border-2 border-emerald-500 text-emerald-600 font-bold rounded-xl hover:bg-emerald-50 transition-all duration-300 flex items-center justify-center gap-2 text-lg">
                                    <i class="fas fa-comment-dots"></i> Tanya ke Penjual
                                </a>
                            @else
                                <div class="bg-amber-50 border-2 border-amber-200 rounded-2xl p-6">
                                    <div class="flex items-start gap-3 text-amber-700">
                                        <i class="fas fa-map-marker-alt text-xl mt-1"></i>
                                        <div>
                                            <p class="font-semibold mb-1">Produk ini hanya untuk wilayah Anda</p>
                                            <p class="text-sm">Update alamat pengiriman di profil Anda untuk membeli produk ini.</p>
                                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-1 text-sm font-semibold mt-2 hover:underline">
                                                <i class="fas fa-edit"></i> Update Profil
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="bg-gray-100 rounded-2xl p-6 text-center">
                                <p class="text-gray-600 font-medium mb-4">Produk sedang tidak tersedia</p>
                                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-700 transition-all">
                                    <i class="fas fa-store"></i> Lihat Produk Lain
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm text-center space-y-4">
                            <p class="text-gray-600">
                                <i class="fas fa-sign-in-alt mr-2 text-emerald-500"></i>
                                Login untuk menambahkan ke keranjang
                            </p>
                            <a href="{{ route('login') }}" class="block w-full py-4 px-6 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold rounded-xl hover:from-emerald-600 hover:to-teal-700 transition-all text-lg">
                                <i class="fas fa-sign-in-alt mr-2"></i> Login
                            </a>
                        </div>
                    @endauth

                    <!-- Seller Info Card -->
                    @php
                        $sellerStore = $product->user->store;
                    @endphp
                    <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                        <div class="p-5 bg-gradient-to-r from-gray-50 to-transparent border-b border-gray-100">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-store text-emerald-600"></i>
                                Info Penjual
                            </h3>
                        </div>
                        <div class="p-5">
                            <div class="flex items-start gap-4">
                                @if($sellerStore)
                                    <a href="{{ route('stores.show', $sellerStore) }}"
                                       class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-md overflow-hidden flex-shrink-0">
                                @else
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-md overflow-hidden flex-shrink-0">
                                @endif
                                        @if($sellerStore?->photo)
                                            <img src="{{ Storage::url($sellerStore->photo) }}" alt="{{ $product->user->name }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-white text-2xl font-bold">{{ substr($product->user->name, 0, 1) }}</span>
                                        @endif
                                @if($sellerStore)
                                    </a>
                                @else
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    @if($sellerStore)
                                        <a href="{{ route('stores.show', $sellerStore) }}"
                                           class="font-bold text-gray-800 hover:text-emerald-600 transition-colors block truncate">
                                            {{ $sellerStore->name }}
                                        </a>
                                    @else
                                        <span class="font-bold text-gray-800 block truncate">{{ $product->user->name }}</span>
                                    @endif
                                    <p class="text-sm text-gray-500 flex items-center gap-1 mt-1">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                        {{ $sellerStore?->region?->name ?? 'Indonesia' }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        <i class="fas fa-calendar mr-1"></i>
                                        Bergabung {{ $product->user->created_at->diffForHumans() }}
                                    </p>

                                    @if($sellerStore?->is_verified)
                                        <span class="inline-flex items-center gap-1 mt-2 text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded-full">
                                            <i class="fas fa-check-circle"></i> Terverifikasi
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Seller Stats -->
                            <div class="grid grid-cols-2 gap-3 mt-4 pt-4 border-t border-gray-100">
                                <div class="text-center p-3 bg-emerald-50 rounded-xl">
                                    <p class="text-xl font-bold text-emerald-600">{{ $sellerProductCount ?? $product->user->products()->count() }}</p>
                                    <p class="text-xs text-gray-500">Total Produk</p>
                                </div>
                                <div class="text-center p-3 bg-amber-50 rounded-xl">
                                    <p class="text-xl font-bold text-amber-600">{{ $product->user->total_orders ?? 0 }}</p>
                                    <p class="text-xs text-gray-500">Transaksi</p>
                                </div>
                            </div>

                            @if($sellerStore)
                                <a href="{{ route('stores.show', $sellerStore) }}"
                                   class="mt-4 block w-full py-3 text-center border-2 border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all">
                                    <i class="fas fa-external-link-alt mr-2"></i> Kunjungi Toko
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-info-circle text-emerald-600"></i>
                            Deskripsi Produk
                        </h3>
                        <div class="prose prose-sm text-gray-600">
                            <p class="whitespace-pre-wrap leading-relaxed">{{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if($relatedProducts->isNotEmpty())
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-1">
                            <i class="fas fa-th-large text-emerald-600 mr-2"></i>Produk Serupa
                        </h2>
                        <p class="text-gray-600">Pilihan lain dari {{ $product->category->name }}</p>
                    </div>
                    <a href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 border-2 border-emerald-500 text-emerald-600 font-semibold rounded-xl hover:bg-emerald-500 hover:text-white transition-all duration-300">
                        Lihat Semua <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <x-eco-loop::product-card :product="$relatedProduct" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @push('scripts')
    <script>
        function incrementQty(max) {
            const input = document.getElementById('quantity');
            const current = parseInt(input.value);
            if (current < max) {
                input.value = current + 1;
            }
        }

        function decrementQty() {
            const input = document.getElementById('quantity');
            const current = parseInt(input.value);
            if (current > 1) {
                input.value = current - 1;
            }
        }

        function changeMainImage(src) {
            document.getElementById('mainImage').src = src;
        }

        function copyProductLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Link Disalin!',
                    text: 'Link produk berhasil disalin ke clipboard',
                    showConfirmButton: false,
                    timer: 2000,
                    position: 'top-end',
                    toast: true
                });
            });
        }
    </script>
    @endpush
</x-eco-loop-layout>
