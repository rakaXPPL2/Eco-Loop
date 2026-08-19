<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Eco-Loop - Platform jual-beli barang daur ulang, ubah sampah jadi harta dan selamatkan bumi bersama">

    <title>Eco-Loop - Kurangi Jejak Karbon Bersama</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Scripts -->
    @vite(["resources/css/app.css", "resources/js/app.js", "resources/js/landing.jsx"])

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ===== GLASSMORPHISM BASE STYLES ===== */
        .glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }

        .glass-eco {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(16, 185, 129, 0.15) 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(34, 197, 94, 0.3);
            box-shadow: 0 8px 32px rgba(34, 197, 94, 0.15);
        }

        .glass-btn {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.9) 0%, rgba(16, 185, 129, 0.9) 100%);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 4px 20px rgba(34, 197, 94, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .glass-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(34, 197, 94, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .glass-badge {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .glass-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
        }

        /* Animated Gradient Background */
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animated-gradient {
            background: linear-gradient(-45deg, #22c55e, #10b981, #14b8a6, #34d399, #6ee7b7);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(34, 197, 94, 0.3); }
            50% { box-shadow: 0 0 40px rgba(34, 197, 94, 0.6); }
        }

        .glow-effect {
            animation: glow 3s ease-in-out infinite;
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        /* Floating Lines Canvas */
        #floating-lines-root {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        #floating-lines-root canvas {
            display: block;
        }

        /* Hero Animation */
        .hero-content > * {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        .hero-content > *:nth-child(1) { animation-delay: 0.1s; }
        .hero-content > *:nth-child(2) { animation-delay: 0.2s; }
        .hero-content > *:nth-child(3) { animation-delay: 0.3s; }
        .hero-content > *:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        .float-animation-delayed {
            animation: float 6s ease-in-out infinite;
            animation-delay: 2s;
        }

        /* Card Hover Effects */
        .feature-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .feature-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(34, 197, 94, 0.25);
        }

        .feature-card:hover .icon-wrapper {
            transform: scale(1.1) rotate(5deg);
        }

        .icon-wrapper {
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Category Card Effects */
        .category-card {
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #22c55e, #10b981, #14b8a6);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .category-card:hover::before {
            transform: scaleX(1);
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -15px rgba(34, 197, 94, 0.3);
        }

        /* Step Card Effects */
        .step-card {
            transition: all 0.3s ease;
        }

        .step-card:hover .step-number {
            transform: scale(1.1);
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.5);
        }

        .step-number {
            transition: all 0.3s ease;
        }

        /* CTA Button Animation */
        .cta-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .cta-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .cta-btn:hover::before {
            left: 100%;
        }

        .cta-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px -10px rgba(34, 197, 94, 0.5);
        }

        /* Scroll Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Stats Counter Animation */
        @keyframes countUp {
            from { opacity: 0; transform: scale(0.5); }
            to { opacity: 1; transform: scale(1); }
        }

        .stat-item {
            animation: countUp 0.6s ease-out forwards;
        }

        .stat-item:nth-child(1) { animation-delay: 0.2s; }
        .stat-item:nth-child(2) { animation-delay: 0.4s; }
        .stat-item:nth-child(3) { animation-delay: 0.6s; }
        .stat-item:nth-child(4) { animation-delay: 0.8s; }

        /* Craftsmanship Card */
        .craft-card {
            transition: all 0.4s ease;
        }
        .craft-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px -15px rgba(34, 197, 94, 0.4);
        }
        .craft-card:hover .craft-image {
            transform: scale(1.1);
        }
        .craft-image {
            transition: transform 0.5s ease;
        }

        /* Partner Card */
        .partner-card {
            transition: all 0.3s ease;
        }
        .partner-card:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px -10px rgba(34, 197, 94, 0.3);
        }

        /* Location Card */
        .location-card {
            transition: all 0.3s ease;
        }
        .location-card:hover {
            transform: translateY(-8px);
            border-color: #22c55e;
        }

        /* Navbar scroll effect */
        .navbar-scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* Mobile menu */
        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }
        .mobile-menu.active {
            transform: translateX(0);
        }
    </style>
