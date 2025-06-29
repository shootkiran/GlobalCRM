<?php

namespace App\Filament\Accounting\Resources\LedgerClasses\Pages;

use App\Filament\Accounting\Resources\LedgerClasses\LedgerClassResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLedgerClass extends ViewRecord
{
    protected static string $resource = LedgerClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
