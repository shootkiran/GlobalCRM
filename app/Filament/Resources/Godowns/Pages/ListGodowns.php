<?php

namespace App\Filament\Resources\Godowns\Pages;

use App\Filament\Resources\Godowns\GodownResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGodowns extends ListRecords
{
    protected static string $resource = GodownResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
