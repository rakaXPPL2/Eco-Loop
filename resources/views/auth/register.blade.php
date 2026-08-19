<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Daftar - Eco-Loop</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50">
    <!-- Header -->
    <header class="bg-white/95 backdrop-blur-sm shadow-sm py-4">
        <div class="max-w-7xl mx-auto px-4">
            <a href="/" class="inline-flex items-center gap-2">
                <div class="w-10 h-10 rounded-full gradient-eco flex items-center justify-center">
                    <i class="fas fa-leaf text-white text-lg"></i>
                </div>
                <span class="text-xl font-bold text-gradient-eco">Eco-Loop</span>
            </a>
        </div>
    </header>

    <div class="py-8 px-4">
        <div class="max-w-lg mx-auto">
            <!-- Title -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Baru</h1>
                <p class="text-gray-600">Bergabung dengan gerakan ramah lingkungan</p>
            </div>

            <!-- Register Card -->
            <div class="card-eco p-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Role Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Daftar sebagai:</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="buyer" class="peer sr-only" {{ old('role') == 'buyer' ? 'checked' : '' }} required>
                                <div class="p-4 border-2 rounded-xl transition-all peer-checked:border-eco-green peer-checked:bg-eco-green-light/30">
                                    <div class="w-12 h-12 rounded-full bg-blue-100 mx-auto mb-3 flex items-center justify-center">
                                        <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-semibold text-gray-800">Pembeli</div>
                                        <div class="text-xs text-gray-500">Beli produk daur ulang</div>
                                    </div>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="seller" class="peer sr-only" {{ old('role') == 'seller' ? 'checked' : '' }}>
                                <div class="p-4 border-2 rounded-xl transition-all peer-checked:border-eco-green peer-checked:bg-eco-green-light/30">
                                    <div class="w-12 h-12 rounded-full bg-eco-green-light mx-auto mb-3 flex items-center justify-center">
                                        <i class="fas fa-store text-eco-green text-xl"></i>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-semibold text-gray-800">Penjual</div>
                                        <div class="text-xs text-gray-500">Jual produk daur ulang</div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @if($errors->get('role'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->get('role')[0] }}</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                               class="input-eco" placeholder="Masukkan nama Anda">
                        @if($errors->get('name'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->get('name')[0] }}</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                               class="input-eco" placeholder="nama@email.com">
                        @if($errors->get('email'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->get('email')[0] }}</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" autocomplete="tel"
                                   class="input-eco" placeholder="08xxxxxxxxxx">
                        </div>
                        <div>
                            <label for="region" class="block text-sm font-medium text-gray-700 mb-1">Kota/Daerah</label>
                            <input id="region" type="text" name="region" value="{{ old('region') }}" autocomplete="address-level1"
                                   class="input-eco" placeholder="Jakarta">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="input-eco" placeholder="Minimal 8 karakter">
                        @if($errors->get('password'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->get('password')[0] }}</p>
                        @endif
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                               class="input-eco" placeholder="Ulangi password">
                        @if($errors->get('password_confirmation'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->get('password_confirmation')[0] }}</p>
                        @endif
                    </div>

                    <button type="submit" class="btn-eco w-full py-3 text-lg">
                        <i class="fas fa-user-plus mr-2"></i> Daftar
                    </button>
                </form>

                <div class="mt-4 p-4 bg-eco-cream rounded-lg">
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-leaf text-eco-green mr-1"></i>
                        Dengan mendaftar, Anda bergabung dalam gerakan ramah lingkungan dan membantu mengurangi jejak karbon!
                    </p>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-eco-green hover:text-eco-green-dark font-semibold">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </div>

            <div class="mt-4 text-center">
                <a href="/" class="text-gray-500 hover:text-eco-green text-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
