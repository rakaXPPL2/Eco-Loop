<x-eco-loop-layout title="Hadiah - Admin">
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
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-400 to-pink-500 flex items-center justify-center shadow-lg shadow-rose-200">
                                <i class="fas fa-gift text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">Kelola Hadiah</h1>
                                <p class="text-emerald-600">Kelola hadiah untuk tukar poin pengguna</p>
                            </div>
                        </div>
                        <div class="glass-card-light px-4 py-2 animate-fade-in-up hidden md:block">
                            <span class="text-emerald-700 text-sm">
                                <i class="fas fa-gift mr-2"></i>{{ $rewards->count() }} Hadiah
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Rewards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 stagger-children">
                    @forelse($rewards as $reward)
                        <div class="glass-card-light p-6 animate-fade-in-up hover-lift group">
                            <!-- Header -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-rose-100 to-pink-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-gift text-rose-500 text-xl"></i>
                                </div>
                                @if($reward->is_active)
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-semibold">
                                        <i class="fas fa-times-circle"></i> Nonaktif
                                    </span>
                                @endif
                            </div>

                            <!-- Content -->
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $reward->name }}</h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $reward->description }}</p>

                            <!-- Footer -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-coins text-yellow-500"></i>
                                    <span class="text-xl font-bold text-gray-800">{{ $reward->points_required }}</span>
                                    <span class="text-gray-500 text-sm">Poin</span>
                                </div>
                                <span class="text-sm {{ $reward->stock === -1 ? 'text-emerald-500' : 'text-amber-500' }}">
                                    @if($reward->stock === -1)
                                        <i class="fas fa-infinity mr-1"></i> Unlimited
                                    @else
                                        <i class="fas fa-box mr-1"></i>{{ $reward->stock }} tersisa
                                    @endif
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-rose-50 flex items-center justify-center">
                                <i class="fas fa-gift text-4xl text-rose-400"></i>
                            </div>
                            <p class="text-gray-500">Belum ada hadiah</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-eco-loop-layout>