</head>
<body class="font-sans antialiased" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <!-- Enhanced Glassmorphism Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass-nav transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 rounded-xl gradient-eco flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 group-hover:rotate-6 glow-effect">
                        <i class="fas fa-leaf text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold text-gradient-eco transition-colors duration-300">Eco-Loop</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center gap-8">
                    <a href="#fitur" class="text-gray-600 hover:text-emerald-600 font-semibold transition-colors duration-300 relative group">
                        <span class="glass-badge px-3 py-1 rounded-full text-sm">Fitur</span>
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#cara-kerja" class="text-gray-600 hover:text-emerald-600 font-semibold transition-colors duration-300 relative group">
                        <span class="glass-badge px-3 py-1 rounded-full text-sm">Cara Kerja</span>
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#kategori" class="text-gray-600 hover:text-emerald-600 font-semibold transition-colors duration-300 relative group">
                        <span class="glass-badge px-3 py-1 rounded-full text-sm">Kategori</span>
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#voucher-karbon" class="text-gray-600 hover:text-emerald-600 font-semibold transition-colors duration-300 relative group">
                        <span class="glass-badge px-3 py-1 rounded-full text-sm">Voucher Karbon</span>
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-3">
                    <a href="{{ route("login") }}" class="px-5 py-2.5 text-emerald-600 font-semibold rounded-lg glass-card hover:shadow-lg transition-all duration-300">
                        Masuk
                    </a>
                    <a href="{{ route("register") }}" class="px-5 py-2.5 glass-btn text-white font-semibold rounded-lg transition-all duration-300">
                        Daftar Gratis
                    </a>

                    <!-- Mobile Menu Button -->
                    <button class="lg:hidden p-2 text-gray-600 hover:text-emerald-600 glass-card rounded-lg" id="mobileMenuBtn">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu fixed top-0 right-0 w-72 h-full glass-nav shadow-2xl lg:hidden" id="mobileMenu">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <span class="text-xl font-bold text-gradient-eco">Menu</span>
                    <button class="p-2 text-gray-600 hover:text-emerald-600 glass-card rounded-lg" id="closeMobileMenu">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="flex flex-col gap-4">
                    <a href="#fitur" class="text-gray-600 hover:text-emerald-600 font-semibold py-3 border-b border-gray-200 glass-card px-4 rounded-lg">
                        Fitur
                    </a>
                    <a href="#cara-kerja" class="text-gray-600 hover:text-emerald-600 font-semibold py-3 border-b border-gray-200 glass-card px-4 rounded-lg">
                        Cara Kerja
                    </a>
                    <a href="#kategori" class="text-gray-600 hover:text-emerald-600 font-semibold py-3 border-b border-gray-200 glass-card px-4 rounded-lg">
                        Kategori
                    </a>
                    <a href="#voucher-karbon" class="text-gray-600 hover:text-emerald-600 font-semibold py-3 border-b border-gray-200 glass-card px-4 rounded-lg">
                        Voucher Karbon
                    </a>
                </div>
                <div class="mt-8 flex flex-col gap-3">
                    <a href="{{ route("login") }}" class="px-5 py-3 text-center text-emerald-600 font-semibold rounded-lg glass-card border-2 border-emerald-300 hover:shadow-lg transition-all duration-300">
                        Masuk
                    </a>
                    <a href="{{ route("register") }}" class="px-5 py-3 text-center glass-btn text-white font-semibold rounded-lg transition-all duration-300">
                        Daftar Gratis
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Glassmorphism & Animated Gradient -->
    <section class="pt-28 pb-20 animated-gradient relative overflow-hidden min-h-screen flex items-center">
        <!-- Glass Overlay -->
        <div class="absolute inset-0 glass-section z-0"></div>

        <!-- FloatingLines Background -->
        <div id="floating-lines-root" class="absolute inset-0 z-10"></div>

        <!-- Overlay Gradient -->
        <div class="absolute inset-0 bg-gradient-to-b from-white/30 via-transparent to-white/50 z-20"></div>

        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 overflow-hidden z-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white/20 rounded-full blur-3xl float-animation"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white/15 rounded-full blur-3xl float-animation-delayed"></div>
            <div class="absolute top-40 right-1/4 w-48 h-48 bg-white/10 rounded-full blur-2xl float-animation"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-30">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="hero-content stagger-children">
                    <span class="inline-flex items-center px-5 py-2.5 glass-card text-emerald-800 rounded-full text-sm font-bold shadow-xl hover:shadow-2xl transition-shadow animate-fade-in-up glow-effect">
                        <i class="fas fa-globe-americas mr-2"></i>Platform Ramah Lingkungan
                    </span>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Ubah Sampah Jadi
                        <span class="text-gradient-eco relative">
                            Harta
                            <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 200 12" fill="none">
                                <path d="M2 10C50 2 150 2 198 10" stroke="#22c55e" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        </span>,
                        Selamatkan Bumi!
                    </h1>

                    <p class="text-lg text-gray-700 mb-8 leading-relaxed max-w-xl glass-card px-4 py-3 rounded-xl">
                        Eco-Loop menghubungkan penjual dan pembeli barang daur ulang, sisa makanan, dan rumput pakan ternak.
                        Setiap transaksi Anda mengurangi emisi karbon dan mendapat <span class="font-semibold text-emerald-700">Voucher Karbon</span> sebagai penghargaan!
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route("register") }}" class="cta-btn glass-btn inline-flex items-center justify-center px-8 py-4 text-white text-lg font-bold rounded-xl shadow-lg">
                            <i class="fas fa-rocket mr-2"></i>Mulai Sekarang
                        </a>
                        <a href="{{ route("products.index") }}" class="cta-btn inline-flex items-center justify-center px-8 py-4 border-2 border-emerald-400 text-emerald-700 text-lg font-bold rounded-xl glass-card hover:bg-emerald-50 transition-all duration-300">
                            <i class="fas fa-eye mr-2"></i>Lihat Produk
                        </a>
                    </div>

                    <!-- Quick Stats -->
                    <div class="flex flex-wrap gap-6 mt-10 pt-6 border-t border-white/30">
                        <div class="flex items-center gap-2 glass-card px-4 py-2 rounded-xl">
                            <div class="w-10 h-10 rounded-full glass bg-emerald-200/50 flex items-center justify-center">
                                <i class="fas fa-users text-emerald-600"></i>
                            </div>
                            <div>
                                <div class="text-lg font-bold text-gray-900">500+</div>
                                <div class="text-xs text-gray-600">Pengguna Aktif</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 glass-card px-4 py-2 rounded-xl">
                            <div class="w-10 h-10 rounded-full glass bg-emerald-200/50 flex items-center justify-center">
                                <i class="fas fa-cloud text-emerald-500"></i>
                            </div>
                            <div>
                                <div class="text-lg font-bold text-gray-900">2.5 Ton</div>
                                <div class="text-xs text-gray-600">CO2 Dihemat</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 glass-card px-4 py-2 rounded-xl">
                            <div class="w-10 h-10 rounded-full glass bg-emerald-200/50 flex items-center justify-center">
                                <i class="fas fa-recycle text-teal-500"></i>
                            </div>
                            <div>
                                <div class="text-lg font-bold text-gray-900">1.2K+</div>
                                <div class="text-xs text-gray-600">Transaksi</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative hidden lg:block">
                    <div class="glass-card rounded-3xl shadow-2xl p-8 relative z-10 transform hover:scale-[1.02] transition-transform duration-500">
                        <!-- Stats Card -->
                        <div class="text-center mb-8">
                            <div class="w-20 h-20 rounded-full gradient-eco mx-auto flex items-center justify-center mb-4 shadow-lg glow-effect float-animation">
                                <i class="fas fa-earth-americas text-white text-3xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">Dampak Kita Bersama</h3>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="stat-item glass-card rounded-2xl p-5 text-center hover:bg-white/50 transition-colors duration-300 cursor-default">
                                <div class="text-3xl font-bold text-emerald-600 mb-1">500+</div>
                                <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                                    <i class="fas fa-users text-emerald-600"></i> Pengguna Aktif
                                </div>
                            </div>
                            <div class="stat-item glass-card rounded-2xl p-5 text-center hover:bg-white/50 transition-colors duration-300 cursor-default">
                                <div class="text-3xl font-bold text-emerald-600 mb-1">2,500 kg</div>
                                <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                                    <i class="fas fa-cloud text-emerald-500"></i> CO2 Dihemat
                                </div>
                            </div>
                            <div class="stat-item glass-card rounded-2xl p-5 text-center hover:bg-white/50 transition-colors duration-300 cursor-default">
                                <div class="text-3xl font-bold text-teal-600 mb-1">1,200+</div>
                                <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                                    <i class="fas fa-handshake text-teal-500"></i> Transaksi
                                </div>
                            </div>
                            <div class="stat-item glass-card rounded-2xl p-5 text-center hover:bg-white/50 transition-colors duration-300 cursor-default">
                                <div class="text-3xl font-bold text-lime-600 mb-1">4</div>
                                <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                                    <i class="fas fa-folder text-lime-500"></i> Kategori
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative Elements -->
                    <div class="absolute -top-6 -right-6 w-28 h-28 bg-emerald-400 rounded-full opacity-30 blur-3xl glow-effect"></div>
                    <div class="absolute -bottom-8 -left-8 w-40 h-40 bg-teal-400 rounded-full opacity-30 blur-3xl glow-effect"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission/Fitur Section with Glassmorphism -->
    <section id="fitur" class="py-20 bg-gradient-to-b from-emerald-50/50 to-white relative">
        <div class="absolute inset-0 glass-section opacity-50"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 reveal">
                <span class="inline-flex items-center px-5 py-2.5 glass-card text-emerald-700 rounded-full text-sm font-semibold mb-4 glow-effect">
                    <i class="fas fa-bullseye mr-2"></i>Fitur Kami
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Mengurangi Limbah dan Emisi Karbon
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Melalui ekonomi sirkular, kami menghubungkan penjual dan pembeli untuk menciptakan dampak positif bagi lingkungan
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 stagger-children">
                <div class="feature-card glass-card p-8 text-center rounded-3xl hover:shadow-2xl hover:scale-105 transition-all duration-500 group">
                    <div class="icon-wrapper w-20 h-20 rounded-2xl gradient-eco mx-auto mb-6 flex items-center justify-center shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 glow-effect">
                        <i class="fas fa-recycle text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Daur Ulang</h3>
                    <p class="text-gray-600">
                        Ubah sampah menjadi produk bernilai. Kulit sapi, plastik, karet - semua bisa diolah!
                    </p>
                    <div class="mt-4 flex items-center justify-center gap-2 glass-badge text-emerald-700 font-semibold px-4 py-2 rounded-full">
                        <i class="fas fa-check-circle"></i>
                        <span>Ramah Lingkungan</span>
                    </div>
                </div>

                <div class="feature-card glass-card p-8 text-center rounded-3xl hover:shadow-2xl hover:scale-105 transition-all duration-500 group">
                    <div class="icon-wrapper w-20 h-20 rounded-2xl gradient-eco mx-auto mb-6 flex items-center justify-center shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 glow-effect">
                        <i class="fas fa-leaf text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Kurangi Emisi</h3>
                    <p class="text-gray-600">
                        Setiap kg yang didaur ulang berarti kg CO2 yang tidak terlepas ke atmosfer
                    </p>
                    <div class="mt-4 flex items-center justify-center gap-2 glass-badge text-emerald-700 font-semibold px-4 py-2 rounded-full">
                        <i class="fas fa-check-circle"></i>
                        <span>CO2 Savings</span>
                    </div>
                </div>

                <div class="feature-card glass-card p-8 text-center rounded-3xl hover:shadow-2xl hover:scale-105 transition-all duration-500 group">
                    <div class="icon-wrapper w-20 h-20 rounded-2xl gradient-eco mx-auto mb-6 flex items-center justify-center shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 glow-effect">
                        <i class="fas fa-gift text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Voucher Karbon</h3>
                    <p class="text-gray-600">
                        Dapat rewards setiap transaksi. Tukar dengan diskon atau donasi植树!
                    </p>
                    <div class="mt-4 flex items-center justify-center gap-2 glass-badge text-emerald-700 font-semibold px-4 py-2 rounded-full">
                        <i class="fas fa-check-circle"></i>
                        <span>Bonus Menarik</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section with Glassmorphism -->
    <section id="kategori" class="py-20 bg-gradient-to-b from-white to-emerald-50/30 relative">
        <div class="absolute inset-0 glass-section opacity-30"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 reveal">
                <span class="inline-flex items-center px-5 py-2.5 glass-card text-emerald-700 rounded-full text-sm font-semibold mb-4 glow-effect">
                    <i class="fas fa-th-large mr-2"></i>Kategori Produk
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Pilihan Kategori Lengkap
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Semua kebutuhan daur ulang Anda dalam satu platform
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Produk Olahan -->
                <div class="category-card glass-card p-6 rounded-2xl cursor-pointer group">
                    <div class="w-16 h-16 rounded-2xl glass flex items-center justify-center mb-4 transition-all duration-300 group-hover:scale-110">
                        <i class="fas fa-recycle text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Produk Olahan</h3>
                    <p class="text-sm text-gray-600 mb-4">Kulit sapi/kambing, kompos, pupuk organik</p>
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center px-3 py-1 glass-badge text-emerald-700 rounded-full text-xs font-semibold">
                            <i class="fas fa-leaf mr-1"></i>0.8 kg CO2/kg
                        </span>
                        <i class="fas fa-arrow-right text-gray-600 transition-transform duration-300 group-hover:translate-x-2"></i>
                    </div>
                </div>

                <!-- Makanan Sisa -->
                <div class="category-card glass-card p-6 rounded-2xl cursor-pointer group">
                    <div class="w-16 h-16 rounded-2xl glass flex items-center justify-center mb-4 transition-all duration-300 group-hover:scale-110">
                        <i class="fas fa-utensils text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Makanan Sisa</h3>
                    <p class="text-sm text-gray-600 mb-4">Nasi sisa, sayur sisa untuk pakan ternak</p>
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center px-3 py-1 glass-badge text-emerald-700 rounded-full text-xs font-semibold">
                            <i class="fas fa-leaf mr-1"></i>0.6 kg CO2/kg
                        </span>
                        <i class="fas fa-arrow-right text-gray-600 transition-transform duration-300 group-hover:translate-x-2"></i>
                    </div>
                </div>

                <!-- Rumput & Pakan -->
                <div class="category-card glass-card p-6 rounded-2xl cursor-pointer group">
                    <div class="w-16 h-16 rounded-2xl glass flex items-center justify-center mb-4 transition-all duration-300 group-hover:scale-110">
                        <i class="fas fa-seedling text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Rumput & Pakan Ternak</h3>
                    <p class="text-sm text-gray-600 mb-4">Rumput gajah, odot, jerami untuk sapi & kambing</p>
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center px-3 py-1 glass-badge text-emerald-700 rounded-full text-xs font-semibold">
                            <i class="fas fa-leaf mr-1"></i>0.45 kg CO2/kg
                        </span>
                        <i class="fas fa-arrow-right text-gray-600 transition-transform duration-300 group-hover:translate-x-2"></i>
                    </div>
                </div>

                <!-- Sampah Daur Ulang -->
                <div class="category-card glass-card p-6 rounded-2xl cursor-pointer group">
                    <div class="w-16 h-16 rounded-2xl glass flex items-center justify-center mb-4 transition-all duration-300 group-hover:scale-110">
                        <i class="fas fa-trash-alt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Sampah Daur Ulang</h3>
                    <p class="text-sm text-gray-600 mb-4">Plastik, karet, kaleng, kardus</p>
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center px-3 py-1 glass-badge text-emerald-700 rounded-full text-xs font-semibold">
                            <i class="fas fa-leaf mr-1"></i>0.35 kg CO2/kg
                        </span>
                        <i class="fas fa-arrow-right text-gray-600 transition-transform duration-300 group-hover:translate-x-2"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pengrajin Section with Glassmorphism -->
    <section id="pengrajin" class="py-20 bg-gradient-to-b from-emerald-50/30 to-white relative">
        <div class="absolute inset-0 glass-section opacity-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 reveal">
                <span class="inline-flex items-center px-5 py-2.5 glass-card text-emerald-700 rounded-full text-sm font-semibold mb-4 glow-effect">
                    <i class="fas fa-hands mr-2"></i>Cerita Pengrajin
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Pengrajin Inspiratif Kami
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Kenali pengrajin-pengrajin kreatif yang mengubah limbah menjadi karya seni bernilai tinggi
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Craft Card 1 -->
                <div class="craft-card glass-card rounded-3xl overflow-hidden group hover:shadow-2xl transition-all duration-500">
                    <div class="relative h-48 bg-gradient-to-br from-amber-100 to-amber-200 overflow-hidden">
                        <div class="craft-image absolute inset-0 flex items-center justify-center">
                            <div class="w-24 h-24 rounded-full glass flex items-center justify-center">
                                <i class="fas fa-hand-holding-heart text-amber-600 text-4xl"></i>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 glass-badge text-white px-3 py-1 rounded-full text-xs font-bold glow-effect">
                            <i class="fas fa-medal mr-1"></i>Top Seller
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <img src="https://ui-avatars.com/api/?name=Pak+Suryo&background=22c55e&color=fff&size=64" alt="Pak Suryo" class="w-12 h-12 rounded-full border-2 border-emerald-200">
                            <div>
                                <h3 class="font-bold text-gray-900">Pak Suryo</h3>
                                <p class="text-sm text-gray-500"><i class="fas fa-map-marker-alt mr-1"></i>Sleman, Yogyakarta</p>
                            </div>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Kerajinan Kulit Sapi</h4>
                        <p class="text-gray-600 text-sm mb-4">
                            Mengubah limbah kulit sapi dari rumah potong menjadi tas, dompet, dan aksesoris berkualitas tinggi. Sudah membantu 15 keluarga di desanya.
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-white/30">
                            <div class="flex items-center gap-2 text-sm">
                                <span class="glass-badge text-emerald-700 px-2 py-1 rounded text-xs font-semibold">2.5 Ton CO2</span>
                                <span class="text-gray-500">dihemat</span>
                            </div>
                            <div class="flex items-center gap-1 text-amber-500">
                                <i class="fas fa-star"></i>
                                <span class="text-sm font-semibold">4.9</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Craft Card 2 -->
                <div class="craft-card glass-card rounded-3xl overflow-hidden group hover:shadow-2xl transition-all duration-500">
                    <div class="relative h-48 bg-gradient-to-br from-green-100 to-green-200 overflow-hidden">
                        <div class="craft-image absolute inset-0 flex items-center justify-center">
                            <div class="w-24 h-24 rounded-full glass flex items-center justify-center">
                                <i class="fas fa-leaf text-green-600 text-4xl"></i>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 glass-badge text-white px-3 py-1 rounded-full text-xs font-bold glow-effect">
                            <i class="fas fa-award mr-1"></i>Eco Warrior
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <img src="https://ui-avatars.com/api/?name=Bu+Ani&background=14b8a6&color=fff&size=64" alt="Bu Ani" class="w-12 h-12 rounded-full border-2 border-teal-200">
                            <div>
                                <h3 class="font-bold text-gray-900">Bu Ani Rohmah</h3>
                                <p class="text-sm text-gray-500"><i class="fas fa-map-marker-alt mr-1"></i>Bandung, Jawa Barat</p>
                            </div>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Kompos & Pupuk Organik</h4>
                        <p class="text-gray-600 text-sm mb-4">
                            Mengubah sisa sayur dan buah pasar menjadi pupuk organik premium. Produknya digunakan oleh ratusan petani organik di Jawa Barat.
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-white/30">
                            <div class="flex items-center gap-2 text-sm">
                                <span class="glass-badge text-emerald-700 px-2 py-1 rounded text-xs font-semibold">5.0 Ton CO2</span>
                                <span class="text-gray-500">dihemat</span>
                            </div>
                            <div class="flex items-center gap-1 text-amber-500">
                                <i class="fas fa-star"></i>
                                <span class="text-sm font-semibold">4.8</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Craft Card 3 -->
                <div class="craft-card glass-card rounded-3xl overflow-hidden group hover:shadow-2xl transition-all duration-500">
                    <div class="relative h-48 bg-gradient-to-br from-blue-100 to-blue-200 overflow-hidden">
                        <div class="craft-image absolute inset-0 flex items-center justify-center">
                            <div class="w-24 h-24 rounded-full glass flex items-center justify-center">
                                <i class="fas fa-recycle text-blue-600 text-4xl"></i>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 glass-badge text-white px-3 py-1 rounded-full text-xs font-bold glow-effect">
                            <i class="fas fa-trending-up mr-1"></i>Rising Star
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <img src="https://ui-avatars.com/api/?name=Mas+Dedi&background=3b82f6&color=fff&size=64" alt="Mas Dedi" class="w-12 h-12 rounded-full border-2 border-blue-200">
                            <div>
                                <h3 class="font-bold text-gray-900">Dedi Kurniawan</h3>
                                <p class="text-sm text-gray-500"><i class="fas fa-map-marker-alt mr-1"></i>Surabaya, Jawa Timur</p>
                            </div>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Kerajinan Plastik Daur Ulang</h4>
                        <p class="text-gray-600 text-sm mb-4">
                            Menemukan cara kreatif mengolah sampah plastik menjadi furnitur dan dekorasi rumah yang unik dan bernilai seni tinggi.
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-white/30">
                            <div class="flex items-center gap-2 text-sm">
                                <span class="glass-badge text-emerald-700 px-2 py-1 rounded text-xs font-semibold">3.8 Ton CO2</span>
                                <span class="text-gray-500">dihemat</span>
                            </div>
                            <div class="flex items-center gap-1 text-amber-500">
                                <i class="fas fa-star"></i>
                                <span class="text-sm font-semibold">4.7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12 reveal">
                <a href="{{ route("register") }}" class="inline-flex items-center gap-2 px-8 py-4 glass-btn text-white font-bold rounded-xl transition-all duration-300">
                    <i class="fas fa-user-plus"></i>
                    Bergabung sebagai Pengrajin
                </a>
            </div>
        </div>
    </section>

    <!-- Mitra Section with Glassmorphism -->
    <section id="mitra" class="py-20 bg-gradient-to-b from-white to-emerald-50/30 relative">
        <div class="absolute inset-0 glass-section opacity-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 reveal">
                <span class="inline-flex items-center px-5 py-2.5 glass-card text-emerald-700 rounded-full text-sm font-semibold mb-4 glow-effect">
                    <i class="fas fa-handshake mr-2"></i>Mitra Kami
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Partner Strategis Eco-Loop
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Bermitra dengan berbagai organisasi untuk memperluas dampak positif kami terhadap lingkungan
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Partner 1 -->
                <div class="partner-card glass-card rounded-2xl p-6 text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-20 h-20 rounded-2xl glass mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-university text-green-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Universitas Gadjah Mada</h3>
                    <p class="text-sm text-gray-500 mb-3">Penelitian & Inovasi Daur Ulang</p>
                    <div class="flex items-center justify-center gap-2">
                        <span class="glass-badge text-blue-600 px-2 py-1 rounded text-xs font-semibold">Akademik</span>
                    </div>
                </div>

                <!-- Partner 2 -->
                <div class="partner-card glass-card rounded-2xl p-6 text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-20 h-20 rounded-2xl glass mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-store text-amber-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Pasar Induk Sleman</h3>
                    <p class="text-sm text-gray-500 mb-3">Sumber Limbah Sayur & Buah</p>
                    <div class="flex items-center justify-center gap-2">
                        <span class="glass-badge text-orange-600 px-2 py-1 rounded text-xs font-semibold">Pasar</span>
                    </div>
                </div>

                <!-- Partner 3 -->
                <div class="partner-card glass-card rounded-2xl p-6 text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-20 h-20 rounded-2xl glass mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-warehouse text-purple-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">RPH Yogyakarta</h3>
                    <p class="text-sm text-gray-500 mb-3">Limbah Kulit Hewan</p>
                    <div class="flex items-center justify-center gap-2">
                        <span class="glass-badge text-red-600 px-2 py-1 rounded text-xs font-semibold">Peternakan</span>
                    </div>
                </div>

                <!-- Partner 4 -->
                <div class="partner-card glass-card rounded-2xl p-6 text-center group hover:shadow-xl transition-all duration-300">
                    <div class="w-20 h-20 rounded-2xl glass mx-auto mb-4 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-building text-teal-600 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">DLH Kota Yogyakarta</h3>
                    <p class="text-sm text-gray-500 mb-3">Dukungan Pemerintah Daerah</p>
                    <div class="flex items-center justify-center gap-2">
                        <span class="glass-badge text-teal-600 px-2 py-1 rounded text-xs font-semibold">Government</span>
                    </div>
                </div>
            </div>

            <!-- Partner Stats -->
            <div class="glass-eco rounded-3xl p-8 reveal glow-effect">
                <div class="grid md:grid-cols-4 gap-8 text-center">
                    <div>
                        <div class="text-4xl font-bold mb-2 text-emerald-800">25+</div>
                        <div class="text-emerald-700/80">Mitra Pasar</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold mb-2 text-emerald-800">10+</div>
                        <div class="text-emerald-700/80">Institusi Akademik</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold mb-2 text-emerald-800">15+</div>
                        <div class="text-emerald-700/80">Organisasi Pemerintah</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold mb-2 text-emerald-800">50+</div>
                        <div class="text-emerald-700/80">Peternakan Mitra</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Section with Glassmorphism -->
    <section id="produk" class="py-20 bg-gradient-to-b from-emerald-50/30 to-white relative">
        <div class="absolute inset-0 glass-section opacity-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 reveal">
                <span class="inline-flex items-center px-5 py-2.5 glass-card text-emerald-700 rounded-full text-sm font-semibold mb-4 glow-effect">
                    <i class="fas fa-box mr-2"></i>Produk Unggulan
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Produk Daur Ulang Pilihan
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Pilihan produk berkualitas tinggi yang dibuat dari bahan daur ulang
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Product 1 -->
                <div class="glass-card rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 group">
                    <div class="relative h-48 bg-gradient-to-br from-amber-100 to-amber-200">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-briefcase text-amber-600 text-6xl opacity-50"></i>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span class="glass-badge text-white px-3 py-1 rounded-full text-xs font-bold glow-effect">
                                <i class="fas fa-fire mr-1"></i>Terlaris
                            </span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <img src="https://ui-avatars.com/api/?name=Pak+Suryo&background=22c55e&color=fff&size=32" alt="Seller" class="w-6 h-6 rounded-full border border-emerald-200">
                            <span class="text-xs text-gray-500">Pak Suryo</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Tas Kulit Sapi Premium</h3>
                        <p class="text-sm text-gray-500 mb-3 line-clamp-2">Tas kulit asli dari limbah sapi pilihan, tahan lama dan stylish</p>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="glass-badge text-emerald-700 px-2 py-1 rounded text-xs font-semibold">
                                <i class="fas fa-leaf mr-1"></i>2.5 kg CO2
                            </span>
                            <span class="text-yellow-500 text-xs">
                                <i class="fas fa-star"></i> 4.9
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-emerald-600">Rp 450.000</span>
                            <button class="px-4 py-2 glass-btn text-white rounded-lg text-sm font-semibold transition-colors">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="glass-card rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 group">
                    <div class="relative h-48 bg-gradient-to-br from-green-100 to-green-200">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-seedling text-green-600 text-6xl opacity-50"></i>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span class="glass-badge text-white px-3 py-1 rounded-full text-xs font-bold glow-effect">
                                <i class="fas fa-sparkles mr-1"></i>Baru
                            </span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <img src="https://ui-avatars.com/api/?name=Bu+Ani&background=14b8a6&color=fff&size=32" alt="Seller" class="w-6 h-6 rounded-full border border-teal-200">
                            <span class="text-xs text-gray-500">Bu Ani</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Pupuk Organik Cair 5L</h3>
                        <p class="text-sm text-gray-500 mb-3 line-clamp-2">Pupuk cair premium dari Limbah sayur dan buah pasar</p>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="glass-badge text-emerald-700 px-2 py-1 rounded text-xs font-semibold">
                                <i class="fas fa-leaf mr-1"></i>3.0 kg CO2
                            </span>
                            <span class="text-yellow-500 text-xs">
                                <i class="fas fa-star"></i> 4.8
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-emerald-600">Rp 75.000</span>
                            <button class="px-4 py-2 glass-btn text-white rounded-lg text-sm font-semibold transition-colors">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="glass-card rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 group">
                    <div class="relative h-48 bg-gradient-to-br from-orange-100 to-orange-200">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-carrot text-orange-600 text-6xl opacity-50"></i>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <img src="https://ui-avatars.com/api/?name=Ibu+Sari&background=f59e0b&color=fff&size=32" alt="Seller" class="w-6 h-6 rounded-full border border-amber-200">
                            <span class="text-xs text-gray-500">Ibu Sari</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Sayur Sisa Pasar 10kg</h3>
                        <p class="text-sm text-gray-500 mb-3 line-clamp-2">Sayuran sisa layak konsumsi untuk pakan ternak</p>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="glass-badge text-emerald-700 px-2 py-1 rounded text-xs font-semibold">
                                <i class="fas fa-leaf mr-1"></i>4.0 kg CO2
                            </span>
                            <span class="text-yellow-500 text-xs">
                                <i class="fas fa-star"></i> 4.6
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-emerald-600">Rp 50.000</span>
                            <button class="px-4 py-2 glass-btn text-white rounded-lg text-sm font-semibold transition-colors">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="glass-card rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 group">
                    <div class="relative h-48 bg-gradient-to-br from-blue-100 to-blue-200">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-chair text-blue-600 text-6xl opacity-50"></i>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span class="glass-badge text-white px-3 py-1 rounded-full text-xs font-bold glow-effect">
                                <i class="fas fa-rocket mr-1"></i>Trending
                            </span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <img src="https://ui-avatars.com/api/?name=Mas+Dedi&background=3b82f6&color=fff&size=32" alt="Seller" class="w-6 h-6 rounded-full border border-blue-200">
                            <span class="text-xs text-gray-500">Mas Dedi</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Kursi Plastik Daur Ulang</h3>
                        <p class="text-sm text-gray-500 mb-3 line-clamp-2">Kursi kokoh dari ratusan plastik daur ulang</p>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="glass-badge text-emerald-700 px-2 py-1 rounded text-xs font-semibold">
                                <i class="fas fa-leaf mr-1"></i>5.5 kg CO2
                            </span>
                            <span class="text-yellow-500 text-xs">
                                <i class="fas fa-star"></i> 4.7
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-emerald-600">Rp 250.000</span>
                            <button class="px-4 py-2 glass-btn text-white rounded-lg text-sm font-semibold transition-colors">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12 reveal">
                <a href="{{ route("products.index") }}" class="inline-flex items-center gap-2 px-8 py-4 glass-card border-2 border-emerald-300 text-emerald-700 font-bold rounded-xl hover:bg-emerald-50 transition-all duration-300">
                    <i class="fas fa-th-large"></i>
                    Lihat Semua Produk
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Lokasi Setor Sampah Section -->
    <section id="lokasi" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <span class="inline-flex items-center px-4 py-2 bg-green-100 text-emerald-600 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-map-marker-alt mr-2"></i>Lokasi Setor Sampah
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Titik Penampungan Terdekat
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Temukan lokasi terdekat untuk menjual limbah Anda atau ketahui di mana kami beroperasi
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Location 1 -->
                <div class="location-card bg-white rounded-xl p-6 shadow-md border-2 border-transparent">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-building text-emerald-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">Bank Sampah Induk Sleman</h3>
                            <p class="text-sm text-gray-500 flex items-center gap-1">
                                <i class="fas fa-map-marker-alt"></i>
                                Jl. Solo No. 42, Sleman, Yogyakarta
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-amber-100 text-amber-700 px-2 py-1 rounded text-xs font-semibold">
                            <i class="fas fa-clock mr-1"></i>08:00 - 17:00
                        </span>
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-semibold">
                            <i class="fas fa-truck mr-1"></i>Pickup
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        Menerima berbagai jenis limbah: plastik, kertas, kardus, logam. Memiliki fasilitas sortasi dan pengolahan mandiri.
                    </p>
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="text-sm">
                            <span class="text-gray-500">Kapasitas:</span>
                            <span class="font-bold text-emerald-600 ml-1">500 kg/hari</span>
                        </div>
                        <a href="#" class="px-4 py-2 bg-eco-green text-white rounded-lg text-sm font-semibold hover:bg-emerald-600 transition-colors">
                            <i class="fas fa-directions mr-1"></i>Petunjuk
                        </a>
                    </div>
                </div>

                <!-- Location 2 -->
                <div class="location-card bg-white rounded-xl p-6 shadow-md border-2 border-transparent">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-14 h-14 rounded-xl bg-teal-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-store text-teal-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">Posko Eco-Loop UGM</h3>
                            <p class="text-sm text-gray-500 flex items-center gap-1">
                                <i class="fas fa-map-marker-alt"></i>
                                Kampus UGM, Bulaksumur, Yogyakarta
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-amber-100 text-amber-700 px-2 py-1 rounded text-xs font-semibold">
                            <i class="fas fa-clock mr-1"></i>07:00 - 20:00
                        </span>
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">
                            <i class="fas fa-graduation-cap mr-1"></i>Kampus
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        Kolaborasi dengan Universitas Gadjah Mada. Fokus pada limbah laboratorium dan riset daur ulang.
                    </p>
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="text-sm">
                            <span class="text-gray-500">Kapasitas:</span>
                            <span class="font-bold text-emerald-600 ml-1">300 kg/hari</span>
                        </div>
                        <a href="#" class="px-4 py-2 bg-eco-green text-white rounded-lg text-sm font-semibold hover:bg-emerald-600 transition-colors">
                            <i class="fas fa-directions mr-1"></i>Petunjuk
                        </a>
                    </div>
                </div>

                <!-- Location 3 -->
                <div class="location-card bg-white rounded-xl p-6 shadow-md border-2 border-transparent">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-14 h-14 rounded-xl bg-orange-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-utensils text-orange-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">Sentra Limbah Pasar Beringharjo</h3>
                            <p class="text-sm text-gray-500 flex items-center gap-1">
                                <i class="fas fa-map-marker-alt"></i>
                                Pasar Beringharjo, Malioboro, Yogyakarta
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-amber-100 text-amber-700 px-2 py-1 rounded text-xs font-semibold">
                            <i class="fas fa-clock mr-1"></i>04:00 - 10:00
                        </span>
                        <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs font-semibold">
                            <i class="fas fa-apple-alt mr-1"></i>Sayur & Buah
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                       歧取 dari limbah sayur dan buah segar pasar tradisional. Langsung diolah menjadi pakan ternak dan kompos.
                    </p>
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="text-sm">
                            <span class="text-gray-500">Kapasitas:</span>
                            <span class="font-bold text-emerald-600 ml-1">1 Ton/hari</span>
                        </div>
                        <a href="#" class="px-4 py-2 bg-eco-green text-white rounded-lg text-sm font-semibold hover:bg-emerald-600 transition-colors">
                            <i class="fas fa-directions mr-1"></i>Petunjuk
                        </a>
                    </div>
                </div>

                <!-- Location 4 -->
                <div class="location-card bg-white rounded-xl p-6 shadow-md border-2 border-transparent">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-warehouse text-red-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">Gudang Limbah Kulit RPH</h3>
                            <p class="text-sm text-gray-500 flex items-center gap-1">
                                <i class="fas fa-map-marker-alt"></i>
                                Kawasan RPH Giwangan, Yogyakarta
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-amber-100 text-amber-700 px-2 py-1 rounded text-xs font-semibold">
                            <i class="fas fa-clock mr-1"></i>06:00 - 14:00
                        </span>
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-semibold">
                            <i class="fas fa-drumstick-bite mr-1"></i>Kulit Hewan
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        Pengolahan limbah kulit sapi dan kambing dari rumah potong hewan. Bahan baku kerajinan berkualitas.
                    </p>
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="text-sm">
                            <span class="text-gray-500">Kapasitas:</span>
                            <span class="font-bold text-emerald-600 ml-1">200 kg/hari</span>
                        </div>
                        <a href="#" class="px-4 py-2 bg-eco-green text-white rounded-lg text-sm font-semibold hover:bg-emerald-600 transition-colors">
                            <i class="fas fa-directions mr-1"></i>Petunjuk
                        </a>
                    </div>
                </div>

                <!-- Location 5 -->
                <div class="location-card bg-white rounded-xl p-6 shadow-md border-2 border-transparent">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-industry text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">Pusat Daur Ulang Plastik</h3>
                            <p class="text-sm text-gray-500 flex items-center gap-1">
                                <i class="fas fa-map-marker-alt"></i>
                                JL.尚书, Rewulu, Sleman
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-amber-100 text-amber-700 px-2 py-1 rounded text-xs font-semibold">
                            <i class="fas fa-clock mr-1"></i>08:00 - 16:00
                        </span>
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-semibold">
                            <i class="fas fa-wine-bottle mr-1"></i>Plastik
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        전용 facility untuk daur ulang plastik berbagai jenis. Menghasilkan granul plastik untuk industri.
                    </p>
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="text-sm">
                            <span class="text-gray-500">Kapasitas:</span>
                            <span class="font-bold text-emerald-600 ml-1">2 Ton/hari</span>
                        </div>
                        <a href="#" class="px-4 py-2 bg-eco-green text-white rounded-lg text-sm font-semibold hover:bg-emerald-600 transition-colors">
                            <i class="fas fa-directions mr-1"></i>Petunjuk
                        </a>
                    </div>
                </div>

                <!-- Location 6 - Add New -->
                <div class="location-card bg-white rounded-xl p-6 shadow-md border-2 border-dashed border-emerald-300 flex flex-col items-center justify-center text-center hover:border-emerald-500 transition-colors">
                    <div class="w-14 h-14 rounded-xl bg-emerald-50 flex items-center justify-center mb-4">
                        <i class="fas fa-plus text-emerald-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-2">Jadi Mitra Kami</h3>
                    <p class="text-sm text-gray-500 mb-4">
                        Punya lokasi yang bisa menjadi titik penampungan?
                    </p>
                    <a href="{{ route("register") }}" class="px-6 py-2 bg-eco-green text-white rounded-lg text-sm font-semibold hover:bg-emerald-600 transition-colors">
                        <i class="fas fa-handshake mr-1"></i>Daftar Mitra
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works / Cara Kerja Section with Glassmorphism -->
    <section id="cara-kerja" class="py-20 bg-gradient-to-b from-white to-emerald-50/30 relative">
        <div class="absolute inset-0 glass-section opacity-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 reveal">
                <span class="inline-flex items-center px-5 py-2.5 glass-card text-emerald-700 rounded-full text-sm font-semibold mb-4 glow-effect">
                    <i class="fas fa-cogs mr-2"></i>Cara Kerja
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Bergabung Mudah, Berontribusi Nyata
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Empat langkah sederhana untuk mulai berkontribusi menjaga bumi
                </p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <div class="step-card text-center relative">
                    <div class="step-number w-20 h-20 rounded-2xl gradient-eco mx-auto mb-6 flex items-center justify-center shadow-xl glow-effect">
                        <span class="text-2xl font-bold text-white">1</span>
                    </div>
                    <div class="hidden md:block absolute top-10 left-[60%] w-[80%] h-1 glass-eco rounded"></div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Daftar</h3>
                    <p class="text-sm text-gray-600">Pilih sebagai Pembeli atau Penjual</p>
                    <div class="mt-3">
                        <i class="fas fa-user-plus text-emerald-600 text-xl"></i>
                    </div>
                </div>

                <div class="step-card text-center relative">
                    <div class="step-number w-20 h-20 rounded-2xl gradient-eco mx-auto mb-6 flex items-center justify-center shadow-xl glow-effect">
                        <span class="text-2xl font-bold text-white">2</span>
                    </div>
                    <div class="hidden md:block absolute top-10 left-[60%] w-[80%] h-1 glass-eco rounded"></div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Jual/Beli</h3>
                    <p class="text-sm text-gray-600">Transaksi barang daur ulang</p>
                    <div class="mt-3">
                        <i class="fas fa-shopping-cart text-emerald-600 text-xl"></i>
                    </div>
                </div>

                <div class="step-card text-center relative">
                    <div class="step-number w-20 h-20 rounded-2xl gradient-eco mx-auto mb-6 flex items-center justify-center shadow-xl glow-effect">
                        <span class="text-2xl font-bold text-white">3</span>
                    </div>
                    <div class="hidden md:block absolute top-10 left-[60%] w-[80%] h-1 glass-eco rounded"></div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Hitung Karbon</h3>
                    <p class="text-sm text-gray-600">Sistem hitung otomatis</p>
                    <div class="mt-3">
                        <i class="fas fa-calculator text-emerald-600 text-xl"></i>
                    </div>
                </div>

                <div class="step-card text-center">
                    <div class="step-number w-20 h-20 rounded-2xl gradient-eco mx-auto mb-6 flex items-center justify-center shadow-xl glow-effect">
                        <span class="text-2xl font-bold text-white">4</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Dapat Reward</h3>
                    <p class="text-sm text-gray-600">Voucher karbon untuk hadiah</p>
                    <div class="mt-3">
                        <i class="fas fa-gift text-emerald-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-8">
                <h2 class="text-4xl font-black text-gray-900 tracking-tight">Rumus Utama</h2>

                <p class="text-2xl md:text-3xl text-gray-700 font-medium leading-relaxed">
                    Untuk menghitung jumlah pohon yang dibutuhkan dalam satu tahun:
                </p>

                <div class="overflow-x-auto">
                    <div class="min-w-max">
                        <p class="text-3xl md:text-4xl font-medium text-gray-800 whitespace-nowrap py-3">
                            Jumlah Pohon = <span class="inline-block align-baseline border-b-2 border-gray-700 pb-1">Total Emisi CO₂ (kg)</span>
                            <span class="mx-4 text-2xl">/</span>
                            <span class="inline-block align-baseline border-b-2 border-gray-700 pb-1">Daya Serap Rata-rata 1 Pohon Per Tahun (kg)</span>
                        </p>
                    </div>
                </div>

                <div class="space-y-6 pt-6">
                    <h3 class="text-4xl font-black text-gray-900 tracking-tight">Angka Standar yang Digunakan</h3>

                    <ul class="space-y-4 text-xl md:text-2xl text-gray-700 leading-relaxed list-disc pl-8">
                        <li>
                            22 kg CO₂ per tahun: Daya serap rata-rata satu pohon dewasa menurut data umum
                            (seperti IPCC dan Arbor Day Foundation).
                        </li>
                        <li>
                            0,06 kg CO₂ per hari: Daya serap satu pohon jika dihitung harian (22 kg ÷ 365 hari).
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Voucher Karbon Section with Glassmorphism -->
    <section id="voucher-karbon" class="py-20 animated-gradient relative overflow-hidden">
        <div class="absolute inset-0 glass-section z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 reveal">
                <span class="inline-flex items-center px-5 py-2.5 glass text-white/90 rounded-full text-sm font-semibold mb-4 glow-effect">
                    <i class="fas fa-ticket mr-2"></i>Reward Kami
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Voucher Karbon
                </h2>
                <p class="text-white/80 max-w-2xl mx-auto text-lg">
                    Setiap transaksi yang Anda lakukan akan dihitung pengurangan karbonnya dan dapatkan Voucher sebagai reward!
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6 lg:gap-8">
                <!-- Left Column: Bronze & Silver -->
                <div class="space-y-6 lg:gap-8">
                    <!-- Voucher Bronze -->
                    <div class="glass-card rounded-3xl p-6 md:p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border-2 border-amber-300/50">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 md:w-16 md:h-16 rounded-2xl glass flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-seedling text-amber-600 text-2xl md:text-3xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="text-xl font-bold text-gray-800">Bronze</h3>
                                    <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold">0-10 kg CO2</span>
                                </div>
                                <div class="mb-4">
                                    <span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-amber-100 to-amber-200 text-amber-700 rounded-full text-sm font-bold">
                                        <i class="fas fa-percent mr-2"></i>Diskon 5%
                                    </span>
                                </div>
                                <ul class="space-y-2 text-gray-600 text-sm">
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-emerald-500"></i>
                                        <span>Voucher Belanja</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-emerald-500"></i>
                                        <span>Badge Bronze</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-emerald-500"></i>
                                        <span>Akses Promo Spesial</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Voucher Silver -->
                    <div class="glass-card rounded-3xl p-6 md:p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border-2 border-gray-300/50 relative">
                        <div class="absolute -top-3 left-4 md:left-6">
                            <span class="px-3 py-1 bg-gradient-to-r from-gray-400 to-gray-500 text-white px-4 py-1 rounded-full text-xs font-bold shadow-lg">
                                POPULER
                            </span>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 md:w-16 md:h-16 rounded-2xl glass flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-leaf text-gray-700 text-2xl md:text-3xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="text-xl font-bold text-gray-800">Silver</h3>
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold">10-50 kg CO2</span>
                                </div>
                                <div class="mb-4">
                                    <span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 rounded-full text-sm font-bold">
                                        <i class="fas fa-percent mr-2"></i>Diskon 15%
                                    </span>
                                </div>
                                <ul class="space-y-2 text-gray-600 text-sm">
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-emerald-500"></i>
                                        <span>Semua Benefit Bronze</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-emerald-500"></i>
                                        <span>Badge Silver</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-emerald-500"></i>
                                        <span>Free Ongkir x3</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Gold -->
                <div>
                    <!-- Voucher Gold -->
                    <div class="glass-card rounded-3xl p-6 md:p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border-2 border-yellow-400/50 h-full">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 md:w-16 md:h-16 rounded-2xl bg-gradient-to-br from-yellow-300 to-amber-500 flex items-center justify-center flex-shrink-0 shadow-lg">
                                <i class="fas fa-award text-white text-2xl md:text-3xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="text-xl font-bold text-gray-800">Gold</h3>
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">50+ kg CO2</span>
                                </div>
                                <div class="mb-4">
                                    <span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-yellow-200 to-amber-200 text-yellow-700 rounded-full text-sm font-bold">
                                        <i class="fas fa-percent mr-2"></i>Diskon 25%
                                    </span>
                                </div>
                                <ul class="space-y-2 text-gray-600 text-sm mb-4">
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-emerald-500"></i>
                                        <span>Semua Benefit Silver</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-emerald-500"></i>
                                        <span>Badge Gold Eksklusif</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-emerald-500"></i>
                                        <span>Free Ongkir Unlimited</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-emerald-500"></i>
                                        <span>Donasi Tree Planting</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section with Glassmorphism -->
    <section class="py-20 animated-gradient relative overflow-hidden">
        <!-- Glass Overlay -->
        <div class="absolute inset-0 glass z-0"></div>

        <!-- Decorative -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/4 w-72 h-72 bg-white/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                <i class="fas fa-hands-helping mr-3"></i>
                Siap Bergabung dalam Gerakan Ramah Lingkungan?
            </h2>
            <p class="text-white/90 text-lg mb-8 max-w-2xl mx-auto">
                Ribuan pengguna sudah berkontribusi mengurangi jejak karbon. Bergabunglah sekarang dan jadilah bagian dari perubahan!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route("register") }}" class="cta-btn glass inline-flex items-center justify-center px-10 py-4 text-emerald-700 font-bold rounded-xl shadow-2xl hover:shadow-3xl">
                    <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang - Gratis!
                </a>
            </div>

            <!-- Trust Badges -->
            <div class="mt-10 flex flex-wrap justify-center gap-6">
                <div class="flex items-center gap-2 glass px-4 py-2 rounded-full">
                    <i class="fas fa-shield-alt text-xl text-white"></i>
                    <span class="text-white/90">100% Aman</span>
                </div>
                <div class="flex items-center gap-2 glass px-4 py-2 rounded-full">
                    <i class="fas fa-clock text-xl text-white"></i>
                    <span class="text-white/90">Proses Cepat</span>
                </div>
                <div class="flex items-center gap-2 glass px-4 py-2 rounded-full">
                    <i class="fas fa-headset text-xl text-white"></i>
                    <span class="text-white/90">Support 24/7</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer with Glassmorphism -->
    <footer class="glass-nav text-white py-12 pb-8 relative z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 md:gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 rounded-xl gradient-eco flex items-center justify-center glow-effect">
                            <i class="fas fa-leaf text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold text-white">Eco-Loop</span>
                    </div>
                    <p class="text-white/70 max-w-md mb-4">
                        Platform jual-beli barang daur ulang, sisa makanan, dan rumput pakan ternak.
                        Setiap transaksi mengurangi emisi karbon dan mendapat Voucher Karbon!
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-lg glass flex items-center justify-center hover:bg-emerald-500/30 transition-colors duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-lg glass flex items-center justify-center hover:bg-emerald-500/30 transition-colors duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-lg glass flex items-center justify-center hover:bg-emerald-500/30 transition-colors duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold mb-4 flex items-center gap-2 text-white">
                        <i class="fas fa-list text-emerald-400"></i>Menu
                    </h4>
                    <ul class="space-y-3 text-white/60">
                        <li>
                            <a href="{{ route("products.index") }}" class="hover:text-emerald-400 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                                <i class="fas fa-chevron-right text-xs text-emerald-400"></i>Katalog Produk
                            </a>
                        </li>
                        <li>
                            <a href="{{ route("leaderboard") }}" class="hover:text-emerald-400 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                                <i class="fas fa-chevron-right text-xs text-emerald-400"></i>Peringkat
                            </a>
                        </li>
                        <li>
                            <a href="{{ route("eco-shop") }}" class="hover:text-emerald-400 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                                <i class="fas fa-chevron-right text-xs text-emerald-400"></i>Eco-Shop
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4 flex items-center gap-2 text-white">
                        <i class="fas fa-folder text-emerald-400"></i>Kategori
                    </h4>
                    <ul class="space-y-3 text-white/60">
                        <li>
                            <a href="{{ route("products.index", ["category" => "produk-olahan"]) }}" class="hover:text-emerald-400 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                                <i class="fas fa-chevron-right text-xs text-emerald-400"></i>Produk Olahan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route("products.index", ["category" => "makanan-sisa"]) }}" class="hover:text-emerald-400 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                                <i class="fas fa-chevron-right text-xs text-emerald-400"></i>Makanan Sisa
                            </a>
                        </li>
                        <li>
                            <a href="{{ route("products.index", ["category" => "rumput-pakan"]) }}" class="hover:text-emerald-400 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                                <i class="fas fa-chevron-right text-xs text-emerald-400"></i>Rumput & Pakan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route("products.index", ["category" => "sampah-daur-ulang"]) }}" class="hover:text-emerald-400 hover:translate-x-2 transition-all duration-300 inline-flex items-center gap-2">
                                <i class="fas fa-chevron-right text-xs text-emerald-400"></i>Sampah Daur Ulang
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/20 pt-6 text-center">
                <p class="text-white/50 text-sm">
                    &copy; {{ date("Y") }} Eco-Loop Marketplace.
                    <span class="text-emerald-400 font-medium">Tim Hanchou Sanchou - Innoventure Chapter II 2026</span>
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Scroll Reveal Animation
        const revealElements = document.querySelectorAll(".reveal");

        const revealOnScroll = () => {
            revealElements.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (elementTop < windowHeight - 100) {
                    el.classList.add("visible");
                }
            });
        };

        window.addEventListener("scroll", revealOnScroll);
        window.addEventListener("load", revealOnScroll);

        // Navbar scroll effect
        const navbar = document.getElementById("navbar");
        window.addEventListener("scroll", () => {
            if (window.scrollY > 50) {
                navbar.classList.add("navbar-scrolled");
            } else {
                navbar.classList.remove("navbar-scrolled");
            }
        });

        // Mobile menu
        const mobileMenuBtn = document.getElementById("mobileMenuBtn");
        const mobileMenu = document.getElementById("mobileMenu");
        const closeMobileMenu = document.getElementById("closeMobileMenu");

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener("click", () => {
                mobileMenu.classList.add("active");
            });
        }

        if (closeMobileMenu && mobileMenu) {
            closeMobileMenu.addEventListener("click", () => {
                mobileMenu.classList.remove("active");
            });
        }

        // Close mobile menu on link click
        if (mobileMenu) {
            mobileMenu.querySelectorAll("a").forEach(link => {
                link.addEventListener("click", () => {
                    mobileMenu.classList.remove("active");
                });
            });
        }

        // Smooth scroll for anchor links
        document.querySelectorAll("a[href^="#"]").forEach(anchor => {
            anchor.addEventListener("click", function(e) {
                e.preventDefault();
                const targetId = this.getAttribute("href");
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    const offsetTop = targetElement.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: "smooth"
                    });
                }
            });
        });
    </script>
</body>
</html>
