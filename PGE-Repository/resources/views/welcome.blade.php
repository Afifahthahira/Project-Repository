@extends('layouts.app')

@section('content')

{{-- ============================
1. HERO SECTION
================================ --}}
<section class="min-h-screen flex items-center bg-white py-10 px-4">
    <div class="max-w-screen-xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">

        {{-- Left Content --}}
        <div class="text-center lg:text-left">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-extrabold leading-tight text-gray-900">
                Platform Repository <br class="hidden sm:block"> Dokumen PGE yang
                <span class="text-[#4A5AA8]">Modern & Efisien.</span>
            </h1>

            <p class="mt-4 sm:mt-6 text-base sm:text-lg lg:text-xl text-gray-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                PGE Repository menyediakan sistem penyimpanan dokumen terintegrasi untuk mendukung
                pengelolaan data, kolaborasi, dan akses informasi secara aman dan terpusat.
            </p>
        </div>

        {{-- Right Image --}}
        <div class="flex justify-center lg:justify-end mt-8 lg:mt-0">
            <img src="/images/image.png"
                class="rounded-xl shadow-lg w-full max-w-sm sm:max-w-md lg:max-w-lg xl:max-w-xl h-auto object-cover" />
        </div>

    </div>
</section>

{{-- ============================
2. SEARCH DOCUMENT BOX
================================ --}}
<div class="w-full flex justify-center px-4 sm:px-6 lg:px-8">
    <form action="{{ route('public.search') }}" method="GET" class="bg-white w-full max-w-4xl -mt-14 shadow-lg rounded-xl p-4 sm:p-6 lg:p-8 border text-center">
        <h3 class="text-sm sm:text-base text-gray-700 mb-4">Search Documents</h3>

        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
            <input type="text"
                   name="q"
                   placeholder="Search documents, reports, or archives..."
                   class="flex-1 border border-gray-300 rounded-lg px-4 py-3 sm:py-4 focus:ring-2 focus:ring-blue-400 focus:border-transparent text-sm sm:text-base transition-colors"
                   required>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-medium transition whitespace-nowrap text-sm sm:text-base">
                Search
            </button>
        </div>

        <p class="text-xs sm:text-sm text-gray-500 mt-3">Search through our extensive collection of PGE documents</p>
    </form>
</div>

{{-- WRAPPER --}}
<div class="mt-16 sm:mt-20 px-4 sm:px-6 max-w-7xl mx-auto">

    {{-- ============================
    3. POPULAR DOCUMENTS
    ================================= --}}
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg sm:text-xl font-semibold">Popular Documents</h3>
        <a href="#" class="text-blue-700 text-sm hover:underline">View All →</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
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
    <div class="flex items-center justify-between mt-12 sm:mt-16 mb-6">
        <h3 class="text-lg sm:text-xl font-semibold">Latest News</h3>
        <a href="#" class="text-blue-700 text-sm hover:underline">View All →</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">
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
    <div class="bg-blue-800 text-white rounded-xl py-8 sm:py-12 mt-16 sm:mt-20 grid grid-cols-1 sm:grid-cols-3 text-center gap-6 sm:gap-8">
        <div class="px-4">
            <div class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2">12,500+</div>
            <div class="text-sm sm:text-base opacity-80">Total Documents</div>
        </div>

        <div class="px-4">
            <div class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2">45,000+</div>
            <div class="text-sm sm:text-base opacity-80">Total Downloads</div>
        </div>

        <div class="px-4">
            <div class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2">500+</div>
            <div class="text-sm sm:text-base opacity-80">Monthly Updates</div>
        </div>
    </div>

</div> {{-- END WRAPPER --}}

@endsection
