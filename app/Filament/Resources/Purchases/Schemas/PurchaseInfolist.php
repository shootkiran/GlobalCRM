<?php

namespace App\Filament\Resources\Purchases\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PurchaseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('vendor_id')
                    ->numeric(),
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('total_amount')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
