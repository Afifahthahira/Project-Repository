@extends('layouts.admin')

@section('title', 'Categories Management')

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
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-3xl font-semibold text-slate-900">Categories Management</h1>
            <p class="mt-1 text-sm text-slate-500">Manage document categories</p>
        </div>
        <button onclick="openModal()" class="px-4 py-2 bg-[#0A1F44] text-white rounded-lg hover:bg-blue-900">
            + Add New Category
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($categories as $category)
        <div class="bg-white rounded-lg border border-slate-100 p-5 shadow-sm relative">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-lg bg-slate-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3 7a2 2 0 012-2h3l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                    </svg>
                </div>

                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-slate-800">
                            {{ $category->nama_kategori }}
                        </h3>

                        <div class="flex items-center gap-3">
                            <button 
                                onclick="openEdit({{ $category->id_kategori }}, '{{ $category->nama_kategori }}')" 
                                class="inline-flex items-center justify-center text-blue-600 hover:text-blue-800 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            
                            @if($category->dokumen_count > 0)
                                <button 
                                    disabled
                                    title="Tidak dapat dihapus karena masih memiliki {{ $category->dokumen_count }} dokumen"
                                    class="inline-flex items-center justify-center text-gray-400 cursor-not-allowed opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            @else
                                <button 
                                    onclick="openDelete({{ $category->id_kategori }}, '{{ $category->nama_kategori }}', {{ $category->dokumen_count }})" 
                                    class="inline-flex items-center justify-center text-red-600 hover:text-red-800 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                    <p class="mt-2 text-sm text-slate-500">&nbsp;</p>

                    <div class="border-t mt-4 pt-3 text-xs text-slate-400">
                        {{ $category->dokumen_count }} documents
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-lg border border-slate-100 p-6 text-center text-slate-500">
            No categories found.
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div id="modalTambah" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-[999]">
    <div class="bg-white w-[500px] rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Tambah Kategori</h2>
            <button onclick="tutupModal()">
                <i data-lucide="x" class="w-5 h-5 text-white"></i>
            </button>
        </div>

        <form action="{{ route('admin.kategori.store') }}" method="POST" class="p-6">
            @csrf
            <div>
                <label class="text-sm font-medium">Nama Kategori</label>
                <input type="text" name="nama_kategori" required maxlength="150"
                    class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
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

<!-- Modal Edit Kategori -->
<div id="modalEdit" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-[999]">
    <div class="bg-white w-[500px] rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Edit Kategori</h2>
            <button onclick="closeEdit()">
                <i data-lucide="x" class="w-5 h-5 text-white"></i>
            </button>
        </div>

        <form id="formEdit" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div>
                <label class="text-sm font-medium">Nama Kategori</label>
                <input type="text" id="edit_nama" name="nama_kategori" required maxlength="150"
                    class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
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

<!-- Modal Hapus Kategori -->
<div id="modalDelete" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-[999]">
    <div class="bg-white w-[400px] rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-red-600 text-white px-6 py-4">
            <h2 class="text-lg font-semibold">Hapus Kategori?</h2>
        </div>

        <form id="formDelete" method="POST" class="p-6">
            @csrf
            @method('DELETE')
            <p class="text-gray-700 mb-2">Kategori "<span id="delete_nama" class="font-semibold"></span>" akan dihapus secara permanen.</p>
            <p id="delete_warning" class="text-red-600 text-sm font-medium hidden"></p>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeDelete()"
                    class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" id="deleteButton" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
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

    function openEdit(id, nama) {
        document.getElementById('modalEdit').classList.remove('hidden');
        document.getElementById('modalEdit').classList.add('flex');
        document.getElementById('formEdit').action = `/admin/kategori/${id}`;
        document.getElementById('edit_nama').value = nama;
    }

    function closeEdit() {
        document.getElementById('modalEdit').classList.add('hidden');
        document.getElementById('modalEdit').classList.remove('flex');
    }

    function openDelete(id, nama, dokumenCount) {
        document.getElementById('modalDelete').classList.remove('hidden');
        document.getElementById('modalDelete').classList.add('flex');
        document.getElementById('formDelete').action = `/admin/kategori/${id}`;
        document.getElementById('delete_nama').textContent = nama;
        
        const warningEl = document.getElementById('delete_warning');
        const deleteButton = document.getElementById('deleteButton');
        
        if (dokumenCount > 0) {
            warningEl.textContent = `Kategori ini tidak dapat dihapus karena masih memiliki ${dokumenCount} dokumen.`;
            warningEl.classList.remove('hidden');
            deleteButton.disabled = true;
            deleteButton.classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            warningEl.classList.add('hidden');
            deleteButton.disabled = false;
            deleteButton.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }

    function closeDelete() {
        document.getElementById('modalDelete').classList.add('hidden');
        document.getElementById('modalDelete').classList.remove('flex');
    }
</script>
@endsection
