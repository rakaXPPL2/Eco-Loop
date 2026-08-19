<x-eco-loop-layout title="Tanya Produk - Eco-Loop">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <a href="{{ route('products.show', $product) }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-semibold mb-6 transition-colors">
            <i class="fas fa-arrow-left"></i> Kembali ke Produk
        </a>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Product Info -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden sticky top-24">
                    @if($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-emerald-100 flex items-center justify-center">
                            <i class="fas fa-image text-6xl text-emerald-300"></i>
                        </div>
                    @endif

                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 mb-1">{{ $product->name }}</h3>
                        <p class="text-2xl font-bold text-emerald-600 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <i class="fas fa-leaf text-emerald-500"></i>
                            <span>{{ $product->carbon_display }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Form -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-teal-50">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <i class="fas fa-comments text-emerald-600"></i> Tanya ke Penjual
                        </h2>
                        <p class="text-gray-600 text-sm mt-1">Tanyakan tentang produk ini ke {{ $product->user->name }}</p>
                    </div>

                    <form action="{{ route('products.chat.send', $product) }}" method="POST" class="p-6 space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-heading text-gray-400 mr-1"></i> Subjek <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all @error('subject') border-red-500 @enderror"
                                placeholder="Contoh: Ketersediaan produk, Detail ukuran">
                            @error('subject')
                                <p class="mt-1 text-sm text-red-500"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-comment text-gray-400 mr-1"></i> Pesan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="content" rows="6" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none @error('content') border-red-500 @enderror"
                                placeholder="Tulis pertanyaan Anda tentang produk ini...">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-500"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                                <div class="text-sm text-blue-800">
                                    <p class="font-semibold">Tips:</p>
                                    <ul class="mt-1 space-y-1 list-disc list-inside">
                                        <li>Tanyakan tentang ketersediaan stock</li>
                                        <li>Minta foto atau detail produk lebih lanjut</li>
                                        <li>Tanyakan tentang pengiriman dan ongkir</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane"></i> Kirim Pesan
                        </button>
                    </form>
                </div>

                <!-- Previous Messages -->
                @if($messages->count() > 0)
                    <div class="mt-6 bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="p-4 border-b border-gray-100 bg-gray-50">
                            <h3 class="font-bold text-gray-900 flex items-center gap-2">
                                <i class="fas fa-history text-gray-500"></i> Percakapan Sebelumnya
                            </h3>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @foreach($messages->take(5) as $msg)
                                <div class="p-4">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-user text-emerald-600"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2">
                                                <span class="font-semibold text-gray-900">{{ $msg->sender_id === auth()->id() ? 'Anda' : $msg->sender->name }}</span>
                                                <span class="text-xs text-gray-500">{{ $msg->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($msg->content, 150) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($messages->count() > 5)
                            <div class="p-4 text-center border-t border-gray-100">
                                <a href="{{ route('messages.show', $product->user) }}" class="text-emerald-600 hover:text-emerald-700 font-semibold text-sm">
                                    Lihat semua percakapan <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-eco-loop-layout>
