<?php

namespace App\Filament\Resources\StockItems\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StockItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('sku')
                    ->label('SKU'),
                TextEntry::make('unit'),
                TextEntry::make('cost_price')
                    ->numeric(),
                TextEntry::make('selling_price')
                    ->numeric(),
                TextEntry::make('minimum_stock')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
