@extends('layouts.admin')

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

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Documents Management</h1>

        <button onclick="openModal()" class="px-4 py-2 bg-[#0A1F44] text-white rounded-lg hover:bg-blue-900">
            + Add New Document
        </button>
    </div>

    <div class="bg-white rounded-lg shadow p-6">

        <div class="flex justify-between mb-4">

            <input type="text" placeholder="Search dokumen..." class="w-1/3 px-4 py-2 border rounded-lg">

            <div class="flex gap-3">
                <select class="border px-4 py-2 rounded-lg">
                    <option>All Categories</option>
                </select>

                <select class="border px-4 py-2 rounded-lg">
                    <option>All Status</option>
                </select>

                <button class="border px-4 py-2 rounded-lg">
                    More Filters
                </button>
            </div>
        </div>

        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-3">Title</th>
                    <th class="py-3">Category</th>
                    <th class="py-3">Rack</th>
                    <th class="py-3">Year</th>
                    <th class="py-3">Status</th>
                    <th class="py-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($dokumen as $doc)
                    <tr class="border-b">
                        <td class="py-3">{{ $doc->judul }}</td>

                        <td class="py-3">
                            <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-600">
                                {{ $doc->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>

                        <td class="py-3">{{ $doc->rak->nama_rak ?? '-' }}</td>
                        <td class="py-3">{{ $doc->tahun_masuk }}</td>

                        <td class="py-3">
                            @if ($doc->status == 'aktif')
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-600">Aktif</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-gray-200 text-gray-600">Nonaktif</span>
                            @endif
                        </td>

                        <td class="py-3">
                            <div class="flex items-center gap-3">
                            <a href="{{ route('admin.dokumen.view', $doc->id_dokumen) }}"
                                    class="inline-flex items-center justify-center text-blue-600 hover:text-blue-800 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <button 
                                    onclick="openEdit(this, {{ $doc->id_dokumen }})" 
                                    data-doc='@json($doc)'
                                    class="inline-flex items-center justify-center text-blue-600 hover:text-blue-800 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                            </button>   
                                
                                <button onclick="openDelete({{ $doc->id_dokumen }})" 
                                    class="inline-flex items-center justify-center text-red-600 hover:text-red-800 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- Modal Overlay -->
    <div id="modalTambah" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-[999]">

        <!-- Modal Box -->
        <div class="bg-white w-[600px] rounded-2xl shadow-xl overflow-hidden">

            <!-- Header navy -->
            <div class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center">
                <h2 class="text-lg font-semibold">Tambah Dokumen</h2>
                <button onclick="tutupModal()">
                    <i data-lucide="x" class="w-5 h-5 text-white"></i>
                </button>
            </div>

            <!-- Body -->
            <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="grid grid-cols-2 gap-4">

                    <!-- Nama dokumen -->
                    <div>
                        <label class="text-sm font-medium">Nama Dokumen</label>
                        <input type="text" name="nama_dokumen"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                    </div>

                    <!-- Nomor versi -->
                    <div>
                        <label class="text-sm font-medium">Nomor Versi</label>
                        <input type="text" name="no_versi"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="text-sm font-medium">Kategori</label>
                        <select name="id_kategori"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                            <option value="">— Pilih —</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Rak -->
                    <div>
                        <label class="text-sm font-medium">Rak</label>
                        <select name="id_rak"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                            <option value="">— Pilih —</option>
                            @foreach ($raks as $rak)
                                <option value="{{ $rak->id_rak }}">{{ $rak->nama_rak }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="text-sm font-medium">Status</label>
                        <select name="status"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>

                    <!-- Tahun -->
                    <div>
                        <label class="text-sm font-medium">Tahun Masuk</label>
                        <input type="number" name="tahun_masuk"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                    </div>
                </div>

                <!-- Divisi -->
                <div>
                    <label class="text-sm font-medium">Divisi</label>
                    <select name="id_divisi"
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                        <option value="">— Pilih —</option>
                        @foreach ($divisis as $div)
                            <option value="{{ $div->id_divisi }}">{{ $div->nama_divisi }}</option>
                        @endforeach
                    </select>
                </div>


                <!-- File Upload full width -->
                <div class="mt-4">
                    <label class="text-sm font-medium">Upload File Dokumen</label>
                    <input type="file" name="file"
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900 focus:ring-blue-900">
                </div>

                <!-- Tombol -->
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

    <!-- Modal Edit Dokumen -->
    <div id="modalEdit" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-[999]">

        <div class="bg-white w-[600px] rounded-2xl shadow-xl overflow-hidden">

            <div class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center">
                <h2 class="text-lg font-semibold">Edit Dokumen</h2>
                <button onclick="closeEdit()">
                    <i data-lucide="x" class="w-5 h-5 text-white"></i>
                </button>
            </div>

            <form id="formEdit" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <input type="hidden" id="edit_id">

                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm font-medium">Nama Dokumen</label>
                        <input type="text" id="edit_nama" name="nama_dokumen"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Nomor Versi</label>
                        <input type="text" id="edit_versi" name="no_versi"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Kategori</label>
                        <select id="edit_kategori" name="id_kategori"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900">
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium">Rak</label>
                        <select id="edit_rak" name="id_rak"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900">
                            @foreach ($raks as $rak)
                                <option value="{{ $rak->id_rak }}">{{ $rak->nama_rak }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium">Divisi</label>
                        <select id="edit_divisi" name="id_divisi"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900">
                            @foreach ($divisis as $div)
                                <option value="{{ $div->id_divisi }}">{{ $div->nama_divisi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium">Status</label>
                        <select id="edit_status" name="status"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium">Tahun Masuk</label>
                        <input type="text" id="edit_tahun" name="tahun_masuk" maxlength="10"
                            class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900">
                    </div>

                </div>

                <div class="mt-4">
                    <label class="text-sm font-medium">Ganti File (Opsional)</label>
                    <input type="file" name="file"
                        class="w-full mt-1 rounded-lg border-gray-300 focus:border-blue-900">
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

    <!-- Modal Hapus -->
    <div id="modalDelete" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-[999]">

        <div class="bg-white w-[400px] rounded-2xl shadow-xl overflow-hidden">

            <div class="bg-red-600 text-white px-6 py-4">
                <h2 class="text-lg font-semibold">Hapus Dokumen?</h2>
            </div>

            <form id="formDelete" method="POST" class="p-6">
                @csrf
                @method('DELETE')

                <p class="text-gray-700">Dokumen akan dihapus secara permanen.</p>

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

        function closeModal() {
            document.getElementById('modalTambah').classList.add('hidden');
            document.getElementById('modalTambah').classList.remove('flex');
        }

        function tutupModal() {
            closeModal();
        }

        function openEdit(button, id) {
            try {
                // Get data from data attribute
                const docDataStr = button.getAttribute('data-doc');
                if (!docDataStr) {
                    console.error('Data not found on button');
                    return;
                }

                const docData = JSON.parse(docDataStr);
                
                // Show modal
            document.getElementById('modalEdit').classList.remove('hidden');
            document.getElementById('modalEdit').classList.add('flex');

                // Set form action
                document.getElementById('formEdit').action = `/dokumen/${id}`;

                // Fill form fields
                document.getElementById('edit_id').value = docData.id_dokumen || '';
                document.getElementById('edit_nama').value = docData.judul || '';
                document.getElementById('edit_versi').value = docData.no_versi || '';
                document.getElementById('edit_kategori').value = docData.id_kategori || '';
                document.getElementById('edit_rak').value = docData.id_rak || '';
                document.getElementById('edit_divisi').value = docData.id_divisi || '';
                document.getElementById('edit_status').value = docData.status || 'aktif';
                document.getElementById('edit_tahun').value = docData.tahun_masuk || '';
            } catch (error) {
                console.error('Error opening edit modal:', error);
                alert('Terjadi kesalahan saat membuka form edit');
            }
        }

        function closeEdit() {
            document.getElementById('modalEdit').classList.add('hidden');
            document.getElementById('modalEdit').classList.remove('flex');
        }

        function openDelete(id) {
            document.getElementById('modalDelete').classList.remove('hidden');
            document.getElementById('modalDelete').classList.add('flex');
            document.getElementById('formDelete').action = `/dokumen/${id}`;
        }

        function closeDelete() {
            document.getElementById('modalDelete').classList.add('hidden');
            document.getElementById('modalDelete').classList.remove('flex');
        }
    </script>
@endsection
