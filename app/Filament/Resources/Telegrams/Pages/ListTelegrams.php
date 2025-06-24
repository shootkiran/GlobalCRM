<?php

namespace App\Filament\Resources\Telegrams\Pages;

use App\Filament\Resources\Telegrams\TelegramResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTelegrams extends ListRecords
{
    protected static string $resource = TelegramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
