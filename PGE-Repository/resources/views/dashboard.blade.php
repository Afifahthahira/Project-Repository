@extends('layouts.app')

@section('content')
<div class="w-full">

    <!-- Hero Section -->
    <section class="relative bg-blue-900 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-xl font-semibold mb-2">PGE Repository</h1>

        <h2 class="text-3xl font-bold leading-snug mb-4">
            Sistem Manajemen Dokumen Digital PT Pertamina Geothermal Energy
        </h2>

        <p class="text-white/80 max-w-2xl mx-auto">
            Akses dokumen teknis, laporan, dan arsip perusahaan dengan mudah dan aman.
            Platform terpadu untuk seluruh kebutuhan dokumentasi.
        </p>
    </div>

        <!-- Search Card -->
        <div class="absolute left-1/2 -bottom-16 md:-bottom-20 transform -translate-x-1/2 w-full max-w-4xl">
            <div class="bg-white rounded-xl shadow-xl px-6 py-4 flex items-center">
                <input 
                    type="text"
                    class="flex-1 border-0 focus:ring-0 text-gray-700"
                    placeholder="Cari dokumen, laporan, atau arsip..."
                >
                <button class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded-lg">
                    Search
                </button>
            </div>
        </div>
    </section>


    <!-- Main Container -->
    <div class="mt-20 px-6 container mx-auto">

        <!-- Popular Documents -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold">Popular Documents</h3>
            <a href="#" class="text-blue-700 text-sm hover:underline">View All</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Card -->
            @foreach([ 
                ['2024', 'Annual Report PGE 2024 Forecast', '1280'], 
                ['2023', 'Technical Standards Geothermal Operations', '825'], 
                ['2023', 'Safety & Environment Guidelines', '773'], 
                ['2023', 'Project Management Framework', '645'] 
            ] as $doc)
                <div class="p-4 bg-white rounded-xl shadow-sm border">
                    <div class="text-gray-600 text-sm mb-1">{{ $doc[0] }}</div>
                    <div class="font-semibold mb-2">{{ $doc[1] }}</div>
                    <div class="text-gray-500 text-sm">{{ $doc[2] }} downloads</div>
                </div>
            @endforeach
        </div>


        <!-- Latest News -->
        <div class="flex items-center justify-between mt-16 mb-4">
            <h3 class="text-xl font-semibold">Latest News</h3>
            <a href="#" class="text-blue-700 text-sm hover:underline">View All</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([1,2,3] as $news)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <img src="https://picsum.photos/600/400?random={{ $news }}" 
                         class="w-full h-40 object-cover">

                    <div class="p-4">
                        <div class="text-gray-500 text-sm mb-1">
                            {{ ['Nov 15, 2025','Nov 10, 2025','Nov 5, 2025'][$news-1] }}
                        </div>

                        <h4 class="font-semibold mb-2">
                            {{ ['PGE Achieves Record Geothermal Production',
                                'New Repository System Launch',
                                'Sustainability Report 2024'][$news-1] }}
                        </h4>

                        <a href="#" class="text-blue-700 text-sm hover:underline">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>


        <!-- Stats -->
        <div class="bg-blue-800 text-white rounded-xl py-10 mt-16 grid grid-cols-1 sm:grid-cols-3 text-center gap-4">
            
            <div>
                <div class="text-3xl font-bold">12,500+</div>
                <div class="text-sm opacity-80">Total Documents</div>
            </div>

            <div>
                <div class="text-3xl font-bold">45,000+</div>
                <div class="text-sm opacity-80">Total Downloads</div>
            </div>

            <div>
                <div class="text-3xl font-bold">500+</div>
                <div class="text-sm opacity-80">Monthly Updates</div>
            </div>

        </div>

    </div>
</div>
@endsection
