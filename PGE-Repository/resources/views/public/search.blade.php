@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">

    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Search Results</h1>
                    <p class="text-gray-600 mt-1">
                        @if($keyword)
                            Showing results for: <span class="font-medium text-blue-600">"{{ $keyword }}"</span>
                        @else
                            Search results
                        @endif
                    </p>
                </div>
                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <form action="{{ route('public.search') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <input type="text"
                       name="q"
                       value="{{ $keyword ?? '' }}"
                       placeholder="Search documents, reports, or archives..."
                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition whitespace-nowrap">
                    Search
                </button>
            </form>
        </div>
    </div>

    <!-- Results -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        @if($dokumen->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($dokumen as $doc)
                    <div class="bg-white rounded-xl shadow-sm border hover:shadow-md transition p-6">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h3 class="font-semibold text-lg text-gray-900 mb-1">{{ $doc->judul }}</h3>
                                <div class="text-sm text-gray-500 space-y-1">
                                    <div>Category: {{ $doc->kategori->nama_kategori ?? 'N/A' }}</div>
                                    <div>Division: {{ $doc->divisi->nama_divisi ?? 'N/A' }}</div>
                                    <div>Rack: {{ $doc->rak->nama_rak ?? 'N/A' }}</div>
                                    <div>Year: {{ $doc->tahun_masuk }}</div>
                                    @if($doc->no_versi)
                                        <div>Version: {{ $doc->no_versi }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t">
                            <span class="text-sm text-gray-500">Status: {{ ucfirst($doc->status) }}</span>
                            @auth
                                <a href="{{ route('dokumen.view', $doc->id_dokumen) }}"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View
                                </a>
                            @else
                                <span class="text-sm text-gray-400">Login to view</span>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination would go here if needed -->
        @else
            <div class="text-center py-16">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No documents found</h3>
                <p class="text-gray-600 mb-6">
                    @if($keyword)
                        We couldn't find any documents matching "{{ $keyword }}".
                    @else
                        Start searching for documents.
                    @endif
                </p>
                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Back to Home
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
