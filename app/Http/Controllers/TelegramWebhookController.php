<?php

namespace App\Http\Controllers;

use App\Models\Telegram;
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
        if (isset($payload['message'])) {
            $message = $payload['message'];
            $chat = $message['chat'] ?? [];

            Telegram::updateOrCreate(
                ['chat_id' => $chat['id']],
                [
                    'type' => $chat['type'] ?? 'private',
                    'title' => $chat['title'] ?? $chat['first_name']." ".$chat['last_name'],
                    'username' => $chat['username'] ?? null,
                    'first_name' => $chat['first_name'] ?? null,
                    'last_name' => $chat['last_name'] ?? null,
                    'active' => true,
                ]
            );

            // Optionally: respond to `/start` or other commands
        }
        if (isset($payload['my_chat_member'])) {
            $chat = $payload['my_chat_member']['chat'] ?? [];
            $status = $payload['my_chat_member']['new_chat_member']['status'] ?? null;

            Telegram::updateOrCreate(
                ['chat_id' => $chat['id']],
                [
                    'type' => $chat['type'] ?? 'group',
                    'title' => $chat['title'] ?? null,
                    'username' => $chat['username'] ?? null,
                    'first_name' => $chat['first_name'] ?? null,
                    'last_name' => $chat['last_name'] ?? null,
                    'active' => $status === 'member', // mark active if bot is added
                ]
            );
        }
        if ($message && isset($message['chat'])) {
            $chat = $message['chat'];
            TelegramChat::create([
                'chat_id' => $chat['id'],
                'message' => $message['text'] ?? null,
                'message_id' => $message['message_id'] ?? null,
                'message_date' => isset($message['date']) ? now()->setTimestamp($message['date']) : now(),
                'payload' => $message,
            ]);
        }

        return response()->json(['ok' => true]);
    }
}
