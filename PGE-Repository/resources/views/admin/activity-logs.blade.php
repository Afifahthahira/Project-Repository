@extends('layouts.admin')

@section('title', 'Activity Logs')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-semibold text-slate-900">Activity Logs</h1>
        <p class="mt-1 text-sm text-slate-500">Track all user activities and document operations</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-lg border border-slate-100 p-5 shadow-sm">
            <p class="text-sm text-slate-500 mb-1">Total Activities</p>
            <p class="text-2xl font-semibold text-slate-900">{{ $totalActivities }}</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-100 p-5 shadow-sm">
            <p class="text-sm text-slate-500 mb-1">Downloads</p>
            <p class="text-2xl font-semibold text-blue-600">{{ $downloads }}</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-100 p-5 shadow-sm">
            <p class="text-sm text-slate-500 mb-1">Uploads</p>
            <p class="text-2xl font-semibold text-green-600">{{ $uploads }}</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-100 p-5 shadow-sm">
            <p class="text-sm text-slate-500 mb-1">Views</p>
            <p class="text-2xl font-semibold text-purple-600">{{ $views }}</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-100 p-5 shadow-sm">
            <p class="text-sm text-slate-500 mb-1">Edits</p>
            <p class="text-2xl font-semibold text-orange-600">{{ $edits }}</p>
        </div>
    </div>

    <!-- Filter and Action Bar -->
    <div class="bg-white rounded-lg border border-slate-100 p-4 shadow-sm mb-6">
        <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1">
                <label class="text-sm font-medium text-slate-700 mb-1 block">Date Filter</label>
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <input type="date" name="date" value="{{ request('date') }}" 
                           class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="flex-1">
                <label class="text-sm font-medium text-slate-700 mb-1 block">Action Type</label>
                <select name="action_type" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Actions</option>
                    <option value="downloaded" {{ request('action_type') == 'downloaded' ? 'selected' : '' }}>Downloaded</option>
                    <option value="uploaded" {{ request('action_type') == 'uploaded' ? 'selected' : '' }}>Uploaded</option>
                    <option value="viewed" {{ request('action_type') == 'viewed' ? 'selected' : '' }}>Viewed</option>
                    <option value="edited" {{ request('action_type') == 'edited' ? 'selected' : '' }}>Edited</option>
                    <option value="deleted" {{ request('action_type') == 'deleted' ? 'selected' : '' }}>Deleted</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800">
                    Filter
                </button>
                @if(request()->hasAny(['date', 'action_type', 'search']))
                    <a href="{{ route('admin.activity-logs.index') }}" class="px-4 py-2 border border-slate-300 rounded-lg hover:bg-slate-50">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Search Bar -->
    <div class="bg-white rounded-lg border border-slate-100 p-4 shadow-sm mb-6">
        <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="flex gap-4">
            <input type="hidden" name="date" value="{{ request('date') }}">
            <input type="hidden" name="action_type" value="{{ request('action_type') }}">
            <div class="flex-1 relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." 
                       class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800">
                Search
            </button>
            <a href="{{ route('admin.activity-logs.export', request()->all()) }}" 
               class="px-4 py-2 border border-slate-300 rounded-lg hover:bg-slate-50">
                Export Logs
            </a>
        </form>
    </div>

    <!-- Activity Log Table -->
    <div class="bg-white rounded-lg border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Action</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Document</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Timestamp</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">IP Address</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse($activities as $activity)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-slate-900">{{ $activity->user->nama ?? 'Unknown' }}</div>
                                <div class="text-sm text-slate-500">{{ $activity->user->email ?? '-' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $actionColors = [
                                'downloaded' => 'bg-blue-100 text-blue-700',
                                'uploaded' => 'bg-green-100 text-green-700',
                                'viewed' => 'bg-purple-100 text-purple-700',
                                'edited' => 'bg-orange-100 text-orange-700',
                                'deleted' => 'bg-red-100 text-red-700',
                            ];
                            $actionIcons = [
                                'downloaded' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />',
                                'uploaded' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />',
                                'viewed' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />',
                                'edited' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />',
                                'deleted' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />',
                            ];
                            $color = $actionColors[$activity->action] ?? 'bg-gray-100 text-gray-700';
                            $icon = $actionIcons[$activity->action] ?? '';
                        @endphp
                        <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium rounded-full {{ $color }}">
                            @if($icon)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    {!! $icon !!}
                                </svg>
                            @endif
                            {{ $activity->action }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-slate-900">{{ $activity->dokumen->judul ?? 'Document Deleted' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-slate-600">{{ $activity->created_at->format('m/d/Y, h:i:s A') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-slate-600">{{ $activity->ip_address ?? '-' }}</div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                        No activity logs found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $activities->appends(request()->query())->links() }}
    </div>
</div>
@endsection

