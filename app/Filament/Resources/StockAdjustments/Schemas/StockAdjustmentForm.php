<?php

namespace App\Filament\Resources\StockAdjustments\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class StockAdjustmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('reason')
                    ->required(),
                TextInput::make('notes')
                    ->columnSpanFull(),
                Hidden::make('user_id')
                    ->default(auth()->user()->id),

                Repeater::make('stock_adjustment_items')
                    ->label('Stock Adjustment Items')
                    ->relationship()
                    ->reorderable(true)
                    ->table([
                        TableColumn::make('Item'),
                        TableColumn::make('Quantity'),
                        TableColumn::make('Notes'),
                    ])
                    ->schema([

                        Select::make('stock_item_id')
                            ->label('Item')
                            ->required()
                            ->relationship('stock_item', 'name'),
                        TextInput::make('quantity')
                            ->numeric()
                            ->default(1)
                            ->required(),
                        TextInput::make('notes'), 
                    ])
                    ->defaultItems(1)
                    // ->columns(4)
                    ->columnSpanFull(),
            ]);
    }
}
