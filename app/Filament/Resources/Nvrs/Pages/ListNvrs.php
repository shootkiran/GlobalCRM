<?php

namespace App\Filament\Resources\Nvrs\Pages;

use App\Filament\Resources\Nvrs\NvrResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNvrs extends ListRecords
{
    protected static string $resource = NvrResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
