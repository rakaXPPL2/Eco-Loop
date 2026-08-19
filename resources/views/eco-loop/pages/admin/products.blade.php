<x-eco-loop-layout title="Kelola Produk - Admin">
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
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-200">
                                <i class="fas fa-box-open text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">Kelola Produk</h1>
                                <p class="text-emerald-600">Monitor semua produk di platform</p>
                            </div>
                        </div>
                        <div class="glass-card-light px-4 py-2 animate-fade-in-up hidden md:block">
                            <span class="text-emerald-700 text-sm">
                                <i class="fas fa-box mr-2"></i>{{ $products->total() }} Total Produk
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Search and Filter Bar -->
                <div class="glass-card-light p-4 mb-6 animate-fade-in-up">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" placeholder="Cari produk..." class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all">
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <select class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:border-emerald-500 transition-all">
                                <option value="">Semua Status</option>
                                <option value="available">Available</option>
                                <option value="sold">Sold</option>
                                <option value="reserved">Reserved</option>
                            </select>
                            <form method="GET" action="{{ route('admin.products') }}" class="flex gap-2">
                                <select name="filter" class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:border-emerald-500 transition-all">
                                    <option value="">Semua Approval</option>
                                    <option value="pending" {{ request('filter') === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ request('filter') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                                </select>
                                <button type="submit" class="px-4 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition-all">
                                    <i class="fas fa-filter"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="glass-card-light overflow-hidden animate-fade-in-up" style="animation-delay: 100ms;">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="glass-table-header-light">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-box"></i> Produk
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-tag"></i> Kategori
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-store"></i> Penjual
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-tag"></i> Harga
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
                                            <i class="fas fa-shield-alt"></i> Approval
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-cogs"></i> Aksi
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($products as $product)
                                    <tr class="hover:bg-emerald-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-100 to-orange-100 flex items-center justify-center">
                                                    <i class="fas fa-box text-amber-600"></i>
                                                </div>
                                                <span class="font-semibold text-gray-800">{{ $product->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-teal-100 text-teal-700 rounded-full text-xs font-semibold">
                                                <i class="fas fa-tag"></i>
                                                {{ $product->category->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 text-sm">{{ $product->user->name }}</td>
                                        <td class="px-6 py-4 text-gray-800 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold">
                                                <i class="fas fa-leaf mr-1"></i>{{ number_format($product->carbon_saved, 2) }} kg
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $statusClasses = [
                                                    'available' => 'bg-emerald-100 text-emerald-700',
                                                    'sold' => 'bg-gray-100 text-gray-600',
                                                    'reserved' => 'bg-amber-100 text-amber-700',
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$product->status] ?? 'bg-gray-100 text-gray-600' }}">
                                                @if($product->status === 'available')
                                                    <i class="fas fa-check-circle"></i>
                                                @elseif($product->status === 'sold')
                                                    <i class="fas fa-times-circle"></i>
                                                @else
                                                    <i class="fas fa-clock"></i>
                                                @endif
                                                {{ ucfirst($product->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($product->is_active)
                                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                                                    <i class="fas fa-check-circle"></i>
                                                    Disetujui
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-semibold">
                                                    <i class="fas fa-clock"></i>
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if(!$product->is_active)
                                                <form action="{{ route('admin.products.approve', $product) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg text-xs font-semibold transition-colors">
                                                        <i class="fas fa-check"></i>
                                                        Setujui
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.products.reject', $product) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs font-semibold transition-colors">
                                                        <i class="fas fa-times"></i>
                                                        Tolak
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center">
                                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-amber-50 flex items-center justify-center">
                                                <i class="fas fa-box-open text-3xl text-amber-400"></i>
                                            </div>
                                            <p class="text-gray-500">Belum ada produk</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="p-4 border-t border-gray-100 bg-gray-50">
                        <div class="flex justify-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
