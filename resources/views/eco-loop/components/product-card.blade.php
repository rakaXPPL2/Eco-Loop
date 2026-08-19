<div {{ $attributes->merge(['class' => 'glass-card-light rounded-2xl overflow-hidden group transition-all duration-500 hover:scale-105 hover:shadow-xl hover:shadow-emerald-200']) }}>
    <div class="relative">
        <div class="aspect-square bg-gradient-to-br from-emerald-50 to-teal-50 flex items-center justify-center overflow-hidden">
            @if($product->image)
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @else
                @php
                    $defaultIcon = $product->category->icon ?? 'fa-box';
                    $defaultColor = $product->category->getColors()['text'] ?? '#10b981';
                @endphp
                <i class="fas {{ $defaultIcon }} text-6xl" style="color: {{ $defaultColor }}; opacity: 0.5;"></i>
            @endif
        </div>

        <!-- Carbon Badge -->
        <div class="absolute top-3 left-3">
            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-emerald-500 to-teal-500 text-white shadow-lg shadow-emerald-200 transform transition-all duration-300 group-hover:scale-105">
                <i class="fas fa-leaf"></i>
                {{ number_format($product->carbon_saved, 2) }} kg CO2
            </span>
        </div>

        <!-- Condition Badge -->
        <div class="absolute top-3 right-3">
            @php
                $conditionLabels = [
                    'like_new' => 'Seperti Baru',
                    'good' => 'Bagus',
                    'fair' => 'Cukup',
                    'new' => 'Baru',
                ];
                $conditionColors = [
                    'like_new' => 'bg-gradient-to-r from-purple-500 to-purple-600',
                    'good' => 'bg-gradient-to-r from-blue-500 to-blue-600',
                    'fair' => 'bg-gradient-to-r from-amber-500 to-amber-600',
                    'new' => 'bg-gradient-to-r from-emerald-500 to-teal-500',
                ];
            @endphp
            <span class="px-3 py-1.5 rounded-full text-xs font-bold text-white shadow transform transition-all duration-300 group-hover:scale-105 {{ $conditionColors[$product->condition] ?? 'bg-gray-500' }}">
                {{ $conditionLabels[$product->condition] ?? $product->condition }}
            </span>
        </div>

        <!-- Stock Warning -->
        @if($product->stock <= 5 && $product->stock > 0)
            <div class="absolute bottom-3 left-3 right-3">
                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-lg">
                    <i class="fas fa-exclamation-triangle"></i>
                    Tersisa {{ $product->stock }}!
                </span>
            </div>
        @elseif($product->stock <= 0)
            <div class="absolute bottom-3 left-3 right-3">
                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold bg-gradient-to-r from-red-500 to-red-600 text-white shadow-lg">
                    <i class="fas fa-times-circle"></i>
                    Stok Habis
                </span>
            </div>
        @endif
    </div>

    <div class="p-5">
        <div class="flex items-center gap-2 mb-3">
            <span class="text-xs font-bold text-emerald-700 bg-emerald-100 border border-emerald-200 px-3 py-1 rounded-full flex items-center gap-1">
                <i class="fas fa-folder text-xs"></i> {{ $product->category->name ?? 'Tanpa Kategori' }}
            </span>
        </div>

        <h3 class="font-bold text-gray-800 text-base mb-3 line-clamp-2 group-hover:text-emerald-600 transition-colors duration-300 leading-tight">
            <a href="{{ route('products.show', $product) }}" class="hover:underline">{{ $product->name }}</a>
        </h3>

        <p class="text-2xl font-extrabold text-emerald-600 mb-4 flex items-center gap-2">
            <i class="fas fa-tag text-sm text-emerald-500"></i>
            Rp {{ number_format($product->price, 0, ',', '.') }}
        </p>

        <div class="flex items-center justify-between pt-3 border-t border-gray-200">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <i class="fas fa-weight-hanging text-emerald-500"></i>
                <span class="font-semibold">{{ $product->weight }} kg</span>
            </div>

            @if($product->city)
                <div class="flex items-center gap-1 text-xs text-gray-500">
                    <i class="fas fa-map-marker-alt text-emerald-400"></i>
                    <span>{{ $product->city }}</span>
                </div>
            @endif
        </div>

        <div class="mt-3 flex justify-end">
            @auth
                <form action="{{ route('cart.add', $product) }}" method="POST" class="inline" onsubmit="animateAddToCart(this.querySelector('button'))">
                    @csrf
                    <button type="submit" class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center transition-all duration-300 shadow-lg shadow-emerald-200 hover:shadow-xl hover:shadow-emerald-300 hover:scale-110 hover:from-emerald-600 hover:to-teal-700" title="Tambah ke Keranjang" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        <i class="fas fa-cart-plus text-lg"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center transition-all duration-300 shadow-lg shadow-emerald-200 hover:shadow-xl hover:shadow-emerald-300 hover:scale-110 hover:from-emerald-600 hover:to-teal-700" title="Login untuk Tambah ke Keranjang">
                    <i class="fas fa-cart-plus text-lg"></i>
                </a>
            @endauth
        </div>
    </div>
</div>
