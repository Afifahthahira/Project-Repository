<div class="w-64 min-h-screen bg-white border-r px-4 py-3 flex flex-col justify-between">

    <div>
        <div class="px-4 py-1 border-b">
            <h2 class="text-lg font-semibold text-blue-900">PGE Admin</h2>
            <p class="text-gray-500 text-xs">Repository</p>
        </div>

        <!-- Menu -->
        <ul class="mt-8 space-y-2 font-medium">

            {{-- Back to Home --}}
            <li>
                <a href="{{ route('home') }}"
                    class="
                    flex items-center gap-3 px-4 py-3 rounded-xl transition
                    text-gray-600 hover:bg-gray-100 hover:text-gray-900
                ">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    Back to Home
                </a>
            </li>

            {{-- Dashboard --}}
            <li>
                <a href="/admin"
                    class="
                    flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('admin')
                        ? 'bg-blue-900/80 text-white'
                        : 'text-blue-900 hover:bg-blue-900/10 hover:text-blue-900' }}
                ">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Dashboard
                </a>
            </li>

            {{-- Documents --}}
            <li>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="/admin/dokumen"
                        class="
                        flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->is('admin/dokumen*')
                            ? 'bg-blue-900/80 text-white'
                            : 'text-blue-900 hover:bg-blue-900/10 hover:text-blue-900' }}
                    ">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                        Documents
                    </a>
                @elseif(Auth::check())
                    <a href="{{ route('user.documents') }}"
                        class="
                        flex items-center gap-3 px-4 py-3 rounded-xl transition
                        text-blue-900 hover:bg-blue-900/10 hover:text-blue-900
                    ">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                        Documents
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="
                        flex items-center gap-3 px-4 py-3 rounded-xl transition
                        text-blue-900 hover:bg-blue-900/10 hover:text-blue-900
                    ">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                        Documents
                    </a>
                @endif
            </li>

            {{-- Categories --}}
            <li>
                <a href="{{ route('admin.kategori.index') }}"
                    class="
                    flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('admin/kategori*')
                        ? 'bg-blue-900/80 text-white'
                        : 'text-blue-900 hover:bg-blue-900/10 hover:text-blue-900' }}
                ">
                    <i data-lucide="folder-tree" class="w-5 h-5"></i>
                    Categories
                </a>
            </li>

            {{-- Racks --}}
            <li>
                <a href="{{ route('admin.rak.index') }}"
                    class="
                    flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('admin/rak*')
                        ? 'bg-blue-900/80 text-white'
                        : 'text-blue-900 hover:bg-blue-900/10 hover:text-blue-900' }}
                ">
                    <i data-lucide="package" class="w-5 h-5"></i>
                    Racks
                </a>
            </li>

            {{-- Divisions --}}
            <li>
                <a href="{{ route('admin.divisi.index') }}"
                    class="
                    flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('admin/divisi*')
                        ? 'bg-blue-900/80 text-white'
                        : 'text-blue-900 hover:bg-blue-900/10 hover:text-blue-900' }}
                ">
                    <i data-lucide="building-2" class="w-5 h-5"></i>
                    Divisions
                </a>
            </li>

            {{-- USERS --}}
            <li>
                <a href="{{ route('admin.users.index') }}"
                    class="
                    flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('admin/users*')
                        ? 'bg-blue-900/80 text-white'
                        : 'text-blue-900 hover:bg-blue-900/10 hover:text-blue-900' }}
                ">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Users
                </a>
            </li>

            {{-- Activity Logs --}}
            <li>
                <a href="{{ route('admin.activity-logs.index') }}"
                    class="
                    flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('admin/activity-logs*')
                        ? 'bg-blue-900/80 text-white'
                        : 'text-blue-900 hover:bg-blue-900/10 hover:text-blue-900' }}
                ">
                    <i data-lucide="activity" class="w-5 h-5"></i>
                    Activity Logs
                </a>
            </li>

        </ul>
    </div>

    <!-- Profile Section -->
    <a href="{{ route('admin.settings') }}"
        class="flex items-center gap-3 p-3 bg-gray-50 hover:bg-gray-100 rounded-xl transition mt-6">

        <div class="w-10 h-10 rounded-full bg-gray-200"></div>

        <div class="flex-1">
            <p class="font-semibold text-sm">{{ Auth::user()->nama }}</p>
            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
        </div>

        <i data-lucide="chevron-right" class="w-4 h-4 text-gray-500"></i>
    </a>

</div>
