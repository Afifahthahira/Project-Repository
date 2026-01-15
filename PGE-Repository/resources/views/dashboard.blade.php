@extends('layouts.app')

@section('content')
<div class="w-full bg-gray-50 min-h-screen">

    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold mb-2">Welcome back, {{ $user->nama }}!<h1>
                    <p class="text-blue-100 text-sm sm:text-base">
                        @if($user->divisi)
                            {{ $user->divisi->nama_divisi ?? 'PGE Repository' }}
                        @else
                            PGE Repository
                        @endif
                    </p>
                </div>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg transition text-sm sm:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <form action="{{ route('public.search') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <input
                    type="text"
                    name="q"
                    class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                    placeholder="Search documents, reports, or archives..."
                    required
                >
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition whitespace-nowrap text-sm sm:text-base">
                    Search
                </button>
            </form>
        </div>
    </div>


    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Personal Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm mb-1">My Downloads</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $myDownloads }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm mb-1">My Views</p>
                        <p class="text-2xl font-bold text-green-600">{{ $myViews }}</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Quick Access</p>
                        <p class="text-2xl font-bold text-purple-600">
                            <a href="{{ route('user.documents') }}" class="hover:underline">Documents</a>
                        </p>
                    </div>
                    <div class="bg-purple-100 rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        @if($recentActivities->count() > 0)
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg sm:text-xl font-semibold text-gray-900">Recent Activity</h3>
                <a href="{{ route('user.documents') }}" class="text-blue-600 text-sm hover:underline">View All →</a>
            </div>
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <div class="divide-y">
                    @foreach($recentActivities as $activity)
                        <div class="p-4 hover:bg-gray-50 transition">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-medium">
                                            {{ ucfirst($activity->action) }}
                                        </span>
                                        <span class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-900 font-medium">
                                        {{ $activity->dokumen->judul ?? 'Document' }}
                                    </p>
                                </div>
                                @if($activity->dokumen)
                                    <a href="{{ route('dokumen.view', $activity->dokumen->id_dokumen) }}" 
                                       class="ml-4 px-3 py-1 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition text-sm">
                                        View
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Recommended Documents (Based on Your Division) -->
        @if($recommendedDocs->count() > 0)
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900">Recommended for You</h3>
                    <p class="text-sm text-gray-500">Documents from your division</p>
                </div>
                <a href="{{ route('user.documents') }}" class="text-blue-600 text-sm hover:underline">View All →</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach($recommendedDocs as $doc)
                    <div class="bg-white rounded-xl shadow-sm border hover:shadow-md transition p-5">
                        <div class="mb-3">
                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $doc->tahun_masuk }}</span>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $doc->judul }}</h4>
                        <div class="text-sm text-gray-500 mb-4 space-y-1">
                            <div>Category: {{ $doc->kategori->nama_kategori ?? 'N/A' }}</div>
                            <div>Rack: {{ $doc->rak->nama_rak ?? 'N/A' }}</div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('dokumen.view', $doc->id_dokumen) }}" 
                               class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 text-sm font-medium">
                                View
                            </a>
                            <span class="text-gray-300">|</span>
                            <a href="{{ route('dokumen.download', $doc->id_dokumen) }}" 
                               class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Popular Documents -->
        @if($popularDocs->count() > 0)
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg sm:text-xl font-semibold text-gray-900">Popular Documents</h3>
                <a href="{{ route('user.documents') }}" class="text-blue-600 text-sm hover:underline">View All →</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($popularDocs as $doc)
                    <div class="bg-white rounded-xl shadow-sm border hover:shadow-md transition p-5">
                        <div class="text-gray-600 text-sm mb-1">{{ $doc->tahun_masuk }}</div>
                        <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $doc->judul }}</h4>
                        <div class="text-gray-500 text-sm mb-3">
                            {{ $doc->kategori->nama_kategori ?? 'N/A' }}
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('dokumen.view', $doc->id_dokumen) }}" 
                               class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                View →
                            </a>
                            <a href="{{ route('dokumen.download', $doc->id_dokumen) }}" 
                               class="text-green-600 hover:text-green-700 text-sm font-medium">
                                Download →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
