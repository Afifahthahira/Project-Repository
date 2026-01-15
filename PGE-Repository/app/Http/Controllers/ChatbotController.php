<?php

namespace App\Http\Controllers;

use App\Models\ChatLog;
use App\Models\ChatSession;
use App\Services\DialogflowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ChatbotController extends Controller
{
    public function __construct(
        protected DialogflowService $dialogflowService
    ) {
    }

    /**
     * Halaman chatbot untuk user.
     */
    public function index()
    {
        return view('chatbot.index');
    }

    /**
     * Endpoint utama untuk mengirim pesan ke chatbot (user & admin).
     */
    public function send(Request $request): JsonResponse
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $user = Auth::user();
        $sessionId = $request->session()->getId();

        $chatSession = ChatSession::firstOrCreate(
            ['session_id' => $sessionId],
            ['session_start' => now()]
        );

        // update session_end setiap ada aktivitas chat
        $chatSession->update(['session_end' => now()]);

        // Simpan pesan user ke log
        $userLog = ChatLog::create([
            'chat_id' => $chatSession->id,
            'detected_intent' => null,
            'sender' => $user?->role === 'admin' ? 'admin' : 'user',
            'timestamp' => Carbon::now(),
            'message_text' => $data['message'],
        ]);

        // Kirim ke Dialogflow
        $dialogflowResult = $this->dialogflowService->detectIntent(
            $data['message'],
            $sessionId
        );

        $replyText = $dialogflowResult['fulfillmentText'] ?? 'Maaf, chatbot belum dapat merespon saat ini.';

        // Simpan balasan chatbot ke log
        $botLog = ChatLog::create([
            'chat_id' => $chatSession->id,
            'detected_intent' => $dialogflowResult['intent'] ?? null,
            'sender' => 'bot',
            'timestamp' => Carbon::now(),
            'message_text' => $replyText,
        ]);

        return response()->json([
            'success' => true,
            'message' => $replyText,
            'intent' => $dialogflowResult['intent'] ?? null,
            'user_log_id' => $userLog->id,
            'bot_log_id' => $botLog->id,
        ]);
    }

    /**
     * Monitoring riwayat chat untuk admin.
     */
    public function history()
    {
        $logs = ChatLog::with('session')
            ->orderByDesc('timestamp')
            ->paginate(20);

        return view('admin.chat-history', [
            'logs' => $logs,
        ]);
    }
}


