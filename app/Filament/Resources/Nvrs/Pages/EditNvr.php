<?php

namespace App\Filament\Resources\Nvrs\Pages;

use App\Filament\Resources\Nvrs\NvrResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditNvr extends EditRecord
{
    protected static string $resource = NvrResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
