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

        /* Mobile menu animation */
        #mobileMenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        #mobileMenu:not(.hidden) {
            max-height: 1000px; /* Large enough for content */
        }
    </style>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between min-h-[4rem]">

                <a href="/" class="flex items-center space-x-2 flex-shrink-0">
                    <img src="{{ asset('/images/LOGO-PGE.png') }}" class="h-6 sm:h-8 lg:h-10 w-auto" alt="PGE Logo" />
                    <span class="font-semibold text-base sm:text-lg lg:text-xl text-gray-900">PGE Repository</span>
                </a>

                <div class="hidden lg:flex items-center space-x-6 xl:space-x-8">
                    <a href="/" class="text-gray-700 hover:text-blue-700 transition-colors font-medium">Home</a>
                    @auth
                        <a href="{{ Auth::user()->role === 'admin' ? '/admin/dokumen' : route('user.documents') }}" class="text-gray-700 hover:text-blue-700 transition-colors font-medium">Documents</a>
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-700 transition-colors font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-700 transition-colors font-medium">Documents</a>
                    @endauth
                    <a href="/news" class="text-gray-700 hover:text-blue-700 transition-colors font-medium">News</a>
                    <a href="/about" class="text-gray-700 hover:text-blue-700 transition-colors font-medium">About Us</a>
                    <a href="/contact" class="text-gray-700 hover:text-blue-700 transition-colors font-medium">Contact</a>
                </div>

                {{-- DESKTOP AUTH --}}
                <div class="hidden lg:flex items-center space-x-3 xl:space-x-4">
                    @auth
                        <span class="text-sm text-gray-700 font-medium">{{ Auth::user()->nama ?? Auth::user()->email }}</span>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="text-sm bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors font-medium">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    @else
                        <a href="/login"
                            class="text-[#1F2A7A] border border-[#1F2A7A] hover:bg-[#1F2A7A] hover:text-white
                              transition-all px-4 py-2 rounded-lg text-sm font-medium">
                            Login
                        </a>

                        <a href="/register"
                            class="text-white bg-[#1F2A7A] hover:bg-[#283893] transition-all
                              px-4 py-2 rounded-lg text-sm font-medium">
                            Register
                        </a>
                    @endauth
                </div>

                {{-- MOBILE BUTTON --}}
                <button class="lg:hidden p-2 -mr-2" id="mobileMenuBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

            </div>
        </div>

        {{-- MOBILE MENU --}}
        <div id="mobileMenu" class="hidden lg:hidden bg-white border-t shadow-lg">
            <div class="px-4 py-2 space-y-1">
                <a href="/" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors rounded-lg font-medium">Home</a>
                @auth
                    <a href="{{ Auth::user()->role === 'admin' ? '/admin/dokumen' : route('user.documents') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors rounded-lg font-medium">Documents</a>
                    <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors rounded-lg font-medium">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors rounded-lg font-medium">Documents</a>
                @endauth
                <a href="/news" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors rounded-lg font-medium">News</a>
                <a href="/about" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors rounded-lg font-medium">About Us</a>
                <a href="/contact" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors rounded-lg font-medium">Contact</a>
            </div>

            @auth
                <div class="border-t px-4 py-4">
                    <div class="px-2 mb-3">
                        <span class="text-sm text-gray-500">Welcome,</span>
                        <span class="block text-sm font-medium text-gray-900">{{ Auth::user()->nama ?? Auth::user()->email }}</span>
                    </div>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                        class="block w-full text-center text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-3 rounded-lg font-medium transition-colors">
                        Logout
                    </a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            @else
                <div class="border-t px-4 py-4 flex gap-3">
                    <a href="/login"
                        class="flex-1 text-center text-[#1F2A7A] border border-[#1F2A7A] rounded-lg py-3 hover:bg-[#1F2A7A] hover:text-white transition-all font-medium">
                        Login
                    </a>

                    <a href="/register"
                        class="flex-1 text-center text-white bg-[#1F2A7A] rounded-lg py-3 hover:bg-[#283893] transition-all font-medium">
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

    {{-- FOOTER --}}
    <footer class="bg-gray-100 border-t mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
    
                <!-- Company -->
                <div class="space-y-3">
                    <h3 class="text-lg font-semibold">PGE Repository</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Sistem manajemen dokumen digital PT Pema Global Energi
                        untuk penyimpanan dan distribusi dokumen perusahaan.
                    </p>
                </div>
    
                <!-- Quick Links -->
                <div class="space-y-3">
                    <h3 class="text-lg font-semibold">Quick Links</h3>
                    <ul class="text-sm text-gray-600 space-y-2">
                        <li><a href="/" class="hover:text-blue-700">Home</a></li>
                        <li><a href="/documents" class="hover:text-blue-700">Documents</a></li>
                        <li><a href="/news" class="hover:text-blue-700">News</a></li>
                        <li><a href="/about" class="hover:text-blue-700">About Us</a></li>
                        <li><a href="/contact" class="hover:text-blue-700">Contact</a></li>
                    </ul>
                </div>
    
                <!-- Contact -->
                <div class="space-y-3">
                    <h3 class="text-lg font-semibold">Contact Us</h3>
                    <ul class="text-sm text-gray-600 space-y-1 leading-relaxed">
                        <li>PT Pema Global Energi</li>
                        <li>Jl. Jendral Sudirman No. 59</li>
                        <li>Geuceu Iniem Banda Raya</li>
                        <li>Banda Aceh, Aceh 23243</li>
                    </ul>
                </div>
    
                <!-- Info & Social -->
                <div class="space-y-3">
                    <h3 class="text-lg font-semibold">Info</h3>
                    <ul class="text-sm text-gray-600 space-y-1 leading-relaxed">
                        <li><span class="font-medium">Phone:</span> +62 808 9000</li>
                        <li><span class="font-medium">Email:</span> info@pge.id</li>
                        <li><span class="font-medium">Website:</span> www.pge.id</li>
                    </ul>
    
                    <div>
                        <h4 class="text-sm font-semibold mb-2">Follow Us</h4>
                        <div class="flex space-x-4 text-gray-600">
                    
                            <!-- Instagram -->
                            <a href="https://www.instagram.com/pemaglobalenergi/cd pgInstagram">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zm10 1.75a1 1 0 1 1 0 2 1 1 0 0 1 0-2zM12 7.25a4.75 4.75 0 1 1 0 9.5 4.75 4.75 0 0 1 0-9.5zm0 1.5a3.25 3.25 0 1 0 0 6.5 3.25 3.25 0 0 0 0-6.5z"/>
                                </svg>
                            </a>
                    
                            <!-- X (Twitter) -->
                            <a href="#" class="hover:text-blue-600" aria-label="X">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.244 2H21.5l-7.41 8.45L23 22h-7.266l-5.175-6.647L4.6 22H1.343l7.93-9.04L1 2h7.36l4.713 5.993L18.244 2zm-2.526 17.26h1.73L8.558 4.61H6.71l8.998 14.65z"/>
                                </svg>
                            </a>
                    
                            <!-- Facebook -->
                            <a href="#" class="hover:text-blue-700" aria-label="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12a10 10 0 1 0-11.5 9.87v-6.99H7.9V12h2.6V9.8c0-2.57 1.53-3.99 3.88-3.99 1.12 0 2.29.2 2.29.2v2.52h-1.29c-1.27 0-1.66.79-1.66 1.6V12h2.83l-.45 2.88h-2.38v6.99A10 10 0 0 0 22 12z"/>
                                </svg>
                            </a>
                    
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    
        <div class="border-t py-4 text-center text-sm text-gray-500">
            © 2025 PGE Repository. All rights reserved.
        </div>
    </footer>
    

    {{-- Mobile Menu Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');

            mobileMenuBtn.addEventListener('click', function() {
                const isHidden = mobileMenu.classList.contains('hidden');

                if (isHidden) {
                    mobileMenu.classList.remove('hidden');
                    // Trigger animation
                    setTimeout(() => {
                        mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
                    }, 10);
                } else {
                    mobileMenu.style.maxHeight = '0px';
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                    }, 300);
                }
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.style.maxHeight = '0px';
                        setTimeout(() => {
                            mobileMenu.classList.add('hidden');
                        }, 300);
                    }
                }
            });
        });
    </script>

</body>

</html>
