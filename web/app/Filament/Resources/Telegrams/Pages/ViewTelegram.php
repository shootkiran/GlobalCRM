<?php

namespace App\Filament\Resources\Telegrams\Pages;

use App\Filament\Resources\Telegrams\TelegramResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTelegram extends ViewRecord
{
    protected static string $resource = TelegramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
