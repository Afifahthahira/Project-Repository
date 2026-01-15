<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif !important;
        }
        [x-cloak] { display: none !important; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex">

    {{-- Sidebar Admin --}}
    @include('components.sidebar')

    <div class="flex-1">

        {{-- Navbar --}}
        @include('components.navbar')

        <main class="p-6">
            @yield('content')
        </main>

    </div>
</div>

{{-- Alpine.js for dropdowns --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
{{-- Chatbot widget untuk admin --}}
@include('chatbot.widget', ['source' => 'admin'])

{{-- Lucide Icons --}}
<script src="/js/sidebar.js"></script>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script>
    lucide.createIcons();
</script>

{{-- Notification Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadNotifications();
        
        // Refresh notifications every 30 seconds
        setInterval(loadNotifications, 30000);
    });

    function loadNotifications() {
        fetch('{{ route("admin.notifications") }}')
            .then(response => response.json())
            .then(data => {
                const notificationList = document.getElementById('notificationList');
                const notificationBadge = document.getElementById('notificationBadge');
                
                // Show/hide badge
                if (data.unread_count > 0) {
                    notificationBadge.classList.remove('hidden');
                } else {
                    notificationBadge.classList.add('hidden');
                }
                
                // Update notification list
                if (data.notifications.length === 0) {
                    notificationList.innerHTML = `
                        <div class="p-4 text-center text-gray-500 text-sm">
                            No recent activities
                        </div>
                    `;
                } else {
                    notificationList.innerHTML = data.notifications.map(notif => {
                        const actionColors = {
                            'uploaded': 'bg-blue-100 text-blue-700',
                            'downloaded': 'bg-green-100 text-green-700',
                            'viewed': 'bg-purple-100 text-purple-700',
                            'edited': 'bg-yellow-100 text-yellow-700',
                            'deleted': 'bg-red-100 text-red-700'
                        };
                        const colorClass = actionColors[notif.action] || 'bg-gray-100 text-gray-700';
                        
                        return `
                            <div class="p-3 border-b border-gray-100 hover:bg-gray-50 transition">
                                <div class="flex items-start gap-3">
                                    <span class="px-2 py-1 rounded text-xs font-medium ${colorClass}">
                                        ${notif.action}
                                    </span>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-900 font-medium truncate">
                                            ${notif.user} - ${notif.document}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">${notif.time}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    }).join('');
                }
            })
            .catch(error => {
                console.error('Error loading notifications:', error);
            });
    }
</script>

</body>
</html>
