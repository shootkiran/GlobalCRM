<?php

namespace App\Filament\Resources\Telegrams\Pages;

use App\Filament\Resources\Telegrams\TelegramResource;
use App\Models\TelegramChat;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Http;

class ListTelegrams extends ListRecords
{
    protected static string $resource = TelegramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('set_webhook')
                ->label('Set Telegram Webhook')
               
                ->action(function ($data) {
                    $token = env('TELEGRAM_TOKEN');
                    $url = "https://api.telegram.org/bot{$token}/setWebhook";
                    $response = Http::get($url, [
                        'url' =>"https://dev4.merosoftnepal.com:8443/telegram/webhook",
                    ]);

                    if ($response->successful() && $response->json('ok')) {
                        Notification::make()
                            ->title('Webhook set successfully')
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Failed to set webhook')
                            ->body($response->json('description') ?? 'Unknown error')
                            ->danger()
                            ->send();
                    }
                }),
            Action::make('get_updates')
                ->label('Get Telegram Updates')

                ->action(function ($data) {
                    $token = env('TELEGRAM_TOKEN');
                    $url = "https://api.telegram.org/bot{$token}/getUpdates";

                    $response = Http::get($url);
                    if (! $response->successful() || ! $response->json('ok')) {
                        Notification::make()
                            ->title('Failed to fetch updates')
                            ->danger()
                            ->body($response->json('description') ?? 'Unknown error')
                            ->send();
                        return;
                    }

                    $updates = $response->json('result');
                    $count = 0;

                    foreach ($updates as $update) {
                        $message = $update['message'] ?? $update['edited_message'] ?? null;

                        if (! $message || ! isset($message['chat'])) {
                            continue;
                        }

                        $chat = $message['chat'];

                        TelegramChat::create([
                            'chat_id' => $chat['id'],
                            'message' => $message['text'] ?? null,
                            'message_id' => $message['message_id'] ?? null,
                            'message_date' => isset($message['date']) ? now()->setTimestamp($message['date']) : now(),
                            'payload' => $message,
                        ]);

                        $count++;
                    }

                    Notification::make()
                        ->title("Fetched {$count} updates")
                        ->success()
                        ->send();
                }),
            Action::make('check_webhook_status')
                ->label('Check Webhook Status')

                ->action(function () {
                    $token = env('TELEGRAM_TOKEN');
                    $url = "https://api.telegram.org/bot{$token}/getWebhookInfo";
                    $response = Http::get($url);
                    if ($response->successful() && $response->json('ok')) {
                        $webhookInfo = $response->json();

                        Notification::make()
                            ->title('Webhook Status')
                            ->success()
                            ->body(
                                'Webhook URL: '.($webhookInfo['result']['url'] ?? 'N/A')."\n".
                                'Has custom certificate: '.($webhookInfo['result']['has_custom_certificate'] ? 'Yes' : 'No')."\n".
                                'Pending updates: '.($webhookInfo['result']['pending_update_count'] ?? 0)
                            )
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Failed to check webhook status')
                            ->danger()
                            ->body($response->json('description') ?? 'Unknown error')
                            ->send();
                    }
                }),

            Action::make('delete_webhook')
                ->label('Delete Telegram Webhook')
                ->action(function ($data) {
                    $token = env('TELEGRAM_TOKEN');
                    $url = "https://api.telegram.org/bot{$token}/deleteWebhook";
                    $response = Http::get($url);

                    if ($response->successful() && $response->json('ok')) {
                        Notification::make()
                            ->title('Webhook deleted successfully')
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Failed to delete webhook')
                            ->body($response->json('description') ?? 'Unknown error')
                            ->danger()
                            ->send();
                    }
                })
        ];
    }
}
