<x-eco-loop-layout title="Detail Pesanan">
    @php
        $user = auth()->user();
        $isSeller = $user->isSeller();
        $displayItems = $isSeller
            ? $order->items->filter(fn($item) => $item->seller_id === $user->id)
            : $order->items;
        $displaySubtotal = $displayItems->sum(fn($item) => (float) ($item->price * $item->quantity));
    @endphp

    <div class="min-h-screen bg-gradient-to-br from-emerald-50/30 via-white to-teal-50/30">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
            <!-- Back Button & Header -->
            <div class="flex items-center justify-between">
                <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-emerald-600 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Daftar Pesanan</span>
                </a>
                <span class="px-4 py-2 rounded-full text-sm font-bold
                    @if($order->status === 'completed') bg-emerald-100 text-emerald-700
                    @elseif($order->status === 'pending') bg-amber-100 text-amber-700
                    @elseif($order->status === 'processing') bg-blue-100 text-blue-700
                    @elseif($order->status === 'shipped') bg-purple-100 text-purple-700
                    @elseif($order->status === 'cancelled') bg-red-100 text-red-700
                    @endif">
                    <i class="fas fa-circle text-xs mr-1 animate-pulse"></i>
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <!-- Order Header Card -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-fade-in-up">
                <div class="p-6 bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-gray-100">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center">
                                    <i class="fas fa-shopping-bag text-white"></i>
                                </div>
                                Pesanan {{ $order->order_number }}
                            </h1>
                            <p class="text-gray-500 mt-1 flex items-center gap-2">
                                <i class="fas fa-calendar"></i>
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-3xl font-bold text-emerald-600">Rp {{ number_format($order->total_amount, 0) }}</p>
                            <p class="text-sm text-emerald-500 flex items-center justify-end gap-1 mt-1">
                                <i class="fas fa-leaf"></i> {{ $order->total_carbon_saved ?? 0 }} kg CO₂ dihemat
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <!-- Status Timeline -->
                    <div class="flex items-center justify-between mb-8">
                        @php
                            $statuses = ['pending' => 'Pending', 'processing' => 'Diproses', 'shipped' => 'Dikirim', 'completed' => 'Selesai'];
                            $currentIndex = array_search($order->status, array_keys($statuses));
                            if ($order->status === 'cancelled') $currentIndex = -1;
                        @endphp
                        @foreach($statuses as $key => $label)
                            @php
                                $index = $loop->index;
                                $isCompleted = $index <= $currentIndex;
                                $isCurrent = $index === $currentIndex;
                            @endphp
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2
                                    @if($isCompleted)
                                        bg-emerald-500 text-white
                                    @else
                                        bg-gray-200 text-gray-400
                                    @endif
                                    {{ $isCurrent ? 'ring-4 ring-emerald-200' : '' }}">
                                    @if($isCompleted && !$isCurrent)
                                        <i class="fas fa-check"></i>
                                    @elseif($isCurrent)
                                        <i class="fas fa-spinner animate-spin"></i>
                                    @else
                                        <span class="text-sm font-bold">{{ $loop->index + 1 }}</span>
                                    @endif
                                </div>
                                <span class="text-xs font-medium {{ $isCompleted ? 'text-emerald-600' : 'text-gray-400' }}">{{ $label }}</span>
                            </div>
                            @if(!$loop->last)
                                <div class="flex-1 h-1 mx-2 rounded
                                    @if($index < $currentIndex)
                                        bg-emerald-500
                                    @else
                                        bg-gray-200
                                    @endif"></div>
                            @endif
                        @endforeach
                    </div>

                    @if($order->status === 'cancelled')
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                            <i class="fas fa-times-circle text-red-500 text-2xl mb-2"></i>
                            <p class="text-red-700 font-semibold">Pesanan ini telah dibatalkan</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Customer Info -->
                <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-fade-in-up">
                    <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-transparent">
                        <h2 class="font-bold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-user text-blue-500"></i>
                            @if($isSeller)
                                Info Pembeli
                            @else
                                Info Pengiriman
                            @endif
                        </h2>
                    </div>
                    <div class="p-5 space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user text-blue-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Nama</p>
                                <p class="font-semibold text-gray-800">{{ $order->user->name }}</p>
                            </div>
                        </div>
                        @if($order->shipping_address)
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-blue-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Alamat</p>
                                    <p class="font-semibold text-gray-800">{{ $order->shipping_address }}</p>
                                </div>
                            </div>
                        @endif
                        @if($order->notes)
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-sticky-note text-blue-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Catatan</p>
                                    <p class="font-semibold text-gray-800">{{ $order->notes }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-fade-in-up">
                    <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-amber-50 to-transparent">
                        <h2 class="font-bold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-receipt text-amber-500"></i>
                            Ringkasan Pesanan
                        </h2>
                    </div>
                    <div class="p-5 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-semibold">Rp {{ number_format($displaySubtotal, 0) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Pengiriman</span>
                            <span class="font-semibold text-emerald-600">Gratis</span>
                        </div>
                        <hr class="border-gray-100">
                        <div class="flex justify-between">
                            <span class="font-bold text-gray-800">Total</span>
                            <span class="font-bold text-xl text-emerald-600">Rp {{ number_format($order->total_amount, 0) }}</span>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-3 text-center">
                            <i class="fas fa-leaf text-emerald-500 mr-1"></i>
                            <span class="text-emerald-700 font-semibold">{{ $order->total_carbon_saved ?? 0 }} kg CO₂ dihemat</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-fade-in-up">
                <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-transparent">
                    <h2 class="font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-box text-purple-500"></i>
                        Item Pesanan ({{ $order->items->count() }} item)
                    </h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($displayItems as $item)
                        <div class="p-5 flex items-center gap-4 hover:bg-gray-50 transition-colors">
                            <div class="w-16 h-16 rounded-xl bg-emerald-100 flex items-center justify-center overflow-hidden">
                                @if($item->product && $item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-box text-2xl text-emerald-500"></i>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-800">{{ $item->product->name ?? 'Produk tidak ditemukan' }}</h3>
                                <p class="text-sm text-gray-500 flex items-center gap-2">
                                    <i class="fas fa-times"></i> {{ $item->quantity }} x Rp {{ number_format($item->price, 0) }}
                                    @if($isSeller)
                                        <span class="ml-2 text-emerald-500">
                                            <i class="fas fa-leaf"></i> {{ $item->carbon_saved }} kg
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0) }}</p>
                                @if($isSeller)
                                    <p class="text-xs text-gray-500">Profit Anda</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons for Seller -->
            @if($isSeller && in_array($order->status, ['pending', 'processing', 'shipped']))
                <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-fade-in-up">
                    <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-transparent">
                        <h2 class="font-bold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-cogs text-emerald-500"></i>
                            Aksi Seller
                        </h2>
                    </div>
                    <div class="p-5 flex flex-wrap gap-3">
                        @if($order->status === 'pending')
                            <form action="{{ route('orders.update-status', $order) }}" method="POST" class="inline-flex">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="processing">
                                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-xl transition-all shadow-md">
                                    <i class="fas fa-spinner"></i> Proses Pesanan
                                </button>
                            </form>
                        @endif

                        @if($order->status === 'processing')
                            <form action="{{ route('orders.update-status', $order) }}" method="POST" enctype="multipart/form-data" class="w-full max-w-xl space-y-4 rounded-2xl border border-purple-200 bg-gradient-to-br from-purple-50 to-violet-50 p-5 shadow-sm">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="shipped">

                                <div class="flex items-center gap-2 text-purple-700">
                                    <i class="fas fa-truck-fast"></i>
                                    <h3 class="text-base font-bold">Jasa Pengiriman</h3>
                                </div>

                                <div>
                                    <label for="shipping_provider_{{ $order->id }}" class="mb-1 block text-sm font-semibold text-gray-700">Nama Kurir / Ekspedisi</label>
                                    <select id="shipping_provider_{{ $order->id }}" name="shipping_provider" required class="w-full rounded-xl border border-purple-200 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-purple-400 focus:ring-2 focus:ring-purple-200">
                                        <option value="" disabled {{ old('shipping_provider') ? '' : 'selected' }}>Pilih jasa pengiriman</option>
                                        <option value="J&T" {{ old('shipping_provider') === 'J&T' ? 'selected' : '' }}>J&T (Rekomendasi)</option>
                                        <option value="JNE" {{ old('shipping_provider') === 'JNE' ? 'selected' : '' }}>JNE</option>
                                        <option value="Pos Indonesia" {{ old('shipping_provider') === 'Pos Indonesia' ? 'selected' : '' }}>Pos Indonesia</option>
                                        <option value="Lion Parcel" {{ old('shipping_provider') === 'Lion Parcel' ? 'selected' : '' }}>Lion Parcel</option>
                                        <option value="Wahana" {{ old('shipping_provider') === 'Wahana' ? 'selected' : '' }}>Wahana</option>
                                        <option value="GoSend" {{ old('shipping_provider') === 'GoSend' ? 'selected' : '' }}>GoSend</option>
                                        <option value="GrabExpress" {{ old('shipping_provider') === 'GrabExpress' ? 'selected' : '' }}>GrabExpress</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="tracking_number_{{ $order->id }}" class="mb-1 block text-sm font-semibold text-gray-700">Nomor Resi</label>
                                    <input id="tracking_number_{{ $order->id }}" type="text" name="tracking_number" value="{{ old('tracking_number') }}" required class="w-full rounded-xl border border-purple-200 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-purple-400 focus:ring-2 focus:ring-purple-200">
                                </div>

                                <div>
                                    <label for="shipping_proof_photo_{{ $order->id }}" class="mb-1 block text-sm font-semibold text-gray-700">Bukti Pengiriman</label>
                                    <input id="shipping_proof_photo_{{ $order->id }}" type="file" name="shipping_proof_photo" accept="image/*" required class="w-full rounded-xl border border-dashed border-purple-200 bg-white px-4 py-3 text-sm text-gray-700 file:mr-3 file:rounded file:border-0 file:bg-purple-100 file:px-3 file:py-2 file:text-sm file:font-medium file:text-purple-700">
                                </div>

                                <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-purple-500 to-violet-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-purple-500/20 transition hover:from-purple-600 hover:to-violet-600">
                                    <i class="fas fa-truck"></i> Kirim Pesanan
                                </button>
                            </form>
                        @endif

                        @if($order->status === 'shipped')
                            <form action="{{ route('orders.update-status', $order) }}" method="POST" class="inline-flex">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl transition-all shadow-md">
                                    <i class="fas fa-check-circle"></i> Tandai Selesai
                                </button>
                            </form>
                        @endif

                        @if(in_array($order->status, ['pending', 'processing']))
                            <form action="{{ route('orders.update-status', $order) }}" method="POST" class="inline-flex" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl transition-all shadow-md">
                                    <i class="fas fa-times-circle"></i> Batalkan Pesanan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Message to Buyer -->
            @if($isSeller && $order->status !== 'completed' && $order->status !== 'cancelled')
                <div class="bg-blue-50 border border-blue-200 rounded-2xl p-5 animate-fade-in-up">
                    <h3 class="font-bold text-blue-800 flex items-center gap-2 mb-3">
                        <i class="fas fa-info-circle"></i> Kirim Pesan ke Pembeli
                    </h3>
                    <form action="{{ route('messages.store') }}" method="POST" class="flex gap-3">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $order->user_id }}">
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <input type="text" name="message" placeholder="Ketik pesan untuk pembeli..." class="flex-1 px-4 py-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none">
                        <button type="submit" class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-xl transition-all">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-eco-loop-layout>
