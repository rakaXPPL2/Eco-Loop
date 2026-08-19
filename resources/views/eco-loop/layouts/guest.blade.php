<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Eco-Loop Marketplace' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-emerald-500 via-green-500 to-teal-500 p-4">
    <!-- Background Decoration -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-white/5 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo -->
        <div class="text-center mb-6 sm:mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                <div class="w-18 h-18 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-2xl border-2 border-white/30">
                    <i class="fas fa-leaf text-white text-4xl sm:text-3xl"></i>
                </div>
                <span class="text-4xl sm:text-3xl font-bold text-white drop-shadow-lg">Eco-Loop</span>
            </a>
            <p class="text-white/90 mt-4 text-lg sm:text-base font-medium">
                <i class="fas fa-earth-americas mr-2"></i>
                Kurangi Jejak Karbon Bersama
            </p>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-3xl shadow-2xl p-6 sm:p-8 border-2 border-white/20">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <p class="text-center text-white/80 text-sm mt-6 font-medium">
            <i class="fas fa-leaf mr-1"></i>
            &copy; {{ date('Y') }} Eco-Loop Marketplace
        </p>
    </div>
</body>
</html>
