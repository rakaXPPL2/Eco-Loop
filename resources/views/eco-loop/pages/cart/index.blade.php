<x-eco-loop-layout title="Keranjang Belanja - Eco-Loop">
    <!-- Header Banner -->
    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white mb-3">
                <i class="fas fa-shopping-cart mr-3"></i> Keranjang Belanja
            </h1>
            <p class="text-white/90 text-lg">Periksa barang sebelum checkout</p>
        </div>
    </div>

    <div class="bg-gradient-to-br from-emerald-50/30 via-white to-teal-50/30 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if($cart && $cart->items->count() > 0)
            <div class="space-y-4">
                @foreach($cart->items as $item)
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                        <div class="flex flex-col md:flex-row gap-6">
                            <!-- Product Image -->
                            <div class="w-24 h-24 bg-emerald-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                @if($item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}"
                                         class="w-full h-full object-cover rounded-xl">
                                @else
                                    <i class="fas {{ $item->product->category->icon ?? 'fa-box' }} text-3xl text-emerald-500"></i>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">{{ $item->product->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $item->product->category->name }}</p>
                                        <p class="text-emerald-600 font-bold mt-1">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-500 text-white">
                                            <i class="fas fa-leaf mr-1"></i>
                                            {{ number_format($item->carbon_saved, 2) }} kg CO2
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between mt-4">
                                    <!-- Quantity -->
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <label class="text-sm text-gray-600">Jumlah:</label>
                                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                                               min="1" max="{{ $item->product->stock }}"
                                               class="w-20 px-3 py-2 border-2 border-gray-200 rounded-lg text-center focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200">
                                        <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>

                                    <!-- Remove -->
                                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary -->
            <div class="bg-white rounded-2xl p-6 mt-6 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-gray-600">Total Barang</span>
                    <span class="font-bold text-gray-800">{{ $cart->item_count }} item</span>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <span class="text-gray-600">Total Karbon Terhemat</span>
                    <span class="text-xl font-bold text-emerald-600">
                        <i class="fas fa-leaf mr-2"></i>
                        {{ number_format($cart->total_carbon_saved, 2) }} kg CO2
                    </span>
                </div>
                <div class="flex items-center justify-between text-2xl font-bold text-gray-800 pt-4 border-t border-gray-200">
                    <span>Total Bayar</span>
                    <span class="text-emerald-600">Rp {{ number_format($cart->total_amount, 0, ',', '.') }}</span>
                </div>

                <div class="flex gap-4 mt-6">
                    <a href="{{ route('products.index') }}" class="btn-eco-outline flex-1 text-center">
                        <i class="fas fa-arrow-left mr-2"></i> Lanjut Belanja
                    </a>
                    <a href="{{ route('checkout') }}" class="btn-eco flex-1 text-center">
                        <i class="fas fa-credit-card mr-2"></i> Checkout
                    </a>
                </div>
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Keranjang Kosong</h3>
                <p class="text-gray-500 mb-6">Yuk mulai belanja untuk kurangi jejak karbon!</p>
                <a href="{{ route('products.index') }}" class="btn-eco inline-flex items-center gap-2">
                    <i class="fas fa-store"></i> Lihat Katalog
                </a>
            </div>
        @endif
    </div>
</x-eco-loop-layout>
