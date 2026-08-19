<x-eco-loop-layout title="Notifications">
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Notifications</h1>
                <p class="text-gray-600">Stay updated with your eco-journey</p>
            </div>
            @if($notifications->where('read_at', null)->count() > 0)
                <form action="{{ route('dashboard.notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Mark All as Read
                    </button>
                </form>
            @endif
        </div>

        {{-- Unread Count Summary --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl p-5 text-white">
                <p class="text-sm text-emerald-100 mb-1">Unread Notifications</p>
                <p class="text-3xl font-bold">{{ $notifications->where('read_at', null)->count() }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
                <p class="text-sm text-gray-600 mb-1">Total Notifications</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $notifications->total() }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
                <p class="text-sm text-gray-600 mb-1">Categories</p>
                <p class="text-3xl font-bold text-teal-600">{{ $notifications->pluck('type')->unique()->count() }}</p>
            </div>
        </div>

        {{-- Notifications List --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">All Notifications</h2>
                <div class="flex items-center space-x-2">
                    <a href="?filter=all" class="px-3 py-1 text-sm rounded-lg {{ !request('filter') || request('filter') === 'all' ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        All
                    </a>
                    <a href="?filter=unread" class="px-3 py-1 text-sm rounded-lg {{ request('filter') === 'unread' ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Unread
                    </a>
                    <a href="?filter=read" class="px-3 py-1 text-sm rounded-lg {{ request('filter') === 'read' ? 'bg-emerald-100 text-emerald-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Read
                    </a>
                </div>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($notifications as $notification)
                    <div class="p-5 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors {{ $notification->read_at ? 'opacity-70' : '' }}">
                        <div class="flex items-start space-x-4">
                            {{-- Icon --}}
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center
                                    @if($notification->type === 'order')
                                        bg-blue-100 dark:bg-blue-900/30
                                    @elseif($notification->type === 'voucher')
                                        bg-amber-100 dark:bg-amber-900/30
                                    @elseif($notification->type === 'product')
                                        bg-purple-100 dark:bg-purple-900/30
                                    @elseif($notification->type === 'system')
                                        bg-gray-100 dark:bg-gray-700
                                    @else
                                        bg-emerald-100 dark:bg-emerald-900/30
                                    @endif">
                                    @if($notification->type === 'order')
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    @elseif($notification->type === 'voucher')
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                        </svg>
                                    @elseif($notification->type === 'product')
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    @elseif($notification->type === 'system')
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="font-medium text-gray-900 dark:text-white {{ $notification->read_at ? '' : 'font-semibold' }}">
                                            {{ $notification->title }}
                                            @if(!$notification->read_at)
                                                <span class="ml-2 w-2 h-2 bg-emerald-500 rounded-full inline-block"></span>
                                            @endif
                                        </h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $notification->message }}</p>
                                    </div>
                                    <span class="text-xs text-gray-600 whitespace-nowrap ml-4">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>

                                {{-- Actions --}}
                                <div class="mt-3 flex items-center space-x-4">
                                    @if(!$notification->read_at)
                                        <form action="{{ route('dashboard.notifications.read', $notification->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                                                Mark as Read
                                            </button>
                                        </form>
                                    @endif
                                    @if($notification->action_url)
                                        <a href="{{ $notification->action_url }}" class="text-sm text-gray-600 hover:text-gray-800 font-medium">
                                            View Details →
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <svg class="mx-auto w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <p class="mt-4 text-gray-600">No notifications</p>
                        <p class="text-sm text-gray-600 mt-1">You're all caught up!</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($notifications->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</x-eco-loop-layout>
