<?php

namespace App\Filament\Resources\Nvrs\Pages;

use App\Filament\Resources\Nvrs\NvrResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewNvr extends ViewRecord
{
    protected static string $resource = NvrResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
