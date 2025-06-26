<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();
        // handle the message or command
        Log::info('Telegram webhook received:', $data);

        return response()->json(['status' => 'ok']);
    }
}
