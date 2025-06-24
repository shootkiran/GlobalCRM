<?php

namespace App\Filament\Resources\StockItems\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StockItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('sku')
                    ->label('SKU')
                    ->required(),
                TextInput::make('unit')
                    ->required()
                    ->default('pcs'),
                TextInput::make('cost_price')
                    ->required()
                    ->numeric(),
                TextInput::make('selling_price')
                    ->required()
                    ->numeric(),
                TextInput::make('minimum_stock')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
