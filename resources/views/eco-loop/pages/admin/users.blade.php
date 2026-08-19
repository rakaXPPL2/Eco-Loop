<x-eco-loop-layout title="Kelola Pengguna - Admin">
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
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-400 to-rose-500 flex items-center justify-center shadow-lg shadow-pink-200">
                                <i class="fas fa-users text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">Kelola Pengguna</h1>
                                <p class="text-emerald-600">Monitor dan kelola semua pengguna platform</p>
                            </div>
                        </div>
                        <div class="glass-card-light px-4 py-2 animate-fade-in-up hidden md:block">
                            <span class="text-emerald-700 text-sm">
                                <i class="fas fa-users mr-2"></i>{{ $users->total() }} Total Pengguna
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Search and Filter Bar -->
                <div class="glass-card-light p-4 mb-6 animate-fade-in-up">
                    <form action="{{ route('admin.users') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengguna..." class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all">
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <select name="role" class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:border-emerald-500 transition-all">
                                <option value="">Semua Role</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="seller" {{ request('role') == 'seller' ? 'selected' : '' }}>Seller</option>
                            </select>
                            <select name="region" class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:border-emerald-500 transition-all">
                                <option value="">Semua Region</option>
                            </select>
                            <button type="submit" class="btn-eco px-6 py-3">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Users Table -->
                <div class="glass-card-light overflow-hidden animate-fade-in-up" style="animation-delay: 100ms;">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="glass-table-header-light">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-user"></i> Pengguna
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-envelope"></i> Email
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-map-marker-alt"></i> Region
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-leaf"></i> Karbon
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-shopping-bag"></i> Pesanan
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-id-badge"></i> Role
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
                                @forelse($users as $user)
                                    <tr class="hover:bg-emerald-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-200">
                                                    <span class="text-white font-bold">{{ substr($user->name, 0, 1) }}</span>
                                                </div>
                                                <span class="font-semibold text-gray-800">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 text-sm">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-gray-600 text-sm">
                                            @if($user->region)
                                                <span class="inline-flex items-center gap-1">
                                                    <i class="fas fa-map-pin text-teal-500"></i>
                                                    {{ $user->region }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold">
                                                <i class="fas fa-leaf mr-1"></i>{{ number_format($user->total_carbon_saved, 2) }} kg
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-800 font-medium">{{ $user->total_orders }}</td>
                                        <td class="px-6 py-4">
                                            @if($user->role === 'admin')
                                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold">
                                                    <i class="fas fa-shield-alt"></i> Admin
                                                </span>
                                            @elseif($user->role === 'seller')
                                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                                    <i class="fas fa-store"></i> Seller
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold">
                                                    <i class="fas fa-user"></i> User
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2">
                                                <a href="{{ route('admin.users.edit', $user) }}" class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-md text-sm">Edit</a>
                                                <form action="{{ route('admin.users.block', $user) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1 {{ $user->is_blocked ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} rounded-md text-sm">{{ $user->is_blocked ? 'Unblock' : 'Block' }}</button>
                                                </form>
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded-md text-sm">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-emerald-50 flex items-center justify-center">
                                                <i class="fas fa-users text-3xl text-emerald-400"></i>
                                            </div>
                                            <p class="text-gray-500">Belum ada pengguna</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="p-4 border-t border-gray-100 bg-gray-50">
                        <div class="flex justify-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
