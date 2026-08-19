<x-eco-loop-layout title="My Vouchers">
    <div class="space-y-6 px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 animate-fade-in-up">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                    <i class="fas fa-ticket-alt text-emerald-500"></i> Voucher Saya
                </h1>
                <p class="text-gray-600 dark:text-gray-400 flex items-center gap-2 mt-1">
                    <i class="fas fa-gift text-emerald-400"></i> Tukarkan eco-points untuk reward eksklusif
                </p>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 border-2 border-emerald-500 text-emerald-600 hover:bg-emerald-500 hover:text-white font-semibold rounded-xl transition-all duration-300 hover:shadow-lg">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        {{-- Summary Stats --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-5 text-white shadow-xl transform transition-all duration-500 hover:scale-[1.02] cursor-default">
                <p class="text-sm text-emerald-100 mb-1 flex items-center gap-2">
                    <i class="fas fa-leaf"></i> Total Karbon Dihemat
                </p>
                <p class="text-3xl font-bold">{{ $totalCarbonSaved ?? 0 }} kg</p>
                <div class="mt-3 flex items-center gap-2">
                    <i class="fas fa-rocket text-emerald-200"></i>
                    <span class="text-sm text-emerald-100">Terus semangat!</span>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-md border border-gray-100 dark:border-gray-700 transform transition-all duration-500 hover:-translate-y-1 hover:shadow-xl cursor-default">
                <p class="text-sm text-gray-600 mb-1 flex items-center gap-2">
                    <i class="fas fa-ticket-alt text-gray-600"></i> Voucher Aktif
                </p>
                <p class="text-3xl font-bold text-emerald-600">{{ $activeVouchers->count() }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-md border border-gray-100 dark:border-gray-700 transform transition-all duration-500 hover:-translate-y-1 hover:shadow-xl cursor-default">
                <p class="text-sm text-gray-600 mb-1 flex items-center gap-2">
                    <i class="fas fa-coins text-gray-600"></i> Total Poin Diperoleh
                </p>
                <p class="text-3xl font-bold text-teal-600">{{ $totalPoints ?? 0 }}</p>
            </div>
        </div>

        {{-- Active Vouchers --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden animate-fade-in-up delay-100">
            <div class="p-5 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-white dark:from-gray-700 dark:to-gray-800">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fas fa-star text-emerald-500"></i> Voucher Aktif
                </h2>
            </div>
            <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($activeVouchers as $voucher)
                    <div class="border-2 border-emerald-200 dark:border-emerald-800 rounded-2xl p-6 bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 transform transition-all duration-500 hover:-translate-y-2 hover:shadow-xl">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-xs font-medium text-emerald-600 uppercase tracking-wide flex items-center gap-1">
                                    <i class="fas fa-ticket-alt"></i> Voucher
                                </span>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-1 font-mono">{{ $voucher->code }}</h3>
                            </div>
                            <span class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-xs font-bold rounded-full shadow-lg">
                                <i class="fas fa-percent mr-1"></i>
                                @if($voucher->discount_type === 'percentage')
                                    {{ $voucher->value }}% OFF
                                @else
                                    Rp {{ number_format($voucher->value, 0) }} OFF
                                @endif
                            </span>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 flex items-center gap-1">
                                    <i class="fas fa-coins text-gray-400"></i> Poin Dibutuhkan:
                                </span>
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $voucher->points_required }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 flex items-center gap-1">
                                    <i class="fas fa-calendar text-gray-400"></i> Kadaluarsa:
                                </span>
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $voucher->expires_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 flex items-center gap-1">
                                    <i class="fas fa-leaf text-gray-400"></i> Karbon Dihemat:
                                </span>
                                <span class="font-semibold text-emerald-600">{{ $voucher->carbon_amount ?? 0 }} kg</span>
                            </div>
                        </div>
                        <button onclick="copyVoucherCode('{{ $voucher->code }}')" class="w-full py-3 px-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-sm font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                            <i class="fas fa-copy"></i> Salin Kode
                        </button>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-12">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-ticket-alt text-3xl text-gray-300 dark:text-gray-500"></i>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Belum ada voucher aktif</p>
                        <a href="{{ route('eco-shop') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-500 text-white hover:bg-emerald-600 font-semibold rounded-xl transition-all duration-300 hover:shadow-lg">
                            <i class="fas fa-store"></i> Belanja untuk Mendapatkan Voucher <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Expired / Redeemed Vouchers --}}
        @if($expiredVouchers->isNotEmpty() || $redeemedVouchers->isNotEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden animate-fade-in-up delay-200">
                <div class="p-5 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-white dark:from-gray-700 dark:to-gray-800">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fas fa-history text-gray-600"></i> Kadaluarsa / Digunakan
                    </h2>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($expiredVouchers as $voucher)
                        <div class="p-4 flex items-center justify-between opacity-60 transition-opacity duration-300 hover:opacity-80">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-clock text-gray-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $voucher->code }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-1">
                                        <i class="fas fa-calendar-times text-gray-400"></i> Kadaluarsa pada {{ $voucher->expires_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-500 text-xs font-semibold rounded-full">
                                <i class="fas fa-times-circle mr-1"></i> Kadaluarsa
                            </span>
                        </div>
                    @endforeach
                    @foreach($redeemedVouchers as $voucher)
                        <div class="p-4 flex items-center justify-between opacity-60 transition-opacity duration-300 hover:opacity-80">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-check-circle text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $voucher->code }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-1">
                                        <i class="fas fa-calendar-check text-gray-400"></i> Digunakan pada {{ $voucher->redeemed_at ? $voucher->redeemed_at->format('d M Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-semibold rounded-full">
                                <i class="fas fa-check mr-1"></i> Digunakan
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        async function copyVoucherCode(code) {
            try {
                await navigator.clipboard.writeText(code);
                Swal.fire({
                    icon: 'success',
                    title: '<i class="fas fa-check-circle text-emerald-500 mr-2"></i>Disalin!',
                    html: 'Kode voucher berhasil disalin!',
                    showConfirmButton: false,
                    timer: 2000,
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl'
                    }
                });
            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: '<i class="fas fa-times-circle text-red-500 mr-2"></i>Gagal',
                    html: 'Gagal menyalin kode',
                    showConfirmButton: false,
                    timer: 2000,
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl'
                    }
                });
            }
        }
    </script>
    @endpush
</x-eco-loop-layout>
