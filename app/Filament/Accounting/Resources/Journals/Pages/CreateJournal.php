<?php

namespace App\Filament\Accounting\Resources\Journals\Pages;

use App\Filament\Accounting\Resources\Journals\JournalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJournal extends CreateRecord
{
    protected static string $resource = JournalResource::class;
}
