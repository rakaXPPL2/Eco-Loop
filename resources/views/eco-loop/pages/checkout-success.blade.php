<x-eco-loop-layout title="Pesanan Berhasil">
    <div class="max-w-2xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8 py-8">
        <!-- Success Animation & Message -->
        <div class="text-center animate-fade-in-up">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-emerald-100 rounded-full mb-6 transform transition-transform duration-500 hover:scale-110">
                <i class="fas fa-check-circle text-5xl text-emerald-600"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                <i class="fas fa-trophy text-yellow-500 mr-2"></i>Selamat!
            </h1>
            <p class="text-gray-600 text-lg">Pesanan kamu telah berhasil! Terima kasih telah memilih ramah lingkungan!</p>
        </div>

        <!-- Order Details Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-up delay-100">
            <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-emerald-500 to-teal-600 text-white">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <p class="text-emerald-100 text-sm flex items-center gap-1">
                            <i class="fas fa-receipt"></i> Nomor Pesanan
                        </p>
                        <p class="text-2xl font-bold font-mono">{{ $order->order_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-emerald-100 text-sm flex items-center gap-1 justify-end">
                            <i class="fas fa-calendar"></i> Tanggal Pesanan
                        </p>
                        <p class="font-medium">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-4">
                <!-- Carbon Impact -->
                <div class="bg-emerald-50 rounded-2xl p-6 transform transition-all duration-300 hover:scale-[1.02]">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center transform transition-transform duration-300 hover:scale-110">
                            <i class="fas fa-earth-americas text-2xl text-emerald-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-emerald-600 font-semibold flex items-center gap-1">
                                <i class="fas fa-hand-holding-heart"></i> Dampak Lingkungan Kamu
                            </p>
                            <p class="text-3xl font-bold text-emerald-700">{{ $order->total_carbon_saved ?? 0 }} kg CO₂</p>
                            <p class="text-sm text-gray-600">Emisi CO₂ yang berhasil dihemat!</p>
                        </div>
                    </div>
                </div>

                <!-- Voucher Earned -->
                @if($voucherEarned)
                    <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-6">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center transform transition-transform duration-300 hover:scale-110">
                                    <i class="fas fa-gift text-2xl text-amber-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-amber-600 font-semibold flex items-center gap-1">
                                        <i class="fas fa-star text-yellow-500"></i> Voucher Diperoleh!
                                    </p>
                                    <p class="text-lg font-bold text-gray-900 font-mono">{{ $voucherEarned->code }}</p>
                                    <p class="text-sm text-gray-600 flex items-center gap-1">
                                        <i class="fas fa-coins text-gray-400"></i>
                                        {{ $voucherEarned->points ?? 0 }} poin karbon
                                    </p>
                                </div>
                            </div>
                            <button onclick="copyVoucherCode('{{ $voucherEarned->code }}')" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold rounded-xl transition-all duration-300 hover:shadow-lg flex items-center gap-2">
                                <i class="fas fa-copy"></i> Salin Kode
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Order Items Summary -->
                <div class="border-t border-gray-100 pt-5">
                    <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-shopping-bag text-emerald-600"></i> Item Pesanan
                    </h3>
                    @forelse($order->items as $item)
                        <div class="flex justify-between py-3 border-b border-gray-50 last:border-0 transition-colors duration-200 hover:bg-emerald-50/30 -mx-4 px-4">
                            <div class="flex items-center gap-3">
                                @if($item->product && $item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-box text-emerald-500"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-gray-800 font-medium">{{ $item->product->name ?? 'Produk' }}</p>
                                    <p class="text-sm text-gray-500">x{{ $item->quantity }} × Rp {{ number_format($item->price, 0) }}</p>
                                </div>
                            </div>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0) }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Tidak ada item</p>
                    @endforelse

                    <div class="flex justify-between py-4 border-t border-gray-200 mt-4">
                        <span class="font-bold text-gray-900 flex items-center gap-2">
                            <i class="fas fa-wallet text-gray-600"></i> Total
                        </span>
                        <span class="font-bold text-2xl text-emerald-600">Rp {{ number_format($order->total_amount, 0) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- What's Next -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-up delay-200">
            <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-clipboard-list text-emerald-600"></i> Apa Selanjutnya?
                </h2>
            </div>
            <div class="p-5 space-y-4">
                <div class="flex items-start gap-4 p-4 rounded-xl transition-all duration-300 hover:bg-blue-50">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 transform transition-transform duration-300 hover:scale-110">
                        <span class="text-blue-600 font-bold">1</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 flex items-center gap-2">
                            <i class="fas fa-envelope text-blue-500"></i> Konfirmasi Pesanan
                        </p>
                        <p class="text-sm text-gray-600">Pesanan Anda sedang diproses oleh penjual</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-4 rounded-xl transition-all duration-300 hover:bg-purple-50">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 transform transition-transform duration-300 hover:scale-110">
                        <span class="text-purple-600 font-bold">2</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 flex items-center gap-2">
                            <i class="fas fa-cog text-purple-500"></i> Pengiriman
                        </p>
                        <p class="text-sm text-gray-600">Seller akan mengirim barang ramah lingkungan kamu</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-4 rounded-xl transition-all duration-300 hover:bg-emerald-50">
                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0 transform transition-transform duration-300 hover:scale-110">
                        <span class="text-emerald-600 font-bold">3</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 flex items-center gap-2">
                            <i class="fas fa-check-circle text-emerald-500"></i> Pesanan Selesai
                        </p>
                        <p class="text-sm text-gray-600">Terima barang dan berikan review untuk seller</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up delay-300">
            <a href="{{ route('orders.index') }}" class="btn-eco-outline flex-1 flex items-center justify-center gap-2">
                <i class="fas fa-list"></i> Lihat Pesanan Saya
            </a>
            <a href="{{ route('products.index') }}" class="btn-eco flex-1 flex items-center justify-center gap-2">
                <i class="fas fa-store"></i> Lanjut Belanja
            </a>
        </div>

        <!-- Share Impact -->
        <div class="text-center animate-fade-in-up delay-400">
            <p class="text-sm text-gray-600 mb-4 flex items-center justify-center gap-2">
                <i class="fas fa-share-alt text-gray-500"></i> Bagikan dampak ramah lingkungan kamu!
            </p>
            <div class="flex justify-center gap-3">
                <button onclick="shareToWhatsApp()" class="w-12 h-12 bg-green-500 hover:bg-green-600 text-white rounded-xl transition-all duration-300 hover:shadow-lg hover:-translate-y-1 flex items-center justify-center" title="Share via WhatsApp">
                    <i class="fab fa-whatsapp text-lg"></i>
                </button>
                <button onclick="shareToTwitter()" class="w-12 h-12 bg-sky-500 hover:bg-sky-600 text-white rounded-xl transition-all duration-300 hover:shadow-lg hover:-translate-y-1 flex items-center justify-center" title="Share via Twitter">
                    <i class="fab fa-twitter text-lg"></i>
                </button>
                <button onclick="copyProductLink()" class="w-12 h-12 bg-gray-500 hover:bg-gray-600 text-white rounded-xl transition-all duration-300 hover:shadow-lg hover:-translate-y-1 flex items-center justify-center" title="Copy Link">
                    <i class="fas fa-link text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function copyVoucherCode(code) {
            navigator.clipboard.writeText(code).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: '<i class="fas fa-check-circle text-emerald-500 mr-2"></i>Kode Disalin!',
                    html: 'Kode voucher berhasil disalin!',
                    showConfirmButton: false,
                    timer: 2000,
                    position: 'top-end',
                    toast: true
                });
            });
        }

        function copyProductLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: '<i class="fas fa-check-circle text-emerald-500 mr-2"></i>Link Disalin!',
                    html: 'Link berhasil disalin ke clipboard!',
                    showConfirmButton: false,
                    timer: 2000,
                    position: 'top-end',
                    toast: true
                });
            });
        }

        function shareToWhatsApp() {
            const text = `Saya baru saja memesan produk ramah lingkungan di Eco-Loop dan menghemat {{ $order->total_carbon_saved ?? 0 }} kg CO₂! 🌿 Yuk join juga di Eco-Loop!`;
            window.open(`https://wa.me/?text=${encodeURIComponent(text)}`, '_blank');
        }

        function shareToTwitter() {
            const text = `Saya baru saja memesan produk ramah lingkungan dan menghemat {{ $order->total_carbon_saved ?? 0 }} kg CO₂! 🌿 #EcoLoop #GoGreen`;
            window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}`, '_blank');
        }
    </script>
    @endpush
</x-eco-loop-layout>
