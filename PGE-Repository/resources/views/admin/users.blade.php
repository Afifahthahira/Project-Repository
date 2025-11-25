@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')
@if (session('success'))
    <div id="successMessage" class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center justify-between">
        <span>{{ session('success') }}</span>
        <button onclick="document.getElementById('successMessage').remove()" class="text-green-700 hover:text-green-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif

@if (session('error'))
    <div id="errorMessage" class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center justify-between">
        <span>{{ session('error') }}</span>
        <button onclick="document.getElementById('errorMessage').remove()" class="text-red-700 hover:text-red-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif

<div class="max-w-7xl mx-auto py-8 px-6">
    <!-- Header -->
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-3xl font-semibold text-slate-900">Users Management</h1>
            <p class="mt-1 text-sm text-slate-500">Manage all system users and their permissions</p>
        </div>
        <button onclick="openModal()" class="px-4 py-2 bg-[#0A1F44] text-white rounded-lg hover:bg-blue-900">
            + Add New User
        </button>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg border border-slate-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Total Users</p>
                    <p class="text-2xl font-semibold text-slate-900">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-slate-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Administrators</p>
                    <p class="text-2xl font-semibold text-slate-900">{{ $totalAdmins }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-slate-100 p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Active Users</p>
                    <p class="text-2xl font-semibold text-slate-900">{{ $activeUsers }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-lg border border-slate-100 p-6 shadow-sm mb-6">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users by name or email..." 
                           class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="flex gap-3">
                <select name="division" class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Divisions</option>
                    @foreach($divisis as $divisi)
                        <option value="{{ $divisi->id_divisi }}" {{ request('division') == $divisi->id_divisi ? 'selected' : '' }}>
                            {{ $divisi->nama_divisi }}
                        </option>
                    @endforeach
                </select>
                <select name="role" class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'division', 'role']))
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 border border-slate-300 rounded-lg hover:bg-slate-50">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-lg border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Division</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Last Login</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($users as $user)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-slate-900">{{ $user->nama }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-slate-600">{{ $user->email }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-slate-600">{{ $user->divisi->nama_divisi ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->role == 'admin')
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-700">Admin</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">User</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Active</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-slate-600">
                            @if($user->updated_at)
                                {{ $user->updated_at->diffForHumans() }}
                            @else
                                Never
                            @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <button 
                                onclick="openEdit({{ $user->id_user }}, '{{ $user->nama }}', '{{ $user->email }}', {{ $user->id_divisi ?? 'null' }}, '{{ $user->role }}')" 
                                class="inline-flex items-center justify-center text-blue-600 hover:text-blue-800 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button 
                                onclick="openDelete({{ $user->id_user }}, '{{ $user->nama }}')" 
                                class="inline-flex items-center justify-center text-red-600 hover:text-red-800 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                        No users found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah User -->
<div id="modalTambah" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-[999]">
    <div class="bg-white w-[600px] rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Tambah User</h2>
            <button onclick="tutupModal()">
                <i data-lucide="x" class="w-5 h-5 text-white"></i>
            </button>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium">Nama</label>
                    <input type="text" name="nama" required
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                </div>

                <div>
                    <label class="text-sm font-medium">Email</label>
                    <input type="email" name="email" required
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                </div>

                <div>
                    <label class="text-sm font-medium">Password</label>
                    <input type="password" name="password" required minlength="6"
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                </div>

                <div>
                    <label class="text-sm font-medium">Divisi</label>
                    <select name="id_divisi"
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                        <option value="">— Pilih Divisi —</option>
                        @foreach($divisis as $divisi)
                            <option value="{{ $divisi->id_divisi }}">{{ $divisi->nama_divisi }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium">Role</label>
                    <select name="role" required
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="tutupModal()"
                    class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-blue-900 text-white hover:bg-blue-800">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit User -->
<div id="modalEdit" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-[999]">
    <div class="bg-white w-[600px] rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Edit User</h2>
            <button onclick="closeEdit()">
                <i data-lucide="x" class="w-5 h-5 text-white"></i>
            </button>
        </div>

        <form id="formEdit" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium">Nama</label>
                    <input type="text" id="edit_nama" name="nama" required
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                </div>

                <div>
                    <label class="text-sm font-medium">Email</label>
                    <input type="email" id="edit_email" name="email" required
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                </div>

                <div>
                    <label class="text-sm font-medium">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" id="edit_password" name="password" minlength="6"
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                </div>

                <div>
                    <label class="text-sm font-medium">Divisi</label>
                    <select id="edit_divisi" name="id_divisi"
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                        <option value="">— Pilih Divisi —</option>
                        @foreach($divisis as $divisi)
                            <option value="{{ $divisi->id_divisi }}">{{ $divisi->nama_divisi }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium">Role</label>
                    <select id="edit_role" name="role" required
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeEdit()"
                    class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-blue-900 text-white hover:bg-blue-800">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus User -->
<div id="modalDelete" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-[999]">
    <div class="bg-white w-[400px] rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-red-600 text-white px-6 py-4">
            <h2 class="text-lg font-semibold">Hapus User?</h2>
        </div>

        <form id="formDelete" method="POST" class="p-6">
            @csrf
            @method('DELETE')
            <p class="text-gray-700 mb-2">User "<span id="delete_nama" class="font-semibold"></span>" akan dihapus secara permanen.</p>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeDelete()"
                    class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto-hide success/error messages after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const successMsg = document.getElementById('successMessage');
        const errorMsg = document.getElementById('errorMessage');
        
        if (successMsg) {
            setTimeout(() => {
                successMsg.style.transition = 'opacity 0.5s';
                successMsg.style.opacity = '0';
                setTimeout(() => successMsg.remove(), 500);
            }, 5000);
        }
        
        if (errorMsg) {
            setTimeout(() => {
                errorMsg.style.transition = 'opacity 0.5s';
                errorMsg.style.opacity = '0';
                setTimeout(() => errorMsg.remove(), 500);
            }, 5000);
        }
    });

    function openModal() {
        document.getElementById('modalTambah').classList.remove('hidden');
        document.getElementById('modalTambah').classList.add('flex');
    }

    function tutupModal() {
        document.getElementById('modalTambah').classList.add('hidden');
        document.getElementById('modalTambah').classList.remove('flex');
    }

    function openEdit(id, nama, email, idDivisi, role) {
        document.getElementById('modalEdit').classList.remove('hidden');
        document.getElementById('modalEdit').classList.add('flex');
        document.getElementById('formEdit').action = `/admin/users/${id}`;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_divisi').value = idDivisi || '';
        document.getElementById('edit_role').value = role;
        document.getElementById('edit_password').value = '';
    }

    function closeEdit() {
        document.getElementById('modalEdit').classList.add('hidden');
        document.getElementById('modalEdit').classList.remove('flex');
    }

    function openDelete(id, nama) {
        document.getElementById('modalDelete').classList.remove('hidden');
        document.getElementById('modalDelete').classList.add('flex');
        document.getElementById('formDelete').action = `/admin/users/${id}`;
        document.getElementById('delete_nama').textContent = nama;
    }

    function closeDelete() {
        document.getElementById('modalDelete').classList.add('hidden');
        document.getElementById('modalDelete').classList.remove('flex');
    }
</script>
@endsection

