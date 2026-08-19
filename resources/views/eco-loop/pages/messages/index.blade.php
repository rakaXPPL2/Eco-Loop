<x-eco-loop-layout title="Pesan - Eco-Loop">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                <i class="fas fa-comments text-emerald-600"></i> Pesan
            </h1>
            <p class="text-gray-600">Percakapan Anda dengan penjual dan admin</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            @forelse($conversations as $userId => $msgs)
                @php
                    $lastMsg = $msgs->first();
                    $otherUser = $lastMsg->sender_id === auth()->id() ? $lastMsg->receiver : $lastMsg->sender;
                    $unreadCount = $msgs->where('receiver_id', auth()->id())->where('is_read', false)->count();
                @endphp
                <a href="{{ route('messages.show', $otherUser) }}"
                    class="block p-4 border-b border-gray-100 hover:bg-emerald-50 transition-colors {{ $unreadCount > 0 ? 'bg-blue-50' : '' }}">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-md">
                            <span class="text-white font-bold text-lg">{{ substr($otherUser->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <span class="font-semibold text-gray-900">{{ $otherUser->name }}</span>
                                @if($unreadCount > 0)
                                    <span class="px-2 py-1 bg-emerald-500 text-white text-xs font-bold rounded-full">{{ $unreadCount }} baru</span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600 truncate">{{ $lastMsg->content }}</p>
                            @if($lastMsg->product)
                                <span class="inline-flex items-center gap-1 text-xs text-gray-500 mt-1">
                                    <i class="fas fa-box"></i> {{ $lastMsg->product->name }}
                                </span>
                            @endif
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-gray-500">{{ $lastMsg->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-12 text-center">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-comments text-4xl text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum ada pesan</h3>
                    <p class="text-gray-500">Mulai percakapan dengan mengirim pesan ke produk</p>
                </div>
            @endforelse
        </div>
    </div>
</x-eco-loop-layout>
