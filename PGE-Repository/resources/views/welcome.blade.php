@extends('layouts.app')

@section('content')

{{-- ============================
1. HERO SECTION
================================ --}}
<section class="min-h-screen flex items-center bg-white py-10">
    <div class="max-w-screen-xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

        {{-- Left Content --}}
        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-gray-900">
                Platform Repository <br> Dokumen PGE yang 
                <span class="text-[#4A5AA8]">Modern & Efisien.</span>
            </h1>

            <p class="mt-5 text-lg text-gray-600 leading-relaxed">
                PGE Repository menyediakan sistem penyimpanan dokumen terintegrasi untuk mendukung 
                pengelolaan data, kolaborasi, dan akses informasi secara aman dan terpusat.
            </p>
        </div>

        {{-- Right Image --}}
        <div class="flex justify-center">
            <img src="/images/image.png" 
                class="rounded-xl shadow-lg w-full max-h-[380px] object-cover" />
        </div>

    </div>
</section>

{{-- ============================
2. SEARCH DOCUMENT BOX
================================ --}}
<div class="w-full flex justify-center px-4">
    <div class="bg-white w-full max-w-3xl -mt-14 shadow-lg rounded-xl p-5 border text-center">
        <h3 class="text-sm text-gray-700 mb-3">Search Documents</h3>

        <div class="flex gap-3">
            <input type="text" placeholder="Cari dokumen, laporan, atau arsip..."
                class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                Search
            </button>
        </div>
    </div>
</div>

{{-- WRAPPER --}}
<div class="mt-20 px-6 max-w-7xl mx-auto">

    {{-- ============================
    3. POPULAR DOCUMENTS
    ================================= --}}
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-semibold">Popular Documents</h3>
        <a href="#" class="text-blue-700 text-sm hover:underline">View All →</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
        @foreach ([
            ['2024', 'Annual Report PGE 2024 Forecast', '1280 downloads'],
            ['2023', 'Technical Standards Geothermal Operations', '825 downloads'],
            ['2023', 'Safety & Environment Guidelines', '773 downloads'],
            ['2023', 'Project Management Framework', '645 downloads']
        ] as $doc)
            <div class="p-5 bg-white rounded-xl shadow-sm border hover:shadow-md transition">
                <div class="text-gray-600 text-sm mb-1">{{ $doc[0] }}</div>
                <div class="font-semibold mb-2">{{ $doc[1] }}</div>
                <div class="text-gray-500 text-sm">{{ $doc[2] }}</div>
            </div>
        @endforeach
    </div>

    {{-- ============================
    4. LATEST NEWS
    ================================= --}}
    <div class="flex items-center justify-between mt-16 mb-6">
        <h3 class="text-xl font-semibold">Latest News</h3>
        <a href="#" class="text-blue-700 text-sm hover:underline">View All →</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ([1,2,3] as $i)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition">
                <img src="https://picsum.photos/600/400?random={{ $i }}" 
                     class="w-full h-40 object-cover">

                <div class="p-4">
                    <div class="text-gray-500 text-sm mb-1">
                        Nov {{ 5 + $i }}, 2025
                    </div>

                    <h4 class="font-semibold mb-2">
                        @if ($i == 1)
                            PGE Achieves Record Geothermal Production
                        @elseif ($i == 2)
                            New Repository System Launch
                        @else
                            Sustainability Report 2024
                        @endif
                    </h4>

                    <a href="#" class="text-blue-700 text-sm hover:underline">Read More</a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ============================
    5. STATISTICS
    ================================= --}}
    <div class="bg-blue-800 text-white rounded-xl py-12 mt-20 grid grid-cols-1 sm:grid-cols-3 text-center gap-6">
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

</div> {{-- END WRAPPER --}}

@endsection
