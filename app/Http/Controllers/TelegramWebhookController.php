<?php

namespace App\Http\Controllers;

use App\Models\TelegramChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $payload = $request->all();
        Log::info('Telegram webhook received', $payload);

        $message = $payload['message'] ?? $payload['edited_message'] ?? null;

        if ($message && isset($message['chat'])) {
            $chat = $message['chat'];

            TelegramChat::updateOrCreate(
                ['chat_id' => $chat['id']],
                [
                    'type'        => $chat['type'] ?? 'unknown',
                    'title'       => $chat['title'] ?? null,
                    'username'    => $chat['username'] ?? null,
                    'first_name'  => $chat['first_name'] ?? null,
                    'last_name'   => $chat['last_name'] ?? null,
                ]
            );
        }

        return response()->json(['ok' => true]);
    }
}
