<footer class="glass-nav mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/30 glow-effect">
                        <i class="fas fa-leaf text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-emerald-300 to-teal-300 bg-clip-text text-transparent">Eco-Loop</span>
                </div>
                <p class="text-white/60 mb-4 max-w-md">
                    Platform jual-beli barang daur ulang, sisa makanan, dan rumput pakan ternak untuk kurangi jejak karbon Indonesia.
                </p>
                <div class="flex gap-4">
                    <a href="https://instagram.com/ecoloop.id" target="_blank" rel="noopener noreferrer" title="Instagram - Segera Hadir" class="w-10 h-10 rounded-lg glass flex items-center justify-center hover:bg-emerald-500/50 transition-all duration-300">
                        <i class="fab fa-instagram text-white/70"></i>
                    </a>
                    <a href="https://facebook.com/ecoloop.id" target="_blank" rel="noopener noreferrer" title="Facebook - Segera Hadir" class="w-10 h-10 rounded-lg glass flex items-center justify-center hover:bg-emerald-500/50 transition-all duration-300">
                        <i class="fab fa-facebook-f text-white/70"></i>
                    </a>
                    <a href="https://twitter.com/ecoloop_id" target="_blank" rel="noopener noreferrer" title="Twitter/X - Segera Hadir" class="w-10 h-10 rounded-lg glass flex items-center justify-center hover:bg-emerald-500/50 transition-all duration-300">
                        <i class="fab fa-twitter text-white/70"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-semibold text-lg mb-4 text-white flex items-center gap-2">
                    <i class="fas fa-list text-emerald-400"></i>Menu
                </h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-white/50 hover:text-emerald-300 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                        <i class="fas fa-chevron-right text-xs text-emerald-500"></i>Beranda</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-white/50 hover:text-emerald-300 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                        <i class="fas fa-chevron-right text-xs text-emerald-500"></i>Katalog Produk</a></li>
                    <li><a href="{{ route('eco-shop') }}" class="text-white/50 hover:text-emerald-300 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                        <i class="fas fa-chevron-right text-xs text-emerald-500"></i>Eco-Shop</a></li>
                    <li><a href="{{ route('leaderboard') }}" class="text-white/50 hover:text-emerald-300 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                        <i class="fas fa-chevron-right text-xs text-emerald-500"></i>Peringkat</a></li>
                </ul>
            </div>

            <!-- Categories -->
            <div>
                <h4 class="font-semibold text-lg mb-4 text-white flex items-center gap-2">
                    <i class="fas fa-folder text-emerald-400"></i>Kategori
                </h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('products.index', ['category' => 'produk-olahan']) }}" class="text-white/50 hover:text-emerald-300 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                        <i class="fas fa-recycle mr-2 text-emerald-400"></i>Produk Olahan
                    </a></li>
                    <li><a href="{{ route('products.index', ['category' => 'makanan-sisa']) }}" class="text-white/50 hover:text-emerald-300 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                        <i class="fas fa-utensils mr-2 text-emerald-400"></i>Makanan Sisa
                    </a></li>
                    <li><a href="{{ route('products.index', ['category' => 'rumput-pakan']) }}" class="text-white/50 hover:text-emerald-300 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                        <i class="fas fa-seedling mr-2 text-emerald-400"></i>Rumput & Pakan Ternak
                    </a></li>
                    <li><a href="{{ route('products.index', ['category' => 'sampah-daur-ulang']) }}" class="text-white/50 hover:text-emerald-300 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                        <i class="fas fa-trash-alt mr-2 text-emerald-400"></i>Sampah Daur Ulang
                    </a></li>
                </ul>
            </div>
        </div>

        <div class="glass-divider mt-8 pt-8 text-center">
            <p class="text-white/40 text-sm">
                &copy; {{ date('Y') }} Eco-Loop Marketplace. <span class="text-emerald-400">Tim Hanchou Sanchou - Innoventure Chapter II 2026</span>.
            </p>
        </div>
    </div>

    <style>
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .glow-effect {
            animation: glow 3s ease-in-out infinite;
        }

        @keyframes glow {
            0%, 100% { box-shadow: 0 0 15px rgba(34, 197, 94, 0.3); }
            50% { box-shadow: 0 0 30px rgba(34, 197, 94, 0.5); }
        }
    </style>
</footer>
