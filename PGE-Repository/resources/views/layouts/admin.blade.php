<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

{{-- Chatbot widget untuk admin --}}
@include('chatbot.widget', ['source' => 'admin'])

{{-- Lucide Icons --}}
<script src="/js/sidebar.js"></script>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script>
    lucide.createIcons();
</script>

</body>
</html>
