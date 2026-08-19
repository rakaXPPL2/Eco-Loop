<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Masuk - Eco-Loop</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50">
    <div class="w-full max-w-md p-6">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3">
                <div class="w-14 h-14 rounded-full gradient-eco flex items-center justify-center shadow-lg">
                    <i class="fas fa-leaf text-white text-2xl"></i>
                </div>
                <span class="text-3xl font-bold text-gradient-eco">Eco-Loop</span>
            </a>
            <p class="text-gray-500 mt-2">Masuk ke akun Anda</p>
        </div>

        <!-- Login Card -->
        <div class="card-eco p-8">
            @if(session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="input-eco" placeholder="nama@email.com">
                    @if($errors->get('email'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->get('email')[0] }}</p>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="input-eco" placeholder="••••••••">
                    @if($errors->get('password'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->get('password')[0] }}</p>
                    @endif
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-eco-green focus:ring-eco-green">
                        <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-eco-green hover:text-eco-green-dark">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-eco w-full py-3 text-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                </button>
            </form>

            <div class="mt-6 p-4 bg-eco-cream rounded-lg">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-info-circle text-eco-green mr-1"></i>
                    <strong>Demo:</strong><br>
                    Admin: admin@eco-loop.id<br>
                    Penjual: hadi@example.com<br>
                    Pembeli: andi@example.com<br>
                    Password: password
                </p>
            </div>

            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-eco-green hover:text-eco-green-dark font-semibold">
                        Daftar di sini
                    </a>
                </p>
            </div>

            <div class="mt-4 pt-4 border-t border-gray-100 text-center">
                <a href="/" class="text-gray-500 hover:text-eco-green text-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
