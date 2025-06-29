<?php

namespace App\Filament\Accounting\Resources\Ledgers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LedgerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('ledger_class_id')
                    ->numeric(),
                TextEntry::make('name'),
                TextEntry::make('code'),
                TextEntry::make('parent_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
