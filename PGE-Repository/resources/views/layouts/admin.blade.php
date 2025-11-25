<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>

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

{{-- Lucide Icons --}}
<script src="/js/sidebar.js"></script>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script>
    lucide.createIcons();
</script>

</body>
</html>
