<?php

namespace App\Filament\Accounting\Resources\Journals\Pages;

use App\Filament\Accounting\Resources\Journals\JournalResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewJournal extends ViewRecord
{
    protected static string $resource = JournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
