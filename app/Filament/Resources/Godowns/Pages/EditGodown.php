<?php

namespace App\Filament\Resources\Godowns\Pages;

use App\Filament\Resources\Godowns\GodownResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditGodown extends EditRecord
{
    protected static string $resource = GodownResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
