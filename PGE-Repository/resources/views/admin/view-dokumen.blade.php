<!-- resources/views/admin/view-dokumen.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header Back -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-700 p-6 text-white">
        <a href="{{ route('dokumen.index') }}" class="flex items-center gap-2 text-sm hover:underline">
            ← Back to Documents
        </a>
        <h1 class="mt-2 text-xl font-semibold">{{ $dokumen->judul }}</h1>
    </div>

    <div class="max-w-7xl mx-auto py-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT SECTION -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Document Information -->
            <div class="bg-white p-6 shadow rounded-xl">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-semibold text-lg">Document Information</h2>
                    <span
                        class="px-3 py-1 text-sm rounded-full {{ $dokumen->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                        {{ ucfirst($dokumen->status) }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="font-medium">Version</p>
                        <p>{{ $dokumen->no_versi ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="font-medium">Division</p>
                        <p>{{ $dokumen->divisi->nama_divisi ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="font-medium">Category</p>
                        <p>{{ $dokumen->kategori->nama_kategori ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="font-medium">Year</p>
                        <p>{{ $dokumen->tahun_masuk }}</p>
                    </div>
                    <div>
                        <p class="font-medium">Rack Location</p>
                        <p>{{ $dokumen->rak->nama_rak ?? '-' }}</p>
                    </div>
                </div>

                <div class="mt-4 text-sm">
                    <p class="font-medium mb-1">Description</p>
                    <p class="text-gray-700">{{ $dokumen->deskripsi ?? '-' }}</p>
                </div>
            </div>

            <!-- Document Preview -->
            <div class="bg-white p-6 shadow rounded-xl">
                <h2 class="font-semibold mb-3">Document Preview</h2>
                <iframe src="{{ asset('storage/' . $dokumen->file_path) }}"
                    class="w-full h-[500px] border rounded"></iframe>
            </div>
        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="space-y-6">

            <!-- Actions -->
            <div class="bg-white p-6 shadow rounded-xl">
                <h2 class="font-semibold mb-3">Actions</h2>
                <a href="{{ route('admin.dokumen.download', $dokumen->id_dokumen) }}"
                    class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">Download PDF</a>
            </div>

            <!-- Related Documents Placeholder -->
            <div class="bg-white p-6 shadow rounded-xl">
                <h2 class="font-semibold mb-3">Related Documents</h2>
                <p class="text-sm text-gray-500">(Optional section)</p>
            </div>

            <!-- Document Stats -->
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white p-6 rounded-xl">
                <h2 class="font-semibold mb-4">Document Stats</h2>
                <div class="space-y-2 text-sm">
                    <p>Total Views: 0</p>
                    <p>Downloads: 0</p>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="bg-blue-900 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
            <div>
                <h4 class="font-semibold mb-2">PGE Repository</h4>
                <p>Sistem manajemen dokumen digital PT Pertamina Geothermal Energy</p>
            </div>
            <div>
                <h4 class="font-semibold mb-2">Quick Links</h4>
                <p>Home</p>
                <p>Documents</p>
                <p>News</p>
            </div>
            <div>
                <h4 class="font-semibold mb-2">Contact Us</h4>
                <p>Gedung Pertamina, Jakarta</p>
                <p>info@pge.co.id</p>
                <p>+62 21 1234 5678</p>
            </div>
        </div>
        <p class="text-center mt-6 text-xs">© 2025 PT Pertamina Geothermal Energy. All rights reserved.</p>
    </footer>

</body>

</html>
