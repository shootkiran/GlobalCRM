<?php

namespace App\Filament\Accounting\Resources\LedgerClasses\Pages;

use App\Filament\Accounting\Resources\LedgerClasses\LedgerClassResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLedgerClass extends EditRecord
{
    protected static string $resource = LedgerClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
