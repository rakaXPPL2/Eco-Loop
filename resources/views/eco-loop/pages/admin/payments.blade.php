<x-eco-loop-layout title="Kelola Pembayaran - Admin">
    <div class="flex min-h-screen">
        <!-- Admin Sidebar -->
        <x-admin-sidebar />

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Admin Header -->
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-emerald-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4 animate-fade-in-up">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center shadow-lg shadow-yellow-200">
                                <i class="fas fa-credit-card text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">Kelola Pembayaran</h1>
                                <p class="text-emerald-600">Konfirmasi pembayaran dari pembeli</p>
                            </div>
                        </div>
                        <div class="glass-card-light px-4 py-2 animate-fade-in-up hidden md:block">
                            <span class="text-emerald-700 text-sm">
                                <i class="fas fa-receipt mr-2"></i>{{ $payments->total() }} Total Pembayaran
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 stagger-children">
                    <div class="glass-card-light p-4 animate-fade-in-up">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">{{ $paymentStats['pending'] ?? 0 }}</p>
                                <p class="text-gray-500 text-xs">Menunggu</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card-light p-4 animate-fade-in-up" style="animation-delay: 100ms;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-check-circle text-emerald-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">{{ $paymentStats['paid_today'] ?? 0 }}</p>
                                <p class="text-gray-500 text-xs">Lunas Hari Ini</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card-light p-4 animate-fade-in-up" style="animation-delay: 200ms;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-coins text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">Rp {{ number_format($paymentStats['total_pending_amount'] ?? 0, 0, ',', '.') }}</p>
                                <p class="text-gray-500 text-xs">Total Tertunda</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card-light p-4 animate-fade-in-up" style="animation-delay: 300ms;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-trending-up text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">{{ $payments->where('payment_method', 'bank_transfer')->count() }}</p>
                                <p class="text-gray-500 text-xs">Transfer Bank</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search and Filter Bar -->
                <div class="glass-card-light p-4 mb-6 animate-fade-in-up" style="animation-delay: 400ms;">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" placeholder="Cari pesanan atau payment ref..." class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all">
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <select class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:border-emerald-500 transition-all">
                                <option value="">Semua Metode</option>
                                <option value="bank_transfer">Transfer Bank</option>
                                <option value="e_wallet">E-Wallet</option>
                                <option value="qris">QRIS</option>
                                <option value="cod">COD</option>
                            </select>
                            <select class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:border-emerald-500 transition-all">
                                <option value="">Semua Status</option>
                                <option value="pending">Menunggu</option>
                                <option value="expired">Kedaluwarsa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Payments Table -->
                <div class="glass-card-light overflow-hidden animate-fade-in-up" style="animation-delay: 500ms;">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="glass-table-header-light">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-hashtag"></i> Order
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-user"></i> Pembeli
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-coins"></i> Jumlah
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-wallet"></i> Metode
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-toggle-on"></i> Status
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-clock"></i> Kadaluarsa
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-cog"></i> Aksi
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($payments as $order)
                                    <tr class="hover:bg-emerald-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <span class="font-mono text-emerald-600 font-bold block">{{ $order->order_number }}</span>
                                            @if($order->payment_ref)
                                                <span class="text-xs text-gray-400">Ref: {{ $order->payment_ref }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center">
                                                    <span class="text-white text-xs font-bold">{{ substr($order->user->name, 0, 1) }}</span>
                                                </div>
                                                <span class="text-gray-800">{{ $order->user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-gray-800 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                            <span class="block text-xs text-emerald-600">
                                                <i class="fas fa-leaf mr-1"></i>{{ $order->total_carbon_saved }} kg CO₂
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $methodLabels = [
                                                    'bank_transfer' => ['label' => 'Transfer Bank', 'icon' => 'fa-university', 'color' => 'blue'],
                                                    'e_wallet' => ['label' => 'E-Wallet', 'icon' => 'fa-mobile-alt', 'color' => 'purple'],
                                                    'qris' => ['label' => 'QRIS', 'icon' => 'fa-qrcode', 'color' => 'teal'],
                                                    'cod' => ['label' => 'COD', 'icon' => 'fa-money-bill', 'color' => 'green'],
                                                ];
                                                $method = $methodLabels[$order->payment_method] ?? ['label' => $order->payment_method, 'icon' => 'fa-credit-card', 'color' => 'gray'];
                                            @endphp
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold
                                                @if($method['color'] === 'blue') bg-blue-100 text-blue-700
                                                @elseif($method['color'] === 'purple') bg-purple-100 text-purple-700
                                                @elseif($method['color'] === 'teal') bg-teal-100 text-teal-700
                                                @else bg-emerald-100 text-emerald-700
                                                @endif">
                                                <i class="fas {{ $method['icon'] }}"></i>
                                                {{ $method['label'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($order->payment_status === 'pending')
                                                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                                    <i class="fas fa-clock"></i> Menunggu
                                                </span>
                                            @elseif($order->payment_status === 'paid')
                                                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                                    <i class="fas fa-check-circle"></i> Lunas
                                                </span>
                                            @elseif($order->payment_status === 'failed')
                                                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                                    <i class="fas fa-times-circle"></i> Gagal
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($order->payment_expires_at)
                                                <span class="text-gray-600 text-sm {{ $order->isPaymentExpired() ? 'text-red-600 font-semibold' : '' }}">
                                                    {{ $order->payment_expires_at->format('d/m H:i') }}
                                                </span>
                                                @if($order->isPaymentExpired())
                                                    <span class="block text-xs text-red-500">
                                                        <i class="fas fa-exclamation-circle mr-1"></i>Kedaluwarsa
                                                    </span>
                                                @endif
                                            @else
                                                <span class="text-gray-400 text-sm">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($order->payment_status === 'pending' && $order->payment_method !== 'cod')
                                                <div class="flex gap-2">
                                                    <form action="{{ route('admin.payments.confirm', $order) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg text-xs font-semibold transition-colors flex items-center gap-1">
                                                            <i class="fas fa-check"></i> Konfirmasi
                                                        </button>
                                                    </form>
                                                    <button onclick="showRejectModal('{{ $order->order_number }}', {{ $order->id }})" class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs font-semibold transition-colors flex items-center gap-1">
                                                        <i class="fas fa-times"></i> Tolak
                                                    </button>
                                                </div>
                                            @elseif($order->payment_method === 'cod')
                                                <span class="text-gray-400 text-xs">
                                                    <i class="fas fa-info-circle mr-1"></i>COD - Otomatis
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-xs">
                                                    <i class="fas fa-check-circle mr-1"></i>Selesai
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-emerald-50 flex items-center justify-center">
                                                <i class="fas fa-check-circle text-3xl text-emerald-400"></i>
                                            </div>
                                            <p class="text-gray-500">Semua pembayaran sudah dikonfirmasi!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="p-4 border-t border-gray-100 bg-gray-50">
                        <div class="flex justify-center">
                            {{ $payments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Payment Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4 shadow-2xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Tolak Pembayaran</h3>
                <button onclick="closeRejectModal()" class="w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors">
                    <i class="fas fa-times text-gray-600"></i>
                </button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <input type="hidden" name="reason" id="rejectReason">
                <p class="text-gray-600 mb-4">Pesanan: <span id="rejectOrderNumber" class="font-mono font-bold text-emerald-600"></span></p>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alasan Penolakan</label>
                    <textarea id="rejectReasonInput" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-gray-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all" placeholder="Contoh: Transfer tidak sesuai nominal, bukti tidak valid, dll..." required></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="closeRejectModal()" class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-semibold transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold transition-colors">
                        <i class="fas fa-times mr-2"></i>Tolak Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function showRejectModal(orderNumber, orderId) {
            document.getElementById('rejectOrderNumber').textContent = orderNumber;
            document.getElementById('rejectForm').action = '/admin/payments/' + orderId + '/reject';
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectModal').classList.add('flex');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectModal').classList.remove('flex');
            document.getElementById('rejectReasonInput').value = '';
        }

        document.getElementById('rejectForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('rejectReason').value = document.getElementById('rejectReasonInput').value;
            this.submit();
        });

        // Close modal on outside click
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });
    </script>
    @endpush
</x-eco-loop-layout>
