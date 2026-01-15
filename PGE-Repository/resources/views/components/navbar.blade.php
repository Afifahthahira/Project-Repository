<nav class="w-full min-h-[4rem] bg-white shadow-sm flex items-center justify-between px-4 sm:px-6 lg:px-8">
    <div class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
        <button id="toggleSidebar" class="lg:hidden block p-1 -ml-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <h1 class="font-semibold text-base sm:text-lg text-gray-900 truncate">PGE Repository</h1>
    </div>

    <div class="flex items-center gap-3 sm:gap-4 lg:gap-5 flex-shrink-0">
        {{-- Notification Dropdown --}}
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="relative p-1 hover:bg-gray-50 rounded-full transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-gray-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span id="notificationBadge" class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white hidden"></span>
            </button>

            {{-- Dropdown Menu --}}
            <div x-show="open" 
                 x-cloak
                 @click.away="open = false"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 z-50 max-h-96 overflow-hidden"
                 style="display: none;">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-sm font-semibold text-gray-900">Recent Activities</h3>
                </div>
                <div id="notificationList" class="overflow-y-auto max-h-80">
                    <div class="p-4 text-center text-gray-500 text-sm">
                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mx-auto mb-2"></div>
                        Loading...
                    </div>
                </div>
                <div class="p-3 border-t border-gray-200 bg-gray-50">
                    <a href="{{ route('admin.activity-logs.index') }}" class="block text-center text-sm text-blue-600 hover:text-blue-700 font-medium">
                        View All Activities →
                    </a>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2 sm:gap-3">
            <img src="https://ui-avatars.com/api/?name=Admin" class="w-8 h-8 sm:w-9 sm:h-9 rounded-full flex-shrink-0">
            <span class="text-sm font-medium text-gray-700 hidden sm:block">Admin</span>
        </div>
    </div>
</nav>
