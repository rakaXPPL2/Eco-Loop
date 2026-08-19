<x-eco-loop-layout title="Lencana - Admin">
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
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-400 to-amber-500 flex items-center justify-center shadow-lg shadow-yellow-200">
                                <i class="fas fa-award text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">Kelola Lencana</h1>
                                <p class="text-emerald-600">Kelola lencana untuk penghargaan pengguna</p>
                            </div>
                        </div>
                        <div class="glass-card-light px-4 py-2 animate-fade-in-up hidden md:block">
                            <span class="text-emerald-700 text-sm">
                                <i class="fas fa-medal mr-2"></i>{{ $badges->count() }} Lencana
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Badges Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 stagger-children">
                    @forelse($badges as $badge)
                        <div class="glass-card-light p-6 animate-fade-in-up hover-lift group">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="w-16 h-16 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform" style="background: linear-gradient(135deg, {{ $badge->color }}20, {{ $badge->color }}10);">
                                    <i class="fas {{ $badge->icon ?? 'fa-medal' }} text-3xl" style="color: {{ $badge->color }};"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $badge->name }}</h3>
                                    <p class="text-gray-400 text-xs">{{ $badge->slug }}</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $badge->description }}</p>
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold">
                                    <i class="fas fa-leaf mr-1"></i>
                                    {{ $badge->requirement }} kg CO2
                                </span>
                                @if($badge->is_active)
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-semibold">
                                        <i class="fas fa-times-circle"></i> Nonaktif
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-yellow-50 flex items-center justify-center">
                                <i class="fas fa-award text-4xl text-yellow-400"></i>
                            </div>
                            <p class="text-gray-500">Belum ada lencana</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
