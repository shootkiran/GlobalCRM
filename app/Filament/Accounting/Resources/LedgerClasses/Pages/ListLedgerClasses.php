<?php

namespace App\Filament\Accounting\Resources\LedgerClasses\Pages;

use App\Filament\Accounting\Resources\LedgerClasses\LedgerClassResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLedgerClasses extends ListRecords
{
    protected static string $resource = LedgerClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
