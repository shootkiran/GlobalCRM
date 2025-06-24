<?php

namespace App\Filament\Resources\Invoices\Schemas;

use App\InvoiceStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer_id')
                    ->label('Customer')
                    ->relationship('customer', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                DatePicker::make('date')
                    ->default(now())
                    ->required(),


                Select::make('status')
                    ->default('draft')
                    ->options(InvoiceStatus::class)
                    ->required()
                    ->disabled(),

                Textarea::make('note')
                    ->label('Note')
                    ->rows(2)
                    ->columnSpanFull(),

                Repeater::make('items')
                    ->label('Invoice Items')
                    ->relationship()
                    ->reorderable(true)
                    ->table([
                        TableColumn::make('itemable_type'),
                        TableColumn::make('itemable_id'),
                        TableColumn::make('quantity'),
                        TableColumn::make('unit_price'),
                        TableColumn::make('total_price'),
                    ])
                    ->schema([
                        Select::make('itemable_type')
                            ->label('Item Type')
                            ->options([
                                \App\Models\StockItem::class => 'Product',
                                \App\Models\Service::class => 'Service',
                            ])
                            ->required()
                            ->live(),

                        Select::make('itemable_id')
                            ->label('Item')
                            ->required()
                            ->options(function (callable $get) {
                                $type = $get('itemable_type');

                                if ($type === \App\Models\StockItem::class) {
                                    return \App\Models\StockItem::pluck('name', 'id');
                                }

                                if ($type === \App\Models\Service::class) {
                                    return \App\Models\Service::pluck('name', 'id');
                                }

                                return [];
                            })
                            ->visible(fn (callable $get) => filled($get('itemable_type'))),

                        TextInput::make('quantity')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, $set, $get) {
                                $set('total_price', (float) $get('quantity') * (float) $get('unit_price'));
                            }),

                        TextInput::make('unit_price')
                            ->numeric()
                            ->live(onBlur: true)

                            ->afterStateUpdated(function ($state, $set, $get) {
                                $set('total_price', (float) $get('quantity') * (float) $get('unit_price'));
                            })
                            ->required(),

                        TextInput::make('total_price')
                            ->live()
                            ->numeric()
                            ->readOnly()
                        ,
                    ])
                    ->live()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $items = $state ?? [];
                        $totalAmount = collect($items)->sum(function ($item) {
                            return (float) ($item['quantity'] ?? 0) * (float) ($item['unit_price'] ?? 0);
                        });
                        $set('total_amount', $totalAmount);
                    })
                    ->defaultItems(1)
                    // ->columns(4)
                    ->columnSpanFull(),
                TextInput::make('total_amount')->default(0)
            ]);
    }
}