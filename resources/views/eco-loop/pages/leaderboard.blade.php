<x-eco-loop-layout title="Papan Peringkat - Eco-Loop">

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-200 opacity-30 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-teal-200 opacity-20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-r from-emerald-100/40 to-teal-100/40 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="text-center animate-fade-in-up">
                <div class="inline-flex items-center gap-2 px-5 py-2 bg-emerald-400/20 backdrop-blur-md border border-emerald-300/30 rounded-full text-emerald-700 font-semibold text-sm mb-6 transform transition-all duration-300 hover:scale-105 shadow-lg">
                    <i class="fas fa-trophy"></i>
                    <span>Kompetisi Karbon Bulanan</span>
                </div>

                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4 md:mb-6">
                    <i class="fas fa-trophy text-yellow-500 mr-2 md:mr-3"></i>
                    Papan Peringkat
                </h1>

                <p class="text-base md:text-lg text-gray-600 max-w-2xl mx-auto mb-8 md:mb-10">
                    Lihat siapa yang paling berkontribusi dalam mengurangi jejak karbon.
                    Jadilah yang terbaik dan raih hadiah eksklusif!
                </p>

                <!-- Total Stats with Glassmorphism - Responsive Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-6 max-w-3xl mx-auto">
                    <div class="group relative backdrop-blur-xl bg-white/40 border border-white/50 rounded-2xl md:rounded-3xl p-4 md:p-6 shadow-[0_8px_32px_rgba(0,0,0,0.1)] transform transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(16,185,129,0.2)] cursor-default overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/20 to-teal-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl md:rounded-3xl"></div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 md:w-14 md:h-14 mx-auto mb-2 md:mb-3 rounded-xl md:rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg transform transition-transform duration-300 hover:scale-110 group-hover:shadow-xl">
                                <i class="fas fa-leaf text-white text-xl md:text-2xl"></i>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-1">{{ number_format($totalCarbon, 1) }}</p>
                            <p class="text-xs md:text-sm text-gray-600 uppercase tracking-wide flex items-center justify-center gap-1 md:gap-2">
                                <i class="fas fa-cloud text-emerald-600 text-xs"></i> kg CO2 Dihemat
                            </p>
                        </div>
                    </div>
                    <div class="group relative backdrop-blur-xl bg-white/40 border border-white/50 rounded-2xl md:rounded-3xl p-4 md:p-6 shadow-[0_8px_32px_rgba(0,0,0,0.1)] transform transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(59,130,246,0.2)] cursor-default overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-400/20 to-cyan-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl md:rounded-3xl"></div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 md:w-14 md:h-14 mx-auto mb-2 md:mb-3 rounded-xl md:rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center shadow-lg transform transition-transform duration-300 hover:scale-110 group-hover:shadow-xl">
                                <i class="fas fa-users text-white text-xl md:text-2xl"></i>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent mb-1">{{ number_format($totalUsers) }}</p>
                            <p class="text-xs md:text-sm text-gray-600 uppercase tracking-wide flex items-center justify-center gap-1 md:gap-2">
                                <i class="fas fa-user-friends text-blue-400 text-xs"></i> Pengguna Aktif
                            </p>
                        </div>
                    </div>
                    <div class="group relative backdrop-blur-xl bg-white/40 border border-white/50 rounded-2xl md:rounded-3xl p-4 md:p-6 shadow-[0_8px_32px_rgba(0,0,0,0.1)] transform transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(168,85,247,0.2)] cursor-default overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-400/20 to-pink-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl md:rounded-3xl"></div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 md:w-14 md:h-14 mx-auto mb-2 md:mb-3 rounded-xl md:rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center shadow-lg transform transition-transform duration-300 hover:scale-110 group-hover:shadow-xl">
                                <i class="fas fa-shopping-bag text-white text-xl md:text-2xl"></i>
                            </div>
                            <p class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-1">{{ number_format($totalTransactions) }}</p>
                            <p class="text-xs md:text-sm text-gray-600 uppercase tracking-wide flex items-center justify-center gap-1 md:gap-2">
                                <i class="fas fa-handshake text-purple-400 text-xs"></i> Transaksi
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <section class="py-6 bg-white border-b border-gray-100 sticky top-16 md:top-20 z-40 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex gap-2 bg-gray-100 p-1 rounded-xl">
                <a href="{{ route('leaderboard', ['type' => 'buyers']) }}"
                   class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-lg font-semibold text-sm md:text-base transition-all duration-300
                   {{ ($type ?? 'buyers') === 'buyers'
                       ? 'bg-gradient-to-r from-emerald-500 to-teal-500 text-white shadow-lg transform scale-[1.02]'
                       : 'text-gray-600 hover:bg-white hover:text-emerald-600' }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Leaderboard Pembeli</span>
                </a>
                <a href="{{ route('leaderboard', ['type' => 'sellers']) }}"
                   class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-lg font-semibold text-sm md:text-base transition-all duration-300
                   {{ ($type ?? 'buyers') === 'sellers'
                       ? 'bg-gradient-to-r from-purple-500 to-pink-500 text-white shadow-lg transform scale-[1.02]'
                       : 'text-gray-600 hover:bg-white hover:text-purple-600' }}">
                    <i class="fas fa-store"></i>
                    <span>Leaderboard Penjual</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Top 3 Podium with Glassmorphism -->
    @if($leaderboard->count() >= 3)
        <section class="py-8 md:py-12 bg-gradient-to-b from-emerald-100/50 via-teal-50/50 to-cyan-50/50 relative overflow-hidden">
            <div class="absolute inset-0 backdrop-blur-xl bg-white/20"></div>
            <div class="absolute -top-20 left-1/4 w-72 h-72 bg-emerald-300/30 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 right-1/4 w-72 h-72 bg-teal-300/30 rounded-full blur-3xl"></div>

            <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-end justify-center gap-2 sm:gap-4 md:gap-8">
                    <!-- 2nd Place -->
                    <div class="text-center w-28 sm:w-32 md:w-40 order-1 transform transition-all duration-500 hover:-translate-y-2">
                        <div class="relative mx-auto mb-3 md:mb-4">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 mx-auto rounded-full bg-gradient-to-br from-gray-200 to-gray-400 shadow-lg flex items-center justify-center ring-4 ring-gray-300/50 transform transition-all duration-300 hover:scale-110 backdrop-blur-xl bg-white/30">
                                <span class="text-white text-2xl sm:text-3xl md:text-4xl font-bold">{{ substr($leaderboard[1]->name, 0, 1) }}</span>
                            </div>
                            <div class="absolute -top-1 -right-1 sm:-top-2 sm:-right-2 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center shadow-lg backdrop-blur-xl">
                                <span class="text-white font-bold text-xs sm:text-sm">2</span>
                            </div>
                        </div>
                        <div class="backdrop-blur-xl bg-white/40 border border-white/50 rounded-t-xl rounded-b-lg md:rounded-b-xl px-3 md:px-4 py-2 md:py-3 shadow-[0_8px_32px_rgba(0,0,0,0.1)]">
                            <p class="font-bold text-gray-700 truncate text-sm md:text-base">{{ $leaderboard[1]->name }}</p>
                            <p class="text-base md:text-lg font-bold text-gray-600 flex items-center justify-center gap-1">
                                <i class="fas fa-leaf text-green-500 text-xs md:text-sm"></i>
                                {{ number_format($leaderboard[1]->total_carbon_saved, 1) }} kg
                            </p>
                            <p class="text-xs text-gray-600 flex items-center justify-center gap-1">
                                <i class="fas fa-star text-yellow-500"></i> {{ number_format($leaderboard[1]->calculated_points ?? 0) }} poin
                            </p>
                        </div>
                    </div>

                    <!-- 1st Place -->
                    <div class="text-center w-32 sm:w-40 md:w-48 order-2 transform -translate-y-3 sm:-translate-y-4 md:-translate-y-6 transition-all duration-500">
                        <div class="relative mx-auto mb-3 md:mb-4">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-32 md:h-32 mx-auto rounded-full bg-gradient-to-br from-yellow-400 to-amber-500 shadow-xl flex items-center justify-center ring-4 ring-yellow-300/50 transform transition-all duration-300 hover:scale-110 animate-pulse-slow">
                                <span class="text-white text-3xl sm:text-4xl md:text-5xl font-bold">{{ substr($leaderboard[0]->name, 0, 1) }}</span>
                            </div>
                            <div class="absolute -top-1 -right-1 sm:-top-2 sm:-right-2 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-yellow-400 to-amber-500 flex items-center justify-center shadow-lg transform transition-all duration-300 hover:scale-110">
                                <i class="fas fa-crown text-white text-sm sm:text-base"></i>
                            </div>
                        </div>
                        <div class="backdrop-blur-xl bg-gradient-to-b from-yellow-400/80 to-amber-500/80 border border-yellow-300/50 rounded-t-xl rounded-b-lg md:rounded-b-xl px-4 md:px-6 py-3 md:py-4 shadow-[0_12px_40px_rgba(245,158,11,0.4)]">
                            <p class="font-bold text-white truncate text-sm md:text-base">{{ $leaderboard[0]->name }}</p>
                            <p class="text-lg md:text-xl font-bold text-white flex items-center justify-center gap-1">
                                <i class="fas fa-leaf text-sm"></i>
                                {{ number_format($leaderboard[0]->total_carbon_saved, 1) }} kg
                            </p>
                            <p class="text-xs sm:text-sm text-white/80 flex items-center justify-center gap-1">
                                <i class="fas fa-star text-xs"></i> {{ number_format($leaderboard[0]->calculated_points ?? 0) }} poin
                            </p>
                        </div>
                    </div>

                    <!-- 3rd Place -->
                    <div class="text-center w-28 sm:w-32 md:w-40 order-3 transform transition-all duration-500 hover:-translate-y-2">
                        <div class="relative mx-auto mb-3 md:mb-4">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 mx-auto rounded-full bg-gradient-to-br from-amber-600 to-amber-700 shadow-lg flex items-center justify-center ring-4 ring-amber-400/50 transform transition-all duration-300 hover:scale-110 backdrop-blur-xl bg-white/30">
                                <span class="text-white text-2xl sm:text-3xl md:text-4xl font-bold">{{ substr($leaderboard[2]->name, 0, 1) }}</span>
                            </div>
                            <div class="absolute -top-1 -right-1 sm:-top-2 sm:-right-2 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-gradient-to-br from-amber-600 to-amber-700 flex items-center justify-center shadow-lg backdrop-blur-xl">
                                <span class="text-white font-bold text-xs sm:text-sm">3</span>
                            </div>
                        </div>
                        <div class="backdrop-blur-xl bg-gradient-to-b from-amber-600/80 to-amber-700/80 border border-amber-500/50 rounded-t-xl rounded-b-lg md:rounded-b-xl px-3 md:px-4 py-2 md:py-3 shadow-[0_8px_32px_rgba(0,0,0,0.15)]">
                            <p class="font-bold text-white truncate text-sm md:text-base">{{ $leaderboard[2]->name }}</p>
                            <p class="text-base md:text-lg font-bold text-white flex items-center justify-center gap-1">
                                <i class="fas fa-leaf text-sm"></i>
                                {{ number_format($leaderboard[2]->total_carbon_saved, 1) }} kg
                            </p>
                            <p class="text-xs text-white/70 flex items-center justify-center gap-1">
                                <i class="fas fa-star text-xs"></i> {{ number_format($leaderboard[2]->calculated_points ?? 0) }} poin
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Full Leaderboard with Glassmorphism -->
    <section class="py-10 md:py-16 bg-gradient-to-b from-cyan-50/50 via-teal-50/50 to-emerald-50/50 relative">
        <div class="absolute inset-0 backdrop-blur-3xl bg-white/30"></div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 md:gap-4 mb-6 md:mb-8 animate-fade-in-up">
                <div>
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-1 flex items-center gap-2">
                        <i class="fas fa-list-ol text-emerald-600"></i>
                        Peringkat Lengkap {{ ($type ?? 'buyers') === 'buyers' ? 'Pembeli' : 'Penjual' }}
                    </h2>
                    <p class="text-sm md:text-base text-gray-600 flex items-center gap-2">
                        <i class="fas fa-users text-gray-600"></i> Pengguna dengan kontribusi karbon tertinggi
                    </p>
                </div>

                @auth
                    @php
                        $userRank = $leaderboard->search(function($item) { return $item->id === auth()->id(); }) !== false
                            ? $leaderboard->search(function($item) { return $item->id === auth()->id(); }) + 1
                            : null;
                    @endphp
                    @if($userRank)
                        <div class="inline-flex items-center gap-2 backdrop-blur-xl bg-gradient-to-r from-emerald-500/90 to-teal-500/90 text-white px-4 md:px-5 py-2 md:py-3 rounded-xl shadow-[0_8px_32px_rgba(16,185,129,0.3)] border border-emerald-400/30 text-sm md:text-base">
                            <i class="fas fa-user"></i>
                            Peringkat Anda: <strong>#{{ $userRank }}</strong>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="backdrop-blur-xl bg-white/50 border border-white/60 rounded-2xl md:rounded-3xl shadow-[0_8px_32px_rgba(0,0,0,0.1)] overflow-hidden animate-fade-in-up delay-100">
                <!-- Header - Responsive -->
                <div class="grid grid-cols-12 gap-2 md:gap-4 p-3 md:p-4 bg-gradient-to-r from-emerald-500/90 to-teal-500/90 text-white font-bold text-xs md:text-sm backdrop-blur-xl border-b border-white/20">
                    <div class="col-span-2 md:col-span-1 text-center">
                        <i class="fas fa-hashtag mr-1"></i><span class="hidden sm:inline">Peringkat</span>
                    </div>
                    <div class="col-span-5 md:col-span-5">Pengguna</div>
                    <div class="col-span-2 text-center hidden md:block">
                        <i class="fas fa-leaf mr-1"></i>Karbon
                    </div>
                    <div class="col-span-3 md:col-span-2 text-center">
                        <i class="fas fa-coins mr-1"></i>Poin
                    </div>
                    <div class="col-span-3 md:col-span-2 text-center">
                        <i class="fas fa-shopping-bag mr-1"></i>Transaksi
                    </div>
                </div>

                <!-- Users -->
                @forelse($leaderboard as $index => $user)
                    <div class="grid grid-cols-12 gap-2 md:gap-4 p-3 md:p-4 items-center border-b border-gray-100/50 transition-all duration-300 hover:bg-emerald-50/80 backdrop-blur-sm
                        {{ $index < 3 ? 'bg-yellow-50/50' : '' }}
                        {{ auth()->check() && $user->id === auth()->id() ? 'bg-emerald-100/80 ring-2 ring-emerald-400/50' : '' }}" style="animation-delay: {{ $index * 50 }}ms;">

                        <!-- Rank -->
                        <div class="col-span-2 md:col-span-1 text-center">
                            @if($index === 0)
                                <div class="w-8 h-8 sm:w-10 sm:h-10 mx-auto rounded-lg md:rounded-xl bg-gradient-to-br from-yellow-400 to-amber-500 flex items-center justify-center shadow-lg transform transition-all duration-300 hover:scale-110">
                                    <i class="fas fa-trophy text-white text-sm sm:text-base"></i>
                                </div>
                            @elseif($index === 1)
                                <div class="w-8 h-8 sm:w-10 sm:h-10 mx-auto rounded-lg md:rounded-xl bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center shadow-md transform transition-all duration-300 hover:scale-110">
                                    <i class="fas fa-medal text-white text-sm sm:text-base"></i>
                                </div>
                            @elseif($index === 2)
                                <div class="w-8 h-8 sm:w-10 sm:h-10 mx-auto rounded-lg md:rounded-xl bg-gradient-to-br from-amber-600 to-amber-700 flex items-center justify-center shadow-md transform transition-all duration-300 hover:scale-110">
                                    <i class="fas fa-medal text-white text-sm sm:text-base"></i>
                                </div>
                            @else
                                <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-lg md:rounded-xl bg-gray-100 font-bold text-gray-600 text-sm">
                                    {{ $index + 1 }}
                                </span>
                            @endif
                        </div>

                        <!-- User Info -->
                        <div class="col-span-5 md:col-span-5 flex items-center gap-2 md:gap-3">
                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg md:rounded-xl
                                @if($index === 0) bg-gradient-to-br from-yellow-400 to-amber-500
                                @elseif($index === 1) bg-gradient-to-br from-gray-300 to-gray-400
                                @elseif($index === 2) bg-gradient-to-br from-amber-600 to-amber-700
                                @else bg-gradient-to-br from-emerald-500 to-teal-500
                                @endif
                                flex items-center justify-center shadow-md transform transition-all duration-300 hover:scale-110">
                                <span class="text-white font-bold text-sm md:text-lg">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-800 truncate text-sm md:text-base flex items-center gap-1 md:gap-2">
                                    {{ $user->name }}
                                    @if(auth()->check() && $user->id === auth()->id())
                                        <span class="inline-flex items-center px-1.5 md:px-2 py-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-xs font-semibold rounded-full shadow-sm">Anda</span>
                                    @endif
                                </p>
                                <p class="text-xs text-gray-600 md:hidden flex items-center gap-1">
                                    <i class="fas fa-leaf text-emerald-600"></i> {{ number_format($user->total_carbon_saved, 1) }} kg CO2
                                </p>
                            </div>
                        </div>

                        <!-- Carbon (desktop) -->
                        <div class="col-span-2 text-center hidden md:block">
                            <span class="inline-flex items-center gap-1 px-2 md:px-3 py-1 bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-700 rounded-full text-xs md:text-sm font-semibold shadow-sm">
                                <i class="fas fa-leaf"></i>
                                {{ number_format($user->total_carbon_saved, 1) }} kg
                            </span>
                        </div>

                        <!-- Points -->
                        <div class="col-span-3 md:col-span-2 text-center">
                            <div class="inline-flex items-center gap-1 px-2 md:px-3 py-1 bg-gradient-to-r from-yellow-100 to-amber-100 text-amber-700 rounded-full text-xs md:text-sm font-bold shadow-sm">
                                <i class="fas fa-coins"></i>
                                {{ number_format($user->calculated_points ?? 0) }}
                            </div>
                        </div>

                        <!-- Transactions -->
                        <div class="col-span-3 md:col-span-2 text-center">
                            <span class="font-semibold text-gray-700 text-sm">{{ $user->orders_count ?? 0 }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 md:py-16">
                        <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 bg-gray-100 rounded-2xl flex items-center justify-center transform transition-transform duration-300 hover:scale-110 backdrop-blur-xl">
                            <i class="fas fa-users text-3xl md:text-4xl text-gray-300"></i>
                        </div>
                        <h3 class="text-base md:text-lg font-semibold text-gray-700 mb-2">Belum Ada Data</h3>
                        <p class="text-sm md:text-base text-gray-600">Jadilah yang pertama berkontribusi mengurangi karbon!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Join CTA with Glassmorphism -->
    @guest
        <section class="py-12 md:py-16 bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 relative overflow-hidden">
            <div class="absolute inset-0 backdrop-blur-3xl bg-white/10"></div>
            <div class="absolute -top-20 -right-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-r from-white/5 to-cyan-500/5 rounded-full blur-3xl"></div>

            <div class="relative max-w-4xl mx-auto px-4 text-center">
                <div class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-4 md:mb-6 rounded-xl md:rounded-2xl backdrop-blur-xl bg-white/20 flex items-center justify-center transform transition-transform duration-300 hover:scale-110 border border-white/30 shadow-[0_8px_32px_rgba(0,0,0,0.2)]">
                    <i class="fas fa-trophy text-white text-2xl md:text-3xl"></i>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-3 md:mb-4">
                    Ingin Masuk Papan Peringkat?
                </h2>
                <p class="text-white/90 mb-6 md:text-lg">
                    Bergabung sekarang dan mulai berkontribusi untuk bumi yang lebih baik!
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-6 md:px-8 py-3 md:py-4 backdrop-blur-xl bg-white text-emerald-600 font-bold rounded-xl hover:bg-white/90 transition-all duration-300 shadow-[0_8px_32px_rgba(0,0,0,0.2)] border border-white/50 hover:shadow-[0_12px_40px_rgba(0,0,0,0.3)] hover:-translate-y-1 text-sm md:text-base">
                        <i class="fas fa-user-plus"></i>
                        Daftar Gratis
                    </a>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center gap-2 px-6 md:px-8 py-3 md:py-4 backdrop-blur-xl border-2 border-white/50 text-white font-bold rounded-xl hover:bg-white/10 transition-all duration-300 text-sm md:text-base">
                        <i class="fas fa-store"></i>
                        Mulai Belanja
                    </a>
                </div>
            </div>
        </section>
    @endguest

</x-eco-loop-layout>
