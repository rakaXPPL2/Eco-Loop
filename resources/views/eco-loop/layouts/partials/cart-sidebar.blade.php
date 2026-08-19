<div id="cart-sidebar" class="fixed inset-y-0 right-0 w-full md:w-96 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 z-50 flex flex-col">
    <!-- Header -->
    <div class="flex items-center justify-between p-4 border-b bg-gradient-to-r from-emerald-50 to-transparent">
        <h3 class="text-lg font-bold text-gray-800">
            <i class="fas fa-shopping-cart mr-2 text-emerald-600"></i>
            Keranjang Belanja
        </h3>
        <button onclick="toggleCart()" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
            <i class="fas fa-times text-gray-500"></i>
        </button>
    </div>

    <!-- Cart Content -->
    <div class="flex-1 overflow-y-auto p-4" id="cart-content">
        @auth
            @php
                $cart = \App\Models\Cart::with('items.product.category')->where('user_id', auth()->id())->first();
            @endphp

            @if($cart && $cart->items->count() > 0)
                <!-- Cart Items -->
                <div class="space-y-4">
                    @foreach($cart->items as $item)
                        <div class="flex gap-4 p-3 bg-gray-50 rounded-xl">
                            <div class="w-20 h-20 bg-emerald-50 rounded-lg flex items-center justify-center overflow-hidden">
                                @if($item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-box text-3xl text-emerald-400"></i>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800 text-sm">{{ $item->product->name }}</h4>
                                <p class="text-xs text-gray-500">{{ $item->product->category->name }}</p>
                                <div class="flex items-center gap-1 mt-1">
                                    <i class="fas fa-leaf text-emerald-500 text-xs"></i>
                                    <span class="text-xs text-emerald-600 font-medium">{{ number_format($item->carbon_saved, 2) }} kg CO2</span>
                                </div>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="font-bold text-emerald-600">Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('cart.update', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                                   class="w-12 px-2 py-1 text-sm border-2 border-gray-200 rounded text-center focus:border-emerald-500">
                                            <button type="submit" class="text-xs text-emerald-600 hover:text-emerald-700">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('cart.remove', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty Cart -->
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-shopping-cart text-4xl text-gray-300"></i>
                    </div>
                    <h4 class="font-semibold text-gray-700 mb-2">Keranjang Kosong</h4>
                    <p class="text-gray-500 text-sm mb-4">Yuk mulai belanja untuk kurangi jejak karbon!</p>
                    <a href="{{ route('products.index') }}" class="btn-eco" onclick="toggleCart()">
                        <i class="fas fa-store mr-2"></i> Lihat Katalog
                    </a>
                </div>
            @endif
        @else
            <!-- Not Logged In -->
            <div class="flex flex-col items-center justify-center h-full text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-user text-4xl text-gray-300"></i>
                </div>
                <h4 class="font-semibold text-gray-700 mb-2">Login Diperlukan</h4>
                <p class="text-gray-500 text-sm mb-4">Silakan login untuk menggunakan keranjang belanja</p>
                <a href="{{ route('login') }}" class="btn-eco">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
            </div>
        @endauth
    </div>

    <!-- Cart Footer -->
    @if(auth()->check() && $cart && $cart->items->count() > 0)
        <div class="border-t p-4 bg-gray-50">
            <!-- Carbon Saved -->
            <div class="flex items-center justify-between mb-4 p-3 bg-emerald-50 rounded-xl">
                <div class="flex items-center gap-2">
                    <i class="fas fa-leaf text-emerald-500 text-xl"></i>
                    <span class="text-gray-700 font-medium">Total Karbon Terhemat</span>
                </div>
                <span class="text-xl font-bold text-emerald-600">{{ number_format($cart->total_carbon_saved, 2) }} kg</span>
            </div>

            <!-- Total -->
            <div class="flex items-center justify-between mb-4">
                <span class="text-gray-600">Total Belanja</span>
                <span class="text-xl font-bold text-gray-800">Rp {{ number_format($cart->total_amount, 0, ',', '.') }}</span>
            </div>

            <!-- Checkout Button -->
            <a href="{{ route('checkout') }}" class="btn-eco w-full text-center">
                <i class="fas fa-credit-card mr-2"></i> Checkout
            </a>
        </div>
    @endif
</div>

<!-- Overlay -->
<div id="cart-overlay" onclick="toggleCart()" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
