<x-eco-loop-layout title="Pesan - Admin">
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
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center shadow-lg shadow-purple-200">
                                <i class="fas fa-comments text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">Pesan</h1>
                                <p class="text-emerald-600">Pantau pesan antara penjual dan pembeli</p>
                            </div>
                        </div>
                        <div class="glass-card-light px-4 py-2 hidden md:block">
                            <span class="text-emerald-700 text-sm">
                                <i class="fas fa-envelope mr-2"></i>{{ $messages->total() }} Pesan
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Messages Table -->
                <div class="glass-card-light overflow-hidden animate-fade-in-up" style="animation-delay: 100ms;">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="glass-table-header-light">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-user"></i> Pengirim
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-user-check"></i> Penerima
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-envelope"></i> Subjek
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-box"></i> Produk
                                        </span>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-clock"></i> Waktu
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($messages as $message)
                                    <tr class="hover:bg-emerald-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-200">
                                                    <span class="text-white font-bold">{{ substr($message->sender->name, 0, 1) }}</span>
                                                </div>
                                                <span class="font-semibold text-gray-800">{{ $message->sender->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                                                    <span class="text-purple-600 font-bold text-xs">{{ substr($message->receiver->name, 0, 1) }}</span>
                                                </div>
                                                <span class="text-gray-600">{{ $message->receiver->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-gray-800">{{ Str::limit($message->subject, 30) }}</div>
                                            <div class="text-xs text-gray-400 line-clamp-1">{{ Str::limit($message->content, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($message->product)
                                                <a href="{{ route('products.show', $message->product) }}" class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-700 transition-colors">
                                                    <i class="fas fa-external-link-alt text-xs"></i>
                                                    {{ Str::limit($message->product->name, 20) }}
                                                </a>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-gray-500 text-sm">{{ $message->created_at->format('d/m H:i') }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-purple-50 flex items-center justify-center">
                                                <i class="fas fa-inbox text-3xl text-purple-400"></i>
                                            </div>
                                            <p class="text-gray-500">Belum ada pesan</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($messages->hasPages())
                        <div class="p-4 border-t border-gray-100 bg-gray-50">
                            <div class="flex justify-center">
                                {{ $messages->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
