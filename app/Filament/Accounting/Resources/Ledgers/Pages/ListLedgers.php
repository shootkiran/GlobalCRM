<?php

namespace App\Filament\Accounting\Resources\Ledgers\Pages;

use App\Filament\Accounting\Resources\Ledgers\LedgerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLedgers extends ListRecords
{
    protected static string $resource = LedgerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
