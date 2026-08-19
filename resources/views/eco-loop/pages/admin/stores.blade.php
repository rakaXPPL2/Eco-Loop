<x-eco-loop-layout title="Toko - Admin">
    <div class="flex min-h-screen">
        <!-- Admin Sidebar -->
        <x-admin-sidebar :stats="[
            'pending_stores' => $stores->where('is_verified', false)->count(),
            'pending_complaints' => 0
        ]" />

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-emerald-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-cyan-500 flex items-center justify-center shadow-lg shadow-blue-200">
                                <i class="fas fa-store text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">Verifikasi Toko</h1>
                                <p class="text-emerald-600">Verifikasi toko penjual</p>
                            </div>
                        </div>
                        <div class="glass-card-light px-4 py-2 hidden md:block">
                            <span class="text-emerald-700 text-sm">
                                <i class="fas fa-store mr-2"></i>{{ $stores->total() }} Toko
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6 stagger-children">
                    <div class="glass-card-light p-4 animate-fade-in-up">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                                <i class="fas fa-clock text-amber-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">{{ $stores->where('is_verified', false)->count() }}</p>
                                <p class="text-gray-500 text-xs">Pending Verifikasi</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card-light p-4 animate-fade-in-up" style="animation-delay: 100ms;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-check-circle text-emerald-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">{{ $stores->where('is_verified', true)->count() }}</p>
                                <p class="text-gray-500 text-xs">Ter-Verifikasi</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card-light p-4 animate-fade-in-up" style="animation-delay: 200ms;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-box text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">{{ $stores->sum('user.products_count') ?? 0 }}</p>
                                <p class="text-gray-500 text-xs">Total Produk</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stores Table -->
                <div class="glass-card-light overflow-hidden animate-fade-in-up" style="animation-delay: 300ms;">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="glass-table-header-light">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-store"></i> Toko
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-user"></i> Pemilik
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-map-marker-alt"></i> Region
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2 justify-center">
                                            <i class="fas fa-box"></i> Produk
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2 justify-center">
                                            <i class="fas fa-toggle-on"></i> Status
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2 justify-center">
                                            <i class="fas fa-cog"></i> Aksi
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($stores as $store)
                                    <tr class="hover:bg-emerald-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-cyan-100 flex items-center justify-center">
                                                    <i class="fas fa-store text-blue-600"></i>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-800">{{ $store->name }}</div>
                                                    <div class="text-xs text-gray-400">{{ $store->user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center">
                                                    <span class="text-white text-xs font-bold">{{ substr($store->user->name, 0, 1) }}</span>
                                                </div>
                                                {{ $store->user->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">
                                            @if($store->region)
                                                <span class="inline-flex items-center gap-1">
                                                    <i class="fas fa-map-pin text-teal-500"></i>
                                                    {{ $store->region->name }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">
                                                {{ $store->user->products_count ?? 0 }} produk
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($store->is_verified)
                                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">
                                                    <i class="fas fa-check-circle"></i> Verified
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full">
                                                    <i class="fas fa-clock"></i> Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <form action="{{ route('admin.stores.verify', $store) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-4 py-2 text-sm font-semibold rounded-xl transition-all
                                                    @if($store->is_verified)
                                                        bg-red-100 text-red-600 hover:bg-red-200 border border-red-200
                                                    @else
                                                        bg-emerald-100 text-emerald-700 hover:bg-emerald-200 border border-emerald-200
                                                    @endif">
                                                    <i class="fas @if($store->is_verified)fa-times-circle mr-1 @else fa-check-circle mr-1 @endif"></i>
                                                    {{ $store->is_verified ? 'Batalkan' : 'Verifikasi' }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-blue-50 flex items-center justify-center">
                                                <i class="fas fa-store-slash text-3xl text-blue-400"></i>
                                            </div>
                                            <p class="text-gray-500">Belum ada toko</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($stores->hasPages())
                        <div class="p-4 border-t border-gray-100 bg-gray-50">
                            <div class="flex justify-center">
                                {{ $stores->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
