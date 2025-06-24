<?php

namespace App\Filament\Resources\Purchases\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PurchaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vendor_id')
                    ->searchable()
                    ->required()
                    ->relationship('vendor', 'name')
                    ->createOptionForm([
                        TextInput::make('name'),
                    ]),
                DatePicker::make('date')
                    ->default(today())
                    ->required(),
                TextInput::make('total_amount')
                    ->readOnly()
                    ->default(0),
                Repeater::make('purchase_items')
                    ->label('Purchase Items')
                    ->relationship()
                    ->reorderable(true)
                    ->table([
                        TableColumn::make('stock_item_id'),
                        TableColumn::make('quantity'),
                        TableColumn::make('unit_cost'),
                        TableColumn::make('total_cost'),
                    ])
                    ->schema([

                        Select::make('stock_item_id')
                            ->label('Item')
                            // ->searchable() //there is bug of showing somewhere else
                            ->required()
                            ->relationship('stock', 'name'),
                        TextInput::make('quantity')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, $set, $get) {
                                $set('total_cost', (float) $get('quantity') * (float) $get('unit_cost'));
                            }),

                        TextInput::make('unit_cost')
                            ->numeric()
                            ->live(onBlur: true)

                            ->afterStateUpdated(function ($state, $set, $get) {
                                $set('total_cost', (float) $get('quantity') * (float) $get('unit_cost'));
                            })
                            ->required(),

                        TextInput::make('total_cost')
                            ->live()
                            ->numeric()
                            ->readOnly()
                        ,
                    ])
                    ->live()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $items = $state ?? [];
                        $totalAmount = collect($items)->sum(function ($item) {
                            return (float) ($item['quantity'] ?? 0) * (float) ($item['unit_cost'] ?? 0);
                        });
                        $set('total_amount', $totalAmount);
                    })
                    ->defaultItems(1)
                    // ->columns(4)
                    ->columnSpanFull(),
            ]);
    }
}
