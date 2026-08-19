<x-eco-loop-layout title="Pembayaran">
    <div class="bg-gradient-to-br from-emerald-50/30 via-white to-teal-50/30 min-h-screen">
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 py-8 md:py-12">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 md:mb-3 flex items-center justify-center gap-3">
                    <i class="fas fa-credit-card"></i> Pembayaran
                </h1>
                <p class="text-white/90 text-base md:text-lg flex items-center justify-center gap-2">
                    <i class="fas fa-leaf"></i> Selesaikan pembelian ramah lingkungan kamu
                </p>
            </div>
        </div>

    <div class="max-w-3xl mx-auto space-y-4 md:space-y-6 px-4 sm:px-6 lg:px-8 py-6 md:py-8">

        <!-- Carbon Impact Banner -->
        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl md:rounded-2xl p-5 md:p-6 text-white shadow-xl transform transition-all duration-500 hover:scale-[1.02] animate-fade-in-up delay-100">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 md:gap-4">
                <div class="flex items-center gap-3 md:gap-4">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-white/20 rounded-full flex items-center justify-center transform transition-transform duration-300 hover:scale-110">
                        <i class="fas fa-earth-americas text-xl md:text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-emerald-100 flex items-center gap-1">
                            <i class="fas fa-hand-holding-heart"></i> Dampak Positif Kamu
                        </p>
                        <p class="text-2xl md:text-3xl font-bold">{{ $totalCarbonSaved ?? 0 }} kg CO<sub>2</sub></p>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-emerald-100 text-sm">
                    <i class="fas fa-check-circle"></i>
                    <span class="hidden sm:inline">Kamu akan menghemat karbon ini dengan memilih berkelanjutan!</span>
                </div>
            </div>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4 md:space-y-6">
            @csrf

            <!-- Cart Items Summary -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-4 md:p-5 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-transparent">
                    <h2 class="text-base md:text-lg font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-shopping-bag text-emerald-600"></i> Ringkasan Pesanan
                    </h2>
                </div>
                <div class="p-4 md:p-5 space-y-3 md:space-y-4">
                    @forelse($cartItems ?? [] as $item)
                        <div class="flex items-center justify-between py-2 md:py-3 border-b border-gray-50 last:border-0 transition-colors duration-300 hover:bg-emerald-50/30 -mx-4 md:-mx-5 px-4 md:px-5">
                            <div class="flex items-center space-x-3 md:space-x-4">
                                @if($item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-12 h-12 md:w-14 md:h-14 rounded-lg md:rounded-xl object-cover shadow-md transform transition-transform duration-300 hover:scale-105">
                                @else
                                    <div class="w-12 h-12 md:w-14 md:h-14 bg-emerald-100 rounded-lg md:rounded-xl flex items-center justify-center shadow-md">
                                        <i class="fas fa-image text-emerald-600"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm md:text-base">{{ $item->product->name }}</p>
                                    <p class="text-xs md:text-sm text-gray-600 flex items-center gap-1">
                                        <i class="fas fa-box text-gray-500"></i> Qty: {{ $item->quantity }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900 text-sm md:text-base">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                                @if($item->product->carbon_saved)
                                    <p class="text-xs text-emerald-600 flex items-center justify-end gap-1">
                                        <i class="fas fa-leaf"></i> -{{ $item->product->carbon_saved * $item->quantity }} kg CO<sub>2</sub>
                                    </p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 md:py-8">
                            <div class="w-14 h-14 md:w-16 md:h-16 mx-auto mb-3 md:mb-4 bg-gray-100 rounded-xl md:rounded-2xl flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-xl md:text-2xl text-gray-400"></i>
                            </div>
                            <p class="text-gray-600 text-sm md:text-base">Keranjang kamu kosong</p>
                            <a href="{{ route('products.index') }}" class="mt-2 inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-semibold transition-colors text-sm md:text-base">
                                <i class="fas fa-arrow-left"></i> Lanjut Belanja
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Order Totals -->
                @if($cartItems && $cartItems->count() > 0)
                    <div class="p-4 md:p-5 bg-gradient-to-r from-emerald-50/50 to-white border-t border-gray-100 space-y-2 md:space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 flex items-center gap-2">
                                <i class="fas fa-tag text-gray-500"></i> Subtotal
                            </span>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 flex items-center gap-2">
                                <i class="fas fa-truck text-gray-500"></i> Pengiriman
                            </span>
                            <span class="font-semibold text-emerald-600">Gratis</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 flex items-center gap-2">
                                <i class="fas fa-leaf text-gray-500"></i> Penghematan Karbon
                            </span>
                            <span class="font-semibold text-emerald-600">-{{ $totalCarbonSaved ?? 0 }} kg CO<sub>2</sub></span>
                        </div>
                        <div class="flex justify-between text-base md:text-lg font-bold pt-2 md:pt-3 border-t border-gray-200">
                            <span class="text-gray-900">Total</span>
                            <span class="text-emerald-600">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Payment Method Selection -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-4 md:p-5 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-transparent">
                    <h2 class="text-base md:text-lg font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-wallet text-emerald-600"></i> Metode Pembayaran
                    </h2>
                </div>
                <div class="p-4 md:p-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                        @foreach($paymentMethods as $method)
                            <label class="payment-option relative block cursor-pointer group">
                                <input type="radio" name="payment_method" value="{{ $method['id'] }}"
                                    class="absolute inset-0 z-10 opacity-0 cursor-pointer"
                                    {{ old('payment_method') === $method['id'] ? 'checked' : '' }}
                                    required>
                                <div class="payment-card p-4 md:p-5 rounded-xl border-2 border-gray-200 transition-all duration-300
                                    @error('payment_method') border-red-500 @enderror">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg md:rounded-xl bg-gradient-to-br
                                            @if($method['color'] === 'blue') from-blue-100 to-blue-200
                                            @elseif($method['color'] === 'purple') from-purple-100 to-purple-200
                                            @elseif($method['color'] === 'teal') from-teal-100 to-teal-200
                                            @else from-green-100 to-green-200
                                            @endif
                                            flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                            <i class="fas {{ $method['icon'] }}
                                                @if($method['color'] === 'blue') text-blue-600
                                                @elseif($method['color'] === 'purple') text-purple-600
                                                @elseif($method['color'] === 'teal') text-teal-600
                                                @else text-green-600
                                                @endif text-lg md:text-xl"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-gray-800 text-sm md:text-base">{{ $method['name'] }}</p>
                                            <p class="text-xs md:text-sm text-gray-500 mt-0.5">{{ $method['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <span class="payment-checkmark absolute right-4 top-4 flex h-5 w-5 items-center justify-center rounded-full border-2 border-gray-300 bg-white transition-all duration-200">
                                    <i class="check-icon fas fa-check text-white text-[10px] transition-all duration-200"></i>
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('payment_method')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-4 md:p-5 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-transparent">
                    <h2 class="text-base md:text-lg font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-truck text-emerald-600"></i> Alamat Pengiriman
                    </h2>
                </div>
                <div class="p-4 md:p-5 space-y-3 md:space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-1 md:mb-2">
                                <i class="fas fa-user text-gray-500 mr-1"></i> Nama Depan
                            </label>
                            <input type="text" id="first_name" name="first_name" value="{{ auth()->user()->first_name ?? '' }}" required
                                class="input-eco @error('first_name') border-red-500 @enderror">
                            @error('first_name')
                                <p class="mt-1 md:mt-2 text-xs md:text-sm text-red-500 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-1 md:mb-2">
                                <i class="fas fa-user text-gray-500 mr-1"></i> Nama Belakang
                            </label>
                            <input type="text" id="last_name" name="last_name" value="{{ auth()->user()->last_name ?? '' }}" required
                                class="input-eco @error('last_name') border-red-500 @enderror">
                            @error('last_name')
                                <p class="mt-1 md:mt-2 text-xs md:text-sm text-red-500 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1 md:mb-2">
                            <i class="fas fa-envelope text-gray-500 mr-1"></i> Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email ?? '' }}" required
                            class="input-eco @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 md:mt-2 text-xs md:text-sm text-red-500 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1 md:mb-2">
                            <i class="fas fa-phone text-gray-500 mr-1"></i> Telepon
                        </label>
                        <input type="tel" id="phone" name="phone" value="{{ auth()->user()->phone ?? '' }}" required
                            class="input-eco @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="mt-1 md:mt-2 text-xs md:text-sm text-red-500 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-1 md:mb-2">
                            <i class="fas fa-map-marker-alt text-gray-500 mr-1"></i> Alamat Jalan
                        </label>
                        <input type="text" id="address" name="address" value="{{ auth()->user()->address ?? '' }}" required
                            class="input-eco @error('address') border-red-500 @enderror">
                        @error('address')
                            <p class="mt-1 md:mt-2 text-xs md:text-sm text-red-500 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4">
                        <div class="col-span-1">
                            <label for="city" class="block text-sm font-semibold text-gray-700 mb-1 md:mb-2">
                                <i class="fas fa-city text-gray-500 mr-1"></i> Kota
                            </label>
                            <input type="text" id="city" name="city" value="{{ auth()->user()->city ?? '' }}" required
                                class="input-eco @error('city') border-red-500 @enderror">
                            @error('city')
                                <p class="mt-1 md:mt-2 text-xs md:text-sm text-red-500 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-span-1">
                            <label for="state" class="block text-sm font-semibold text-gray-700 mb-1 md:mb-2">
                                <i class="fas fa-map text-gray-500 mr-1"></i> Provinsi
                            </label>
                            <input type="text" id="state" name="state" value="{{ auth()->user()->state ?? '' }}" required
                                class="input-eco @error('state') border-red-500 @enderror">
                            @error('state')
                                <p class="mt-1 md:mt-2 text-xs md:text-sm text-red-500 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label for="zip" class="block text-sm font-semibold text-gray-700 mb-1 md:mb-2">
                                <i class="fas fa-mail-bulk text-gray-500 mr-1"></i> Kode Pos
                            </label>
                            <input type="text" id="zip" name="zip" value="{{ auth()->user()->zip ?? '' }}" required
                                class="input-eco @error('zip') border-red-500 @enderror">
                            @error('zip')
                                <p class="mt-1 md:mt-2 text-xs md:text-sm text-red-500 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Notes -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-4 md:p-5 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-transparent">
                    <h2 class="text-base md:text-lg font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-sticky-note text-emerald-600"></i> Catatan Pesanan (Opsional)
                    </h2>
                </div>
                <div class="p-4 md:p-5">
                    <label for="notes" class="block text-sm font-semibold text-gray-700 mb-1 md:mb-2">
                        <i class="fas fa-comment text-gray-500 mr-1"></i> Instruksi khusus atau catatan
                    </label>
                    <textarea id="notes" name="notes" rows="3"
                        class="input-eco resize-none text-sm md:text-base"
                        placeholder="Instruksi pengiriman khusus atau catatan tentang pesanan kamu...">{{ old('notes') }}</textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                <a href="{{ route('cart.index') }}" class="btn-eco-outline flex-1 flex items-center justify-center gap-2 text-sm md:text-base">
                    <i class="fas fa-arrow-left"></i> Kembali ke Keranjang
                </a>
                <button type="submit" @disabled(empty($cartItems) || $cartItems->isEmpty())
                    class="btn-eco flex-1 flex items-center justify-center gap-2 text-sm md:text-base">
                    <i class="fas fa-check-circle"></i>
                    <span>Bayar Sekarang</span>
                </button>
            </div>
        </form>
    </div>
</x-eco-loop-layout>
