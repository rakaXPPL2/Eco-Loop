<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Eco-Loop Marketplace - Jual Beli Barang Bekas, Rumput, dan Sisa Makanan untuk Kurangi Jejak Karbon">

    <title>{{ $title ?? 'Eco-Loop Marketplace' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Line clamp utility */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Page load animation */
        main {
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Status color adjustments for light theme */
        .status-pending {
            background: rgba(245, 158, 11, 0.15);
            color: #b45309;
            border: 1px solid rgba(245, 158, 11, 0.25);
        }

        .status-completed {
            background: rgba(34, 197, 94, 0.15);
            color: #15803d;
            border: 1px solid rgba(34, 197, 94, 0.25);
        }

        .status-cancelled {
            background: rgba(239, 68, 68, 0.15);
            color: #b91c1c;
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        .status-reviewing {
            background: rgba(59, 130, 246, 0.15);
            color: #1d4ed8;
            border: 1px solid rgba(59, 130, 246, 0.25);
        }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-white">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        @include('eco-loop.layouts.partials.navbar')

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- Footer -->
        @include('eco-loop.layouts.partials.footer')

        <!-- Cart Sidebar -->
        @include('eco-loop.layouts.partials.cart-sidebar')

        <!-- Toast Notifications -->
        @include('components.toast')

        <!-- Back to Top Button -->
        <button id="back-to-top" onclick="scrollToTop()" class="back-to-top" aria-label="Kembali ke atas">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>

    <script>
        // Back to Top Button Logic
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Show/hide back to top button based on scroll position
        window.addEventListener('scroll', function() {
            const backToTopBtn = document.getElementById('back-to-top');
            if (window.scrollY > 300) {
                backToTopBtn.classList.add('visible');
            } else {
                backToTopBtn.classList.remove('visible');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
