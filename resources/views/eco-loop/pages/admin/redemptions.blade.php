<x-eco-loop-layout title="Penukaran Hadiah - Admin">
    <div class="flex min-h-screen">
        <x-admin-sidebar :stats="[
            'pending_stores' => 0,
            'pending_complaints' => 0
        ]" />

        <div class="flex-1">
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-emerald-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-200">
                            <i class="fas fa-gift text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Penukaran Hadiah</h1>
                            <p class="text-emerald-600">Review dan proses permintaan hadiah dari pengguna</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="overflow-hidden glass-card-light animate-fade-in-up">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-emerald-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-emerald-700">Pengguna</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-emerald-700">Reward</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-emerald-700">Poin</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-emerald-700">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-emerald-700">Catatan</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-emerald-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($redemptions as $r)
                                    <tr class="hover:bg-emerald-50/50">
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="font-semibold text-gray-800">{{ $r->user->name ?? 'Unknown User' }}</div>
                                            <div class="text-xs text-gray-500">{{ $r->user->email ?? '-' }}</div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="font-medium text-gray-800">{{ $r->reward->name ?? '-' }}</div>
                                            <div class="text-xs text-gray-500">{{ $r->reward->type ?? 'reward' }}</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap font-semibold text-emerald-700">
                                            {{ number_format($r->points_spent ?? 0) }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            @php
                                                $statusClass = [
                                                    'pending' => 'bg-amber-100 text-amber-700',
                                                    'completed' => 'bg-emerald-100 text-emerald-700',
                                                    'cancelled' => 'bg-red-100 text-red-700',
                                                ][$r->status] ?? 'bg-gray-100 text-gray-700';
                                            @endphp
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                                {{ $r->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-600 max-w-xs">
                                            {{ $r->notes ?: 'Tidak ada catatan' }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            @if($r->status === 'pending')
                                                <div class="flex flex-col gap-2 sm:flex-row">
                                                    <form action="{{ route('admin.redemptions.approve', $r) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="inline-flex items-center justify-center px-3 py-2 text-sm font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors">
                                                            <i class="fas fa-check mr-2"></i>Setujui
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.redemptions.reject', $r) }}" method="POST" onsubmit="return confirm('Tolak penukaran ini dan kembalikan poin?');">
                                                        @csrf
                                                        <button type="submit" class="inline-flex items-center justify-center px-3 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                                                            <i class="fas fa-times mr-2"></i>Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-sm text-gray-500">Sudah diproses</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-12 text-center text-gray-500">
                                            <div class="flex flex-col items-center gap-3">
                                                <i class="fas fa-inbox text-4xl text-emerald-300"></i>
                                                <span>Tidak ada permintaan penukaran hadiah</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($redemptions->hasPages())
                        <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                            {{ $redemptions->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
