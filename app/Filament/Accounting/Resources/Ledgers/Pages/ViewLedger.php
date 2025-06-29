<?php

namespace App\Filament\Accounting\Resources\Ledgers\Pages;

use App\Filament\Accounting\Resources\Ledgers\LedgerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLedger extends ViewRecord
{
    protected static string $resource = LedgerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
