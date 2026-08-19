<x-eco-loop-layout title="Keranjang Belanja - Eco-Loop">
    <!-- Header Banner -->
    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white mb-3">
                <i class="fas fa-shopping-cart mr-3"></i> Keranjang Belanja
            </h1>
            <p class="text-white/90 text-lg">Tinjau pilihan ramah lingkungan kamu</p>
        </div>
    </div>

    <div class="bg-gradient-to-br from-emerald-50/30 via-white to-teal-50/30 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Carbon Impact Banner -->
            @if($cart && $cart->items->count() > 0)
                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-3xl p-6 text-white shadow-xl mb-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-earth-americas text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-emerald-100 flex items-center gap-1">
                                    <i class="fas fa-hand-holding-heart"></i> Dampak Positif Kamu
                                </p>
                                <p class="text-3xl font-bold">{{ number_format($cart->total_carbon_saved, 2) }} kg CO<sub>2</sub></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-emerald-100">
                            <i class="fas fa-check-circle"></i>
                            <span class="hidden sm:inline font-medium">Pilihan yang bagus!</span>
                        </div>
                    </div>
                </div>
            @endif

            @if($cart && $cart->items->count() > 0)
                <!-- Cart Items Container -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-6">
                    <!-- Header -->
                    <div class="p-5 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-emerald-50 to-transparent">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-box text-emerald-600"></i>
                            </div>
                            <h2 class="text-lg font-bold text-gray-900">
                                {{ $cart->items->count() }} {{ $cart->items->count() == 1 ? 'Item' : 'Items' }}
                            </h2>
                        </div>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center gap-2 text-sm text-red-500 hover:text-red-700 font-medium transition-colors">
                                <i class="fas fa-trash-alt"></i> Hapus Semua
                            </button>
                        </form>
                    </div>

                    <!-- Items -->
                    <div class="divide-y divide-gray-100">
                        @foreach($cart->items as $item)
                            <div class="p-5 hover:bg-emerald-50/30 transition-colors">
                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                    <!-- Product Image -->
                                    <div class="flex items-center gap-4 flex-1">
                                        <div class="relative flex-shrink-0">
                                            @if($item->product->image)
                                                <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-20 h-20 rounded-xl object-cover shadow-md ring-2 ring-emerald-100">
                                            @else
                                                <div class="w-20 h-20 bg-emerald-50 rounded-xl flex items-center justify-center shadow-md">
                                                    <i class="fas fa-image text-2xl text-emerald-400"></i>
                                                </div>
                                            @endif
                                            <!-- Carbon Badge -->
                                            <div class="absolute -bottom-2 -right-2 px-2 py-1 bg-emerald-500 text-white text-xs font-bold rounded-lg shadow">
                                                <i class="fas fa-leaf mr-1"></i>
                                                {{ $item->carbon_saved * $item->quantity }}kg
                                            </div>
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-bold text-gray-900 truncate group-hover:text-emerald-600 transition-colors">{{ $item->product->name }}</h3>
                                            <p class="text-sm text-gray-500 flex items-center gap-1">
                                                <i class="fas fa-folder text-gray-400"></i> {{ $item->product->category->name ?? 'Tanpa Kategori' }}
                                            </p>
                                            <p class="text-sm text-emerald-600 flex items-center gap-1 mt-1 font-medium">
                                                <i class="fas fa-seedling"></i> Hemat {{ $item->carbon_saved * $item->quantity }} kg CO<sub>2</sub>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Quantity & Price Controls -->
                                    <div class="flex items-center gap-4 flex-shrink-0">
                                        <!-- Quantity Controls - Using Forms with POST method -->
                                        <div class="flex items-center rounded-xl border-2 border-gray-200 overflow-hidden">
                                            <!-- Decrease Button -->
                                            <form action="{{ route('cart.update', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                                <button type="submit"
                                                        class="px-3 py-2 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                        {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                    <i class="fas fa-minus text-sm"></i>
                                                </button>
                                            </form>

                                            <span class="px-4 py-2 font-bold text-gray-900 min-w-[60px] text-center bg-gray-50">{{ $item->quantity }}</span>

                                            <!-- Increase Button -->
                                            <form action="{{ route('cart.update', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                                <button type="submit"
                                                        class="px-3 py-2 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors {{ $item->quantity >= $item->product->stock ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                        {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                                    <i class="fas fa-plus text-sm"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Price -->
                                        <div class="text-right min-w-[120px]">
                                            <p class="font-bold text-xl text-gray-900">
                                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                            </p>
                                            <p class="text-xs text-gray-500 flex items-center justify-end gap-1">
                                                <i class="fas fa-tag"></i> Rp {{ number_format($item->product->price, 0, ',', '.') }} per item
                                            </p>
                                        </div>

                                        <!-- Remove Button -->
                                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-3 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all" title="Hapus item">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Stock Warning -->
                                @if($item->product->stock <= 5 && $item->product->stock > 0)
                                    <div class="mt-4 flex items-center gap-2 text-sm text-amber-600 bg-amber-50 px-4 py-2 rounded-xl inline-flex">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Tersisa {{ $item->product->stock }} item lagi!
                                    </div>
                                @elseif($item->product->stock <= 0)
                                    <div class="mt-4 flex items-center gap-2 text-sm text-red-600 bg-red-50 px-4 py-2 rounded-xl inline-flex">
                                        <i class="fas fa-times-circle"></i> Stok habis
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Cart Summary -->
                    <div class="p-6 bg-gradient-to-r from-emerald-50/50 to-white border-t border-gray-100">
                        <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                            <div class="flex items-center gap-6 text-sm text-gray-600">
                                <span class="flex items-center gap-2 bg-gray-100 px-4 py-2 rounded-xl">
                                    <i class="fas fa-tag text-gray-500"></i> Subtotal
                                    <span class="font-bold text-gray-900">Rp {{ number_format($cart->items->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }}</span>
                                </span>
                                <span class="flex items-center gap-2 text-emerald-600 bg-emerald-50 px-4 py-2 rounded-xl">
                                    <i class="fas fa-truck"></i> Pengiriman <span class="font-bold">Gratis</span>
                                </span>
                            </div>
                            <div class="text-center lg:text-right">
                                <div class="flex items-center gap-2 text-sm text-emerald-600 mb-2 bg-emerald-50 px-4 py-2 rounded-xl inline-flex">
                                    <i class="fas fa-leaf"></i> Hemat {{ $cart->total_carbon_saved }} kg CO<sub>2</sub>
                                </div>
                                <div class="flex items-baseline gap-3 justify-center lg:justify-end">
                                    <span class="text-gray-700 font-medium">Total</span>
                                    <span class="text-4xl font-bold text-emerald-600">
                                        Rp {{ number_format($cart->items->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('products.index') }}" class="btn-eco-outline flex-1 flex items-center justify-center gap-2">
                        <i class="fas fa-arrow-left"></i>
                        Lanjut Belanja
                    </a>
                    <a href="{{ route('checkout') }}" class="btn-eco flex-1 flex items-center justify-center gap-2">
                        Lanjut ke Pembayaran
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-16 text-center">
                    <div class="relative inline-block mb-6">
                        <div class="w-28 h-28 mx-auto bg-emerald-100 rounded-full flex items-center justify-center transform transition-all hover:scale-110">
                            <i class="fas fa-shopping-cart text-6xl text-emerald-400"></i>
                        </div>
                        <!-- Decorative Elements -->
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-amber-400 rounded-xl shadow-lg"></div>
                        <div class="absolute -bottom-2 -left-4 w-6 h-6 bg-cyan-400 rounded-full shadow-lg"></div>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-3">Keranjang kamu kosong</h2>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto text-lg">
                        Sepertinya kamu belum menambahkan produk ramah lingkungan. Mulai belanja untuk membuat perubahan!
                    </p>
                    <a href="{{ route('products.index') }}" class="btn-eco inline-flex items-center gap-2 px-8 py-4 text-lg">
                        <i class="fas fa-leaf"></i>
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-eco-loop-layout>
