@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Monitoring Riwayat Chatbot</h1>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Waktu</th>
                    <th class="px-4 py-2 text-left">Session</th>
                    <th class="px-4 py-2 text-left">Sender</th>
                    <th class="px-4 py-2 text-left">Intent</th>
                    <th class="px-4 py-2 text-left">Message</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr class="border-t">
                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ optional($log->timestamp)->format('d-m-Y H:i') ?? $log->created_at->format('d-m-Y H:i') }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $log->session->session_id ?? '-' }}
                        </td>
                        <td class="px-4 py-2 capitalize">
                            {{ $log->sender ?? '-' }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $log->detected_intent ?? '-' }}
                        </td>
                        <td class="px-4 py-2 max-w-xl">
                            <div class="truncate" title="{{ $log->message_text }}">
                                {{ $log->message_text }}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                            Belum ada riwayat chat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>
@endsection


