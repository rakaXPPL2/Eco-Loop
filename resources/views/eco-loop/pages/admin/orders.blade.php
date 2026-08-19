<x-eco-loop-layout title="Kelola Pesanan - Admin">
    <div class="flex min-h-screen">
        <!-- Admin Sidebar -->
        <x-admin-sidebar :stats="[
            'pending_stores' => 0,
            'pending_complaints' => 0
        ]" />

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Admin Header -->
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-emerald-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4 animate-fade-in-up">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center shadow-lg shadow-purple-200">
                                <i class="fas fa-shopping-bag text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">Kelola Pesanan</h1>
                                <p class="text-emerald-600">Pantau semua transaksi di platform</p>
                            </div>
                        </div>
                        <div class="glass-card-light px-4 py-2 animate-fade-in-up hidden md:block">
                            <span class="text-emerald-700 text-sm">
                                <i class="fas fa-receipt mr-2"></i>{{ $orders->total() }} Total Pesanan
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
                            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                                <i class="fas fa-clock text-amber-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">{{ $orders->where('status', 'pending')->count() }}</p>
                                <p class="text-gray-500 text-xs">Pending</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card-light p-4 animate-fade-in-up" style="animation-delay: 100ms;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-spinner text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">{{ $orders->where('status', 'processing')->count() }}</p>
                                <p class="text-gray-500 text-xs">Processing</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card-light p-4 animate-fade-in-up" style="animation-delay: 200ms;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-truck text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">{{ $orders->where('status', 'shipped')->count() }}</p>
                                <p class="text-gray-500 text-xs">Shipped</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card-light p-4 animate-fade-in-up" style="animation-delay: 300ms;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-check-circle text-emerald-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">{{ $orders->where('status', 'completed')->count() }}</p>
                                <p class="text-gray-500 text-xs">Completed</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search and Filter Bar -->
                <div class="glass-card-light p-4 mb-6 animate-fade-in-up" style="animation-delay: 400ms;">
                    <form action="{{ route('admin.orders') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pesanan..." class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all">
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <select name="status" class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:border-emerald-500 transition-all">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <input type="date" name="date" value="{{ request('date') }}" class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:border-emerald-500 transition-all">
                            <button type="submit" class="btn-eco px-6 py-3">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Orders Table -->
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
                                            <i class="fas fa-user"></i> Pengguna
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-coins"></i> Total
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-leaf"></i> Karbon
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-toggle-on"></i> Status
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-calendar"></i> Tanggal
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($orders as $order)
                                    <tr class="hover:bg-emerald-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <span class="font-mono text-emerald-600 font-bold">{{ $order->order_number }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center">
                                                    <span class="text-white text-xs font-bold">{{ substr($order->user->name, 0, 1) }}</span>
                                                </div>
                                                <span class="text-gray-800">{{ $order->user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-800 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold">
                                                <i class="fas fa-leaf mr-1"></i>{{ number_format($order->total_carbon_saved, 2) }} kg
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'status-pending',
                                                    'processing' => 'status-reviewing',
                                                    'shipped' => 'bg-purple-100 text-purple-700',
                                                    'completed' => 'status-completed',
                                                    'cancelled' => 'status-cancelled',
                                                ];
                                                $statusIcons = [
                                                    'pending' => 'fa-clock',
                                                    'processing' => 'fa-spinner',
                                                    'shipped' => 'fa-truck',
                                                    'completed' => 'fa-check-circle',
                                                    'cancelled' => 'fa-times-circle',
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$order->status] ?? '' }}">
                                                <i class="fas {{ $statusIcons[$order->status] ?? 'fa-circle' }}"></i>
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 text-sm">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-purple-50 flex items-center justify-center">
                                                <i class="fas fa-shopping-bag text-3xl text-purple-400"></i>
                                            </div>
                                            <p class="text-gray-500">Belum ada pesanan</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="p-4 border-t border-gray-100 bg-gray-50">
                        <div class="flex justify-center">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
