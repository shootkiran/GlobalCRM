<?php

namespace App\Filament\Resources\StockAdjustments\Schemas;

use App\Models\Godown;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater\TableColumn;

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
                        TableColumn::make('Adj. Type'),
                        TableColumn::make('Quantity'),
                        TableColumn::make('Notes'),
                    ])
                    ->schema([

                        Select::make('stock_item_id')
                            ->label('Item')
                            ->required()
                            ->relationship('stock_item', 'name'),
                        Select::make('type')
                            ->label('Item')
                            ->required()
                            ->dehydrated(false)
                            ->options([
                                'addition' => 'Addition',
                                'deduction' => 'Deduction',
                            ])
                            ->default('deduction')
                            ->afterStateUpdated(function ($set, $get, $state) {
                                $set('quantity', ($get('quantity_abs') ?? '') * ($state === 'deduction' ? -1 : 1));
                            }),
                        TextInput::make('quantity_abs')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->dehydrated(false)
                            ->afterStateUpdated(function ($set, $get, $state) {
                                $set('quantity', ($state ?? '') * ($get('type') === 'deduction' ? -1 : 1));
                            }),
                        // ->afterStateUpdatedJs(<<<JS function ($state, $set, $get) {
                        //     $set('quantity', $state * ($get('type') === 'deduction' ? -1 : 1));
                        // }>>JS),
                        Hidden::make('quantity'),
                        Hidden::make('godown_id')
                            ->default(fn ($get) => Godown::first()?->id),
                        TextInput::make('notes'),
                    ])
                    ->defaultItems(1)
                    // ->columns(4)
                    ->columnSpanFull(),
            ]);
    }
}
