<x-eco-loop-layout title="Pesanan">
    @php
        $totalCarbon = $orders->sum(fn($order) => (float) $order->carbon_saved);
        $totalSpent = $orders->sum('total_amount');
        $pendingCount = $orders->where('status', 'pending')->count();
        $completedCount = $orders->where('status', 'completed')->count();
        $cancelledCount = $orders->where('status', 'cancelled')->count();
    @endphp

    <div class="min-h-screen bg-gradient-to-br from-emerald-50/30 via-white to-teal-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
            <!-- Header -->
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm animate-fade-in-up">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center shadow-lg shadow-purple-500/30">
                            <i class="fas fa-shopping-bag text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 flex items-center gap-2">
                                @if(auth()->user()->isSeller())
                                    Pesanan Masuk
                                @else
                                    Pesanan Saya
                                @endif
                            </h1>
                            <p class="text-gray-500 flex items-center gap-2">
                                <i class="fas fa-leaf text-emerald-500"></i>
                                @if(auth()->user()->isSeller())
                                    Kelola pesanan produk hijau Anda
                                @else
                                    Lacak pesanan ramah lingkungan Anda
                                @endif
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 border-2 border-emerald-400 text-emerald-600 hover:bg-emerald-50 hover:border-emerald-500 font-semibold rounded-xl transition-all">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Summary Stats -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 stagger-children">
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm animate-fade-in-up group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform">
                            <i class="fas fa-inbox text-white text-lg"></i>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mb-1">Total Pesanan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $orders->total() }}</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm animate-fade-in-up delay-100 group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform relative">
                            <i class="fas fa-clock text-white text-lg"></i>
                            @if($pendingCount > 0)
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center animate-pulse">{{ $pendingCount }}</span>
                            @endif
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mb-1">Pending</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $pendingCount }}</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm animate-fade-in-up delay-200 group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform">
                            <i class="fas fa-check-circle text-white text-lg"></i>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mb-1">Selesai</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $completedCount }}</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm animate-fade-in-up delay-300 group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center shadow-lg shadow-green-500/30 group-hover:scale-110 transition-transform">
                            <i class="fas fa-wallet text-white text-lg"></i>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mb-1">
                        @if(auth()->user()->isSeller())
                            Total Penjualan
                        @else
                            Total Belanja
                        @endif
                    </p>
                    <p class="text-xl lg:text-2xl font-bold text-gray-800">Rp {{ number_format($totalSpent, 0) }}</p>
                </div>
            </div>

            <!-- Carbon Saved Banner -->
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl p-6 animate-fade-in-up">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <i class="fas fa-leaf text-3xl text-white"></i>
                        </div>
                        <div>
                            <p class="text-emerald-100 text-sm">Dampak Lingkungan Positif</p>
                            <p class="text-3xl font-bold text-white">{{ number_format($totalCarbon, 1) }} <span class="text-lg font-medium text-emerald-100">kg CO2 dihemat</span></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-emerald-200/70 text-sm">Setara dengan menanam</p>
                        <p class="text-xl font-bold text-white">{{ number_format($totalCarbon * 10, 0) }} pohon</p>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-fade-in-up delay-200">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-transparent">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center shadow-lg">
                                <i class="fas fa-list text-white"></i>
                            </div>
                            Daftar Pesanan
                        </h2>
                        <span class="text-gray-500 text-sm">{{ $orders->total() }} pesanan</span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    <i class="fas fa-hashtag mr-1"></i> No. Pesanan
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    <i class="fas fa-calendar mr-1"></i> Tanggal
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    <i class="fas fa-info-circle mr-1"></i> Status
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    <i class="fas fa-money-bill mr-1"></i> Total
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    <i class="fas fa-cloud mr-1"></i> Karbon
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    <i class="fas fa-cog mr-1"></i> Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-50 transition-all">
                                    <td class="px-6 py-5">
                                        <span class="font-mono font-bold text-gray-800 text-lg">{{ $order->order_number }}</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-gray-600 flex items-center gap-2">
                                            <i class="fas fa-calendar-day text-gray-400"></i>
                                            {{ $order->created_at->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        @switch($order->status)
                                            @case('pending')
                                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                                    <i class="fas fa-clock"></i> Pending
                                                </span>
                                                @break
                                            @case('completed')
                                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                                    <i class="fas fa-check-circle"></i> Selesai
                                                </span>
                                                @break
                                            @case('cancelled')
                                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold bg-red-100 text-red-700 border border-red-200">
                                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                                    <i class="fas fa-times-circle"></i> Dibatalkan
                                                </span>
                                                @break
                                            @case('processing')
                                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold bg-blue-100 text-blue-700 border border-blue-200">
                                                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                                                    <i class="fas fa-spinner"></i> Diproses
                                                </span>
                                                @break
                                            @default
                                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="font-bold text-gray-800 text-lg">Rp {{ number_format($order->total_amount, 0) }}</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center gap-1 text-emerald-600 font-semibold bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-200">
                                            <i class="fas fa-leaf text-xs"></i>
                                            {{ $order->carbon_saved ?? 0 }} kg
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col gap-2">
                                            <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white hover:from-purple-600 hover:to-pink-600 font-semibold rounded-lg text-sm transition-all shadow-md hover:shadow-lg">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>

                                            {{-- Seller Actions: Update Status --}}
                                            @if(auth()->user()->isSeller() && in_array($order->status, ['pending', 'processing', 'shipped']))
                                                <button type="button"
                                                        onclick="toggleDropdown('status-dropdown-{{ $order->id }}')"
                                                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/20 transition-all duration-200 hover:from-emerald-600 hover:to-teal-600 hover:shadow-xl">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Update Status</span>
                                                    <i class="fas fa-chevron-down text-[10px] opacity-90"></i>
                                                </button>

                                                {{-- Dropdown Menu --}}
                                                <div id="status-dropdown-{{ $order->id }}"
                                                     class="hidden mt-2 w-full rounded-2xl border border-gray-200 bg-white p-3 shadow-xl shadow-gray-200/60 z-10">
                                                    @if($order->status === 'pending')
                                                        <form action="{{ route('orders.update-status', $order) }}" method="POST" class="rounded-xl border border-blue-100 bg-blue-50 p-2">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="processing">
                                                            <button type="submit" class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-left text-sm font-medium text-blue-700 transition hover:bg-blue-100">
                                                                <i class="fas fa-spinner"></i> Proses Sekarang
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if($order->status === 'processing')
                                                        <form action="{{ route('orders.update-status', $order) }}" method="POST" enctype="multipart/form-data" class="space-y-3 rounded-2xl border border-purple-100 bg-white p-3">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="shipped">

                                                            <div class="flex items-center gap-2 text-sm font-semibold text-purple-700">
                                                                <i class="fas fa-truck"></i>
                                                                <span>Jasa Pengiriman</span>
                                                            </div>

                                                            <div>
                                                                <label class="mb-1 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Nama Kurir</label>
                                                                <select name="shipping_provider" required class="w-full rounded-lg border border-purple-200 bg-white px-3 py-2 text-sm text-gray-700 outline-none transition focus:border-purple-400 focus:ring-2 focus:ring-purple-200">
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
                                                                <label class="mb-1 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Nomor Resi</label>
                                                                <input type="text" name="tracking_number" value="{{ old('tracking_number') }}" required class="w-full rounded-lg border border-purple-200 bg-white px-3 py-2 text-sm text-gray-700 outline-none transition focus:border-purple-400 focus:ring-2 focus:ring-purple-200">
                                                            </div>

                                                            <div>
                                                                <label class="mb-1 block text-[11px] font-semibold uppercase tracking-wide text-gray-600">Bukti Pengiriman</label>
                                                                <input type="file" name="shipping_proof_photo" accept="image/*" required class="w-full rounded-lg border border-dashed border-purple-200 bg-white px-3 py-2 text-sm text-gray-700 file:mr-2 file:rounded file:border-0 file:bg-purple-100 file:px-2 file:py-1 file:text-sm file:font-medium file:text-purple-700">
                                                            </div>

                                                            <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md transition hover:from-purple-600 hover:to-purple-700">
                                                                <i class="fas fa-truck"></i> Kirim Pesanan
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if($order->status === 'shipped')
                                                        <form action="{{ route('orders.update-status', $order) }}" method="POST" class="rounded-xl border border-emerald-100 bg-emerald-50 p-2">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="completed">
                                                            <button type="submit" class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-left text-sm font-medium text-emerald-700 transition hover:bg-emerald-100">
                                                                <i class="fas fa-check-circle"></i> Tandai Selesai
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if(in_array($order->status, ['pending', 'processing']))
                                                        <hr class="my-2 border-gray-100">
                                                        <form action="{{ route('orders.update-status', $order) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');" class="ml-auto mt-2 w-fit rounded-md border border-red-100 bg-red-50 p-1">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <button type="submit" class="inline-flex items-center justify-center gap-1 rounded-sm px-2 py-1 text-[10px] font-medium text-red-700 transition hover:bg-red-100">
                                                                <i class="fas fa-times-circle text-[9px]"></i> Batalkan
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-20 text-center">
                                        <div class="w-24 h-24 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center border-2 border-purple-200">
                                            <i class="fas fa-shopping-bag text-4xl text-purple-400"></i>
                                        </div>
                                        <p class="text-gray-500 text-lg mb-4">Belum ada pesanan</p>
                                        @if(auth()->user()->canBuy())
                                            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white hover:from-emerald-600 hover:to-teal-600 font-bold rounded-xl transition-all shadow-lg shadow-emerald-500/30">
                                                <i class="fas fa-store"></i> Mulai Belanja
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($orders->hasPages())
                    <div class="p-6 border-t border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                            <p class="text-gray-500 text-sm">
                                Menampilkan {{ $orders->firstItem() ?? 0 }} hingga {{ $orders->lastItem() ?? 0 }} dari {{ $orders->total() }} hasil
                            </p>
                            <div class="flex items-center gap-2">
                                @if($orders->onFirstPage())
                                    <span class="px-4 py-2 text-sm text-gray-400 cursor-not-allowed rounded-xl bg-gray-100 border border-gray-200">
                                        <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                    </span>
                                @else
                                    <a href="{{ $orders->previousPageUrl() }}" class="px-4 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-xl font-semibold transition-all border border-emerald-200 hover:border-emerald-300">
                                        <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                    </a>
                                @endif

                                <span class="px-4 py-2 text-sm bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-bold shadow-md">{{ $orders->currentPage() }}</span>

                                @if($orders->hasMorePages())
                                    <a href="{{ $orders->nextPageUrl() }}" class="px-4 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-xl font-semibold transition-all border border-emerald-200 hover:border-emerald-300">
                                        Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                    </a>
                                @else
                                    <span class="px-4 py-2 text-sm text-gray-400 cursor-not-allowed rounded-xl bg-gray-100 border border-gray-200">
                                        Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleDropdown(id) {
            // Close all other dropdowns first
            document.querySelectorAll('[id^="status-dropdown-"]').forEach(el => {
                if (el.id !== id) {
                    el.classList.add('hidden');
                }
            });
            // Toggle the clicked dropdown
            document.getElementById(id).classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('[id^="status-dropdown-"]') && !e.target.closest('button')) {
                document.querySelectorAll('[id^="status-dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        });
    </script>
    @endpush
</x-eco-loop-layout>
