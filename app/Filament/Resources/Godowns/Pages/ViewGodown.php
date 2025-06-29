<?php

namespace App\Filament\Resources\Godowns\Pages;

use App\Filament\Resources\Godowns\GodownResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGodown extends ViewRecord
{
    protected static string $resource = GodownResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
