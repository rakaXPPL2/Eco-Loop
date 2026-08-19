<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Eco-Loop Marketplace - Jual Beli Barang Bekas, Rumput, dan Sisa Makanan untuk Kurangi Jejak Karbon">

    <title>{{ $title ?? 'Eco-Loop Marketplace' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased">
    <!-- Notification Toast Container -->
    <div id="notification-toast-container" class="fixed top-20 right-4 z-50 space-y-2"></div>

    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        @include('eco-loop.layouts.partials.navbar')

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- Footer -->
        @include('eco-loop.layouts.partials.footer')
    </div>

    <!-- Cart Sidebar -->
    @include('eco-loop.layouts.partials.cart-sidebar')

    @stack('scripts')

    <!-- Notification Polling Script -->
    @auth
    <script>
        let lastNotificationId = 0;

        function checkNotifications() {
            fetch('/api/notifications/poll?last_id=' + lastNotificationId, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.notifications && data.notifications.length > 0) {
                    data.notifications.forEach(function(notification) {
                        showNotificationToast(notification);
                        lastNotificationId = Math.max(lastNotificationId, notification.id);
                    });
                }
            })
            .catch(function(err) { console.log('Notification check failed:', err); });
        }

        function showNotificationToast(notification) {
            var container = document.getElementById('notification-toast-container');
            var toast = document.createElement('div');

            var bgColor = 'bg-gray-500';
            var icon = 'fa-bell';

            if (notification.type === 'order') {
                bgColor = 'bg-emerald-500';
                icon = 'fa-shopping-bag';
            } else if (notification.type === 'payment') {
                bgColor = 'bg-yellow-500';
                icon = 'fa-credit-card';
            } else if (notification.type === 'message') {
                bgColor = 'bg-blue-500';
                icon = 'fa-envelope';
            }

            toast.className = bgColor + ' text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 animate-slide-in max-w-sm';
            toast.innerHTML = '<i class="fas ' + icon + ' text-lg mr-2"></i>' +
                '<div class="flex-1">' +
                '<p class="font-semibold">' + notification.title + '</p>' +
                '<p class="text-sm opacity-90">' + notification.message + '</p>' +
                '</div>' +
                '<button onclick="this.parentElement.remove()" class="text-white/80 hover:text-white ml-4">' +
                '<i class="fas fa-times"></i>' +
                '</button>';

            container.appendChild(toast);

            // Auto remove after 5 seconds
            setTimeout(function() {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(function() {
                    if (toast.parentElement) toast.remove();
                }, 300);
            }, 5000);
        }

        // Start polling every 30 seconds
        setInterval(checkNotifications, 30000);

        // Initial check
        checkNotifications();
    </script>
    @endauth
</body>
</html>
