<x-eco-loop-layout title="Region - Admin">
    <div class="flex min-h-screen">
        <!-- Admin Sidebar -->
        <x-admin-sidebar :stats="[
            'pending_stores' => 0,
            'pending_complaints' => 0
        ]" />

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-emerald-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center shadow-lg shadow-teal-200">
                                <i class="fas fa-map-marked-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">Region</h1>
                                <p class="text-emerald-600">Kelola region untuk penjual dan pembeli</p>
                            </div>
                        </div>
                        <button onclick="document.getElementById('addRegion').classList.toggle('hidden')" class="px-4 py-2 bg-emerald-500 text-white rounded-xl font-semibold text-sm hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-200">
                            <i class="fas fa-plus mr-2"></i>Tambah Region
                        </button>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Add Region Form -->
                <div id="addRegion" class="hidden mb-6 glass-card-light p-6 animate-fade-in-up">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-plus-circle text-teal-500"></i>
                        Tambah Region Baru
                    </h3>
                    <form action="{{ route('admin.regions.store') }}" method="POST" class="grid md:grid-cols-2 gap-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Region <span class="text-red-500">*</span></label>
                            <input type="text" name="name" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Provinsi <span class="text-red-500">*</span></label>
                            <input type="text" name="province" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kota/Kabupaten <span class="text-red-500">*</span></label>
                            <input type="text" name="city" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kecamatan <span class="text-red-500">*</span></label>
                            <input type="text" name="district" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Pos</label>
                            <input type="text" name="postal_code" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all">
                        </div>
                        <div class="md:col-span-2 flex items-end gap-4">
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-teal-500 to-emerald-500 text-white font-semibold rounded-xl hover:from-teal-600 hover:to-emerald-600 transition-all shadow-lg shadow-teal-200 hover:shadow-teal-300">
                                <i class="fas fa-save mr-2"></i>Simpan
                            </button>
                            <button type="button" onclick="document.getElementById('addRegion').classList.toggle('hidden')" class="px-4 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6 stagger-children">
                    <div class="glass-card-light p-4 animate-fade-in-up">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-teal-100 flex items-center justify-center">
                                <i class="fas fa-map text-teal-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">{{ $regions->total() }}</p>
                                <p class="text-gray-500 text-xs">Total Region</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card-light p-4 animate-fade-in-up" style="animation-delay: 100ms;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-store text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">{{ $regions->sum('stores_count') ?? 0 }}</p>
                                <p class="text-gray-500 text-xs">Toko</p>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card-light p-4 animate-fade-in-up" style="animation-delay: 200ms;">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-users text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-bold">{{ $regions->sum('users_count') ?? 0 }}</p>
                                <p class="text-gray-500 text-xs">Pengguna</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Regions Table -->
                <div class="glass-card-light overflow-hidden animate-fade-in-up" style="animation-delay: 300ms;">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="glass-table-header-light">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-map-pin"></i> Region
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-city"></i> Kota/Kab
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-map"></i> Provinsi
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2 justify-center">
                                            <i class="fas fa-store"></i> Toko
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2 justify-center">
                                            <i class="fas fa-users"></i> Pengguna
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($regions as $region)
                                    <tr class="hover:bg-emerald-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-100 to-emerald-100 flex items-center justify-center">
                                                    <i class="fas fa-map-pin text-teal-600"></i>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-800">{{ $region->name }}</div>
                                                    <div class="text-xs text-gray-400">{{ $region->district }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">{{ $region->city }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $region->province }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">{{ $region->stores_count ?? 0 }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">{{ $region->users_count ?? 0 }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-teal-50 flex items-center justify-center">
                                                <i class="fas fa-map text-3xl text-teal-400"></i>
                                            </div>
                                            <p class="text-gray-500 mb-4">Belum ada region</p>
                                            <a href="#" onclick="document.getElementById('addRegion').classList.remove('hidden'); return false;" class="text-teal-600 hover:text-teal-700 font-semibold">
                                                <i class="fas fa-plus mr-1"></i>Tambah region
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($regions->hasPages())
                        <div class="p-4 border-t border-gray-100 bg-gray-50">
                            <div class="flex justify-center">
                                {{ $regions->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
