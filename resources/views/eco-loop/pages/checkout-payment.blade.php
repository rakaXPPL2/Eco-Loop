<x-eco-loop-layout title="Instruksi Pembayaran">
    <div class="bg-gradient-to-br from-emerald-50/30 via-white to-teal-50/30 min-h-screen">
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 py-8 md:py-12">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 md:mb-3 flex items-center justify-center gap-3">
                    <i class="fas fa-credit-card"></i> Instruksi Pembayaran
                </h1>
                <p class="text-white/90 text-base md:text-lg flex items-center justify-center gap-2">
                    <i class="fas fa-receipt"></i> Pesanan #{{ $order->order_number }}
                </p>
            </div>
        </div>

        <div class="max-w-3xl mx-auto space-y-4 md:space-y-6 px-4 sm:px-6 lg:px-8 py-6 md:py-8">

            <!-- Order Summary Card -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-up">
                <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-transparent">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-receipt text-emerald-600"></i> Ringkasan Pesanan
                    </h2>
                </div>
                <div class="p-5 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 flex items-center gap-2">
                            <i class="fas fa-hashtag text-gray-400"></i> Nomor Pesanan
                        </span>
                        <span class="font-mono font-bold text-gray-900">{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 flex items-center gap-2">
                            <i class="fas fa-wallet text-gray-400"></i> Total Pembayaran
                        </span>
                        <span class="text-2xl font-bold text-emerald-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 flex items-center gap-2">
                            <i class="fas fa-leaf text-gray-400"></i> Penghematan Karbon
                        </span>
                        <span class="font-bold text-emerald-600">{{ $order->total_carbon_saved }} kg CO₂</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 flex items-center gap-2">
                            <i class="fas fa-clock text-gray-400"></i> Kadaluarsa
                        </span>
                        <span class="font-semibold {{ $order->isPaymentExpired() ? 'text-red-600' : 'text-gray-900' }}">
                            @if($order->payment_expires_at)
                                {{ $order->payment_expires_at->format('d M Y, H:i') }}
                            @else
                                Tidak terbatas
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Payment Status Alert -->
            @if($order->isPaymentExpired())
                <div class="bg-red-50 border border-red-200 rounded-xl p-5 animate-fade-in-up">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-red-800">Pembayaran Kedaluwarsa</h3>
                            <p class="text-sm text-red-600 mt-1">
                                Batas waktu pembayaran telah berakhir. Silakan buat pesanan baru.
                            </p>
                        </div>
                    </div>
                </div>
            @elseif($order->isPaymentPaid())
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-5 animate-fade-in-up">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check-circle text-emerald-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-emerald-800">Pembayaran Lunas</h3>
                            <p class="text-sm text-emerald-600 mt-1">
                                Pembayaran sudah dikonfirmasi. Pesanan Anda sedang diproses.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Payment Instructions Card -->
            @if(!$order->isPaymentPaid() && !$order->isPaymentExpired())
                <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-up">
                    <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-transparent">
                        <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <i class="fas fa-info-circle text-blue-600"></i> Cara Bayar
                        </h2>
                    </div>
                    <div class="p-5">
                        @if(isset($instructions))
                            <div class="mb-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 flex items-center gap-2">
                                    @if($instructions['type'] === 'bank_transfer')
                                        <i class="fas fa-university text-blue-600"></i>
                                    @elseif($instructions['type'] === 'e_wallet')
                                        <i class="fas fa-mobile-alt text-purple-600"></i>
                                    @elseif($instructions['type'] === 'qris')
                                        <i class="fas fa-qrcode text-teal-600"></i>
                                    @elseif($instructions['type'] === 'cod')
                                        <i class="fas fa-money-bill-wave text-green-600"></i>
                                    @endif
                                    {{ $instructions['title'] }}
                                </h3>
                            </div>

                            <!-- Bank Transfer Details -->
                            @if($instructions['type'] === 'bank_transfer')
                                <div class="bg-gray-50 rounded-xl p-4 mb-4 space-y-3">
                                    <p class="font-semibold text-gray-700">Transfer ke salah satu rekening berikut:</p>
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-3 p-3 bg-white rounded-lg border border-gray-200">
                                            <span class="font-bold text-blue-600">BCA</span>
                                            <span class="text-gray-600">1234567890</span>
                                            <span class="text-gray-500">a.n. PT Eco-Loop Indonesia</span>
                                        </div>
                                        <div class="flex items-center gap-3 p-3 bg-white rounded-lg border border-gray-200">
                                            <span class="font-bold text-blue-600">Mandiri</span>
                                            <span class="text-gray-600">1234567891</span>
                                            <span class="text-gray-500">a.n. PT Eco-Loop Indonesia</span>
                                        </div>
                                        <div class="flex items-center gap-3 p-3 bg-white rounded-lg border border-gray-200">
                                            <span class="font-bold text-blue-600">BNI</span>
                                            <span class="text-gray-600">1234567892</span>
                                            <span class="text-gray-500">a.n. PT Eco-Loop Indonesia</span>
                                        </div>
                                        <div class="flex items-center gap-3 p-3 bg-white rounded-lg border border-gray-200">
                                            <span class="font-bold text-blue-600">BRI</span>
                                            <span class="text-gray-600">1234567893</span>
                                            <span class="text-gray-500">a.n. PT Eco-Loop Indonesia</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- QR Code Display -->
                            @if($instructions['type'] === 'qris' && isset($instructions['qr_code']))
                                <div class="text-center mb-4">
                                    <div class="inline-block bg-white p-4 rounded-xl border-2 border-dashed border-gray-300">
                                        <div class="w-48 h-48 mx-auto bg-gray-200 rounded-lg flex items-center justify-center mb-2">
                                            <i class="fas fa-qrcode text-6xl text-gray-400"></i>
                                        </div>
                                        <p class="text-sm text-gray-500">Scan QR Code di atas</p>
                                        <p class="font-mono text-sm text-gray-700 mt-2">Ref: {{ $instructions['qr_code'] }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- COD Info -->
                            @if($instructions['type'] === 'cod')
                                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-4">
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-truck text-amber-600 mt-1"></i>
                                        <div>
                                            <p class="font-semibold text-amber-800">Pembayaran akan dilakukan saat paket diterima</p>
                                            <p class="text-sm text-amber-700 mt-1">
                                                Siapkan uang tunai sebesar <strong>Rp {{ number_format($order->total_amount + 5000, 0, ',', '.') }}</strong> (termasuk biaya COD Rp 5.000)
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Instructions List -->
                            <div class="bg-emerald-50 rounded-xl p-4">
                                <h4 class="font-semibold text-emerald-800 mb-3 flex items-center gap-2">
                                    <i class="fas fa-list-ol text-emerald-600"></i> Langkah Pembayaran:
                                </h4>
                                <ol class="space-y-2">
                                    @foreach($instructions['instructions'] as $index => $instruction)
                                        <li class="flex items-start gap-3">
                                            <span class="w-6 h-6 bg-emerald-500 text-white rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">{{ $index + 1 }}</span>
                                            <span class="text-gray-700">{{ $instruction }}</span>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>

                            <!-- Total to Pay -->
                            <div class="mt-4 p-4 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl text-white text-center">
                                <p class="text-sm text-emerald-100">Total yang harus dibayar:</p>
                                <p class="text-3xl font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                @if(isset($instructions['cod_fee']))
                                    <p class="text-sm text-emerald-200 mt-1">+ Rp 5.000 (Biaya COD)</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Payment Status & Actions -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-up">
                <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-transparent">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-cog text-gray-600"></i> Status & Aksi
                    </h2>
                </div>
                <div class="p-5 space-y-4">
                    <!-- Payment Status -->
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 flex items-center gap-2">
                            <i class="fas fa-hourglass-half text-gray-400"></i> Status Pembayaran
                        </span>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $order->getPaymentStatusBadgeClass() }}">
                            {{ $order->getPaymentStatusLabel() }}
                        </span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-2">
                        @if(!$order->isPaymentPaid() && !$order->isPaymentExpired())
                            <a href="{{ route('orders.show', $order) }}" class="btn-eco-outline flex items-center justify-center gap-2">
                                <i class="fas fa-check"></i> Konfirmasi Sudah Bayar
                            </a>
                        @endif
                        <a href="{{ route('orders.index') }}" class="btn-eco flex items-center justify-center gap-2">
                            <i class="fas fa-list"></i> Lihat Pesanan
                        </a>
                    </div>

                    <p class="text-sm text-gray-500 text-center">
                        <i class="fas fa-info-circle mr-1"></i>
                        Setelah menyelesaikan pembayaran, tunggu konfirmasi dari admin. Voucher akan diberikan setelah pembayaran dikonfirmasi.
                    </p>
                </div>
            </div>

            <!-- Order Items Preview -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-up">
                <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-transparent">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-shopping-bag text-gray-600"></i> Item Pesanan
                    </h2>
                </div>
                <div class="p-5">
                    @forelse($order->items as $item)
                        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                            <div class="flex items-center gap-3">
                                @if($item->product && $item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-box text-emerald-500"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-medium text-gray-900">{{ $item->product->name ?? 'Produk' }}</p>
                                    <p class="text-sm text-gray-500">x{{ $item->quantity }}</p>
                                </div>
                            </div>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Tidak ada item</p>
                    @endforelse
                </div>
            </div>

            <!-- Back Link -->
            <div class="text-center">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-emerald-600 flex items-center justify-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
