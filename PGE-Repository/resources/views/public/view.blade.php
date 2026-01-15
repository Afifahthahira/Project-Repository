@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">

    <!-- Header -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Document Details</h1>
                <p class="text-gray-600 mt-1">View document information and download</p>
            </div>
            <a href="{{ route('public.search') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Search
            </a>
        </div>
    </div>

    <!-- Document Details -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">

            <!-- Document Header -->
            <div class="p-6 border-b">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $dokumen->judul }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                            <div>
                                <span class="font-medium">Category:</span> {{ $dokumen->kategori->nama_kategori ?? 'N/A' }}
                            </div>
                            <div>
                                <span class="font-medium">Division:</span> {{ $dokumen->divisi->nama_divisi ?? 'N/A' }}
                            </div>
                            <div>
                                <span class="font-medium">Rack:</span> {{ $dokumen->rak->nama_rak ?? 'N/A' }}
                            </div>
                            <div>
                                <span class="font-medium">Year:</span> {{ $dokumen->tahun_masuk }}
                            </div>
                            @if($dokumen->no_versi)
                            <div>
                                <span class="font-medium">Version:</span> {{ $dokumen->no_versi }}
                            </div>
                            @endif
                            <div>
                                <span class="font-medium">Status:</span>
                                <span class="px-2 py-1 rounded-full text-xs {{ $dokumen->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($dokumen->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Info -->
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Document Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Document Title</label>
                            <p class="text-gray-900">{{ $dokumen->judul }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <p class="text-gray-900">{{ $dokumen->kategori->nama_kategori ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Division</label>
                            <p class="text-gray-900">{{ $dokumen->divisi->nama_divisi ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rack Location</label>
                            <p class="text-gray-900">{{ $dokumen->rak->nama_rak ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Entry Year</label>
                            <p class="text-gray-900">{{ $dokumen->tahun_masuk }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Version</label>
                            <p class="text-gray-900">{{ $dokumen->no_versi ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <a href="{{ route('public.search') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-900 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Search Results
                    </a>

                    <div class="flex gap-3 flex-wrap">
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dokumen.download', $dokumen->id_dokumen) }}"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download
                                </a>
                                <a href="{{ route('admin.dokumen.edit', $dokumen->id_dokumen) }}"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                                    Edit Document
                                </a>
                            @else
                                <a href="{{ route('dokumen.download', $dokumen->id_dokumen) }}"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
