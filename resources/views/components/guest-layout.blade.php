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

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Left Side - Branding & Info -->
        <div class="hidden lg:flex lg:w-1/2 gradient-eco relative overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 flex flex-col justify-center px-16 text-white">
                <!-- Logo -->
                <div class="flex items-center gap-4 mb-12">
                    <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <i class="fas fa-leaf text-3xl"></i>
                    </div>
                    <span class="text-4xl font-bold">Eco-Loop</span>
                </div>

                <h1 class="text-5xl font-bold leading-tight mb-6">
                    Kurangi Jejak Karbon<br>Bersama Kami
                </h1>

                <p class="text-xl text-white/80 mb-12 max-w-lg">
                    Platform jual-beli barang bekas, rumput, dan sisa makanan.
                    Setiap transaksi mengurangi emisi karbon dan mendapat Voucher Karbon!
                </p>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="text-4xl font-bold">{{ \App\Models\User::count() }}+</div>
                        <div class="text-white/70">Pengguna</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold">{{ number_format(\App\Models\User::sum('total_carbon_saved'), 0) }}+</div>
                        <div class="text-white/70">kg CO2</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold">{{ \App\Models\Product::count() }}+</div>
                        <div class="text-white/70">Produk</div>
                    </div>
                </div>

                <!-- Features -->
                <div class="mt-12 space-y-4">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-xl"></i>
                        <span>Jual-beli barang bekas berkualitas</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-xl"></i>
                        <span>Rumput segar untuk pakan ternak</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-xl"></i>
                        <span>Sisa makanan untuk kompos</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-xl"></i>
                        <span>Dapat Voucher Karbon setiap transaksi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Auth Forms -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <div class="inline-flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full gradient-eco flex items-center justify-center">
                            <i class="fas fa-leaf text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold text-gradient-eco">Eco-Loop</span>
                    </div>
                </div>

                <!-- Tab Switcher -->
                <div class="flex mb-8 bg-gray-200 rounded-xl p-1">
                    <button onclick="showTab('login')" id="tab-login" class="flex-1 py-3 rounded-lg font-semibold transition-all bg-white shadow text-eco-green">
                        Masuk
                    </button>
                    <button onclick="showTab('register')" id="tab-register" class="flex-1 py-3 rounded-lg font-semibold transition-all text-gray-600 hover:text-gray-800">
                        Daftar
                    </button>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>

    <script>
        function showTab(tab) {
            const loginForm = document.getElementById('form-login');
            const registerForm = document.getElementById('form-register');
            const loginTab = document.getElementById('tab-login');
            const registerTab = document.getElementById('tab-register');

            if (tab === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                loginTab.classList.add('bg-white', 'shadow', 'text-eco-green');
                loginTab.classList.remove('text-gray-600');
                registerTab.classList.remove('bg-white', 'shadow', 'text-eco-green');
                registerTab.classList.add('text-gray-600');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                registerTab.classList.add('bg-white', 'shadow', 'text-eco-green');
                registerTab.classList.remove('text-gray-600');
                loginTab.classList.remove('bg-white', 'shadow', 'text-eco-green');
                loginTab.classList.add('text-gray-600');
            }
        }

        // Check for register errors to show register tab
        @if(isset($errors) && $errors->any() && old('password_confirmation'))
            showTab('register');
        @endif
    </script>
</body>
</html>
