<?php

namespace App\Filament\Resources\TelegramChats\Pages;

use App\Filament\Resources\TelegramChats\TelegramChatResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Http;

class ListTelegramChats extends ListRecords
{
    protected static string $resource = TelegramChatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('set_webhook')
                ->label('Set Telegram Webhook')
                ->schema([
                    TextInput::make('callback_url')->required()->label('Callback URL'),
                    TextInput::make('bot_token')->required()->label('Bot Token'),
                ])
                ->action(function ($data) {
                    $url = "https://api.telegram.org/bot{$data['bot_token']}/setWebhook";
                    $response = Http::get($url, [
                        'url' => $data['callback_url'],
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
            Action::make('delete_webhook')
                ->label('Delete Telegram Webhook')
                ->schema([
                    TextInput::make('bot_token')->required()->label('Bot Token'),
                ])
                ->action(function ($data) {
                    $url = "https://api.telegram.org/bot{$data['bot_token']}/deleteWebhook";
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
