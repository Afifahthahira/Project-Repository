@extends('layouts.admin')

@section('content')

<div class="px-6 py-4 space-y-8">

    {{-- ===================== TOP CARDS ===================== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="p-6 bg-white shadow-md rounded-2xl border border-gray-100">
            <div class="text-4xl font-semibold text-blue-700">{{ $totalDocuments }}</div>
            <div class="text-gray-500 text-sm mt-1">Total Documents</div>
        </div>

        <div class="p-6 bg-white shadow-md rounded-2xl border border-gray-100">
            <div class="text-4xl font-semibold text-green-600">{{ $totalUsers }}</div>
            <div class="text-gray-500 text-sm mt-1">Total Users</div>
        </div>

        <div class="p-6 bg-white shadow-md rounded-2xl border border-gray-100">
            <div class="text-4xl font-semibold text-purple-600">{{ $totalDownloads }}</div>
            <div class="text-gray-500 text-sm mt-1">Total Downloads</div>
        </div>

        <div class="p-6 bg-white shadow-md rounded-2xl border border-gray-100">
            <div class="text-4xl font-semibold text-orange-600">{{ $totalViews }}</div>
            <div class="text-gray-500 text-sm mt-1">Total Views</div>
        </div>

    </div>


    {{-- ===================== 2 COLUMN LAYOUT ===================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ---------- LEFT: DOWNLOAD CHART ---------- --}}
        <div class="col-span-2 bg-white shadow-md rounded-2xl border border-gray-100 p-6">
            <div class="font-semibold text-gray-700 mb-6">Document Downloads</div>

            <div class="space-y-4">
                @foreach ($monthlyDownloads as $month => $val)
                    <div class="flex items-center gap-4">
                        <span class="w-12 text-gray-600 text-sm">{{ $month }}</span>

                        <div class="h-2 bg-blue-700 rounded-full transition-all"
                            style="width: {{ max($val * 2, 8) }}px">
                        </div>

                        <span class="text-gray-700 text-xs">{{ $val }}</span>
                    </div>
                @endforeach
            </div>
        </div>


        {{-- ---------- RIGHT: POPULAR DOCUMENTS ---------- --}}
        <div class="bg-white shadow-md rounded-2xl border border-gray-100 p-6">
            <div class="font-semibold text-gray-700 mb-6">Popular Documents</div>

            <div class="space-y-4">
                @foreach ($popularDocuments as $doc)
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-700">{{ $doc->title }}</span>

                        <div class="flex items-center gap-2 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="7 10 12 15 17 10" />
                                <line x1="12" y1="15" x2="12" y2="3" />
                            </svg>
                            <span class="text-sm">{{ $doc->downloads }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>



    {{-- ===================== RECENT ACTIVITY ===================== --}}
    <div class="bg-white shadow-md rounded-2xl border border-gray-100 p-6">

        <div class="font-semibold text-gray-700 mb-6">Recent Activity</div>

        <table class="w-full text-sm">
            <thead class="text-gray-500 border-b">
                <tr>
                    <th class="p-3 text-left">User</th>
                    <th class="p-3 text-left">Action</th>
                    <th class="p-3 text-left">Document</th>
                    <th class="p-3 text-left">Time</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">
                @foreach ($recentActivities as $activity)
                    <tr class="border-b">
                        <td class="p-3">{{ $activity->user->name }}</td>
                        <td class="p-3">{{ $activity->action }}</td>
                        <td class="p-3">{{ $activity->document->title }}</td>
                        <td class="p-3">{{ $activity->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

@endsection
