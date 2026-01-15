<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PGE Repository') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif !important;
        }
    </style>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">

            <a href="/" class="flex items-center space-x-2">
                <img src="{{ asset('/images/LOGO-PGE.png') }}" class="h-6 mr-3 sm:h-9" alt="Pge Logo" />
                <span class="font-semibold text-lg">PGE Repository</span>
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="hover:text-blue-700">Home</a>
                <a href="/documents" class="hover:text-blue-700">Documents</a>
                <a href="/news" class="hover:text-blue-700">News</a>
                <a href="/operasional" class="hover:text-blue-700">Operasional</a>
                <a href="/about" class="hover:text-blue-700">About Us</a>
                <a href="/contact" class="hover:text-blue-700">Contact</a>
            </div>

            {{-- DESKTOP AUTH --}}
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <span class="text-sm text-gray-700">{{ Auth::user()->nama ?? Auth::user()->email }}</span>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="text-sm bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="/login"
                        class="text-[#1F2A7A] border border-[#1F2A7A] hover:bg-[#1F2A7A] hover:text-white 
                          transition px-4 py-2 rounded-lg text-sm">
                        Login
                    </a>

                    <a href="/register"
                        class="text-white bg-[#1F2A7A] hover:bg-[#283893] transition 
                          px-4 py-2 rounded-lg text-sm">
                        Register
                    </a>
                @endauth
            </div>

            {{-- MOBILE BUTTON --}}
            <button class="md:hidden" id="mobileMenuBtn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

        </div>

        {{-- MOBILE MENU --}}
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
            <a href="/" class="block px-6 py-3 hover:bg-gray-100">Home</a>
            <a href="/documents" class="block px-6 py-3 hover:bg-gray-100">Documents</a>
            <a href="/news" class="block px-6 py-3 hover:bg-gray-100">News</a>
            <a href="/operasional" class="block px-6 py-3 hover:bg-gray-100">Operasional</a>
            <a href="/about" class="block px-6 py-3 hover:bg-gray-100">About Us</a>
            <a href="/contact" class="block px-6 py-3 hover:bg-gray-100">Contact</a>

            @auth
                <div class="border-t px-6 py-3">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                        class="block text-blue-700 font-medium">
                        Logout
                    </a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            @else
                <div class="border-t px-6 py-4 flex gap-4">
                    <a href="/login"
                        class="w-1/2 text-center text-[#1F2A7A] border border-[#1F2A7A] rounded-lg py-2 hover:bg-[#1F2A7A] hover:text-white transition">
                        Login
                    </a>

                    <a href="/register"
                        class="w-1/2 text-center text-white bg-[#1F2A7A] rounded-lg py-2 hover:bg-[#283893] transition">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </nav>

    {{-- PAGE CONTENT --}}
    <main class="min-h-screen mt-0">

        @yield('content')
    </main>

    {{-- Chatbot widget untuk user --}}
    @if(!request()->routeIs('chatbot.index'))
        @include('chatbot.widget', ['source' => 'user'])
    @endif

    {{-- FOOTER --}}
    <footer class="bg-gray-100 border-t mt-20">
        <div class="container mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-4 gap-10">

            <div>
                <h3 class="text-lg font-semibold mb-3">PGE Repository</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Sistem manajemen dokumen digital PT Pertamina Geothermal Energy
                    untuk penyimpanan dan distribusi dokumen perusahaan.
                </p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3">Quick Links</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li><a href="/" class="hover:text-blue-700">Home</a></li>
                    <li><a href="/documents" class="hover:text-blue-700">Documents</a></li>
                    <li><a href="/news" class="hover:text-blue-700">News</a></li>
                    <li><a href="/operasional" class="hover:text-blue-700">Operasional</a></li>
                    <li><a href="/about" class="hover:text-blue-700">About Us</a></li>
                    <li><a href="/contact" class="hover:text-blue-700">Contact</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3">Resources</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li><a href="#" class="hover:text-blue-700">Help Center</a></li>
                    <li><a href="#" class="hover:text-blue-700">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-blue-700">Terms & Conditions</a></li>
                    <li><a href="#" class="hover:text-blue-700">Support</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3">Contact Us</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>Gedung Pertamina, Jakarta</li>
                    <li>Email: info@pge.id</li>
                    <li>Phone: +62 123 456 789</li>
                </ul>
            </div>

        </div>

        <div class="border-t py-4 text-center text-sm text-gray-500">
            © 2025 PGE Repository. All rights reserved.
        </div>
    </footer>

    {{-- Mobile Menu Script --}}
    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
    </script>

</body>

</html>
