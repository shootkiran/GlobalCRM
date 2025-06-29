<?php

namespace App\Filament\Resources\Invoices\Schemas;

use App\Models\Ledger;
use Filament\Forms;
use App\AccountType;
use App\InvoiceStatus;
use App\Models\Godown;
use App\Models\Service;
use App\Models\StockItem;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater\TableColumn;

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
                        TableColumn::make('Item Type'),
                        TableColumn::make('Item'),

                        TableColumn::make('quantity'),
                        TableColumn::make('Unit Price'),
                        TableColumn::make('Sub Total'),
                    ])
                    ->schema([
                        Select::make('itemable_type')
                            ->label('Item Type')
                            ->options([
                                StockItem::class => 'Product',
                                Service::class => 'Service',
                            ])
                            ->afterStateUpdated(fn ($state, $set) => $state == StockItem::class ? $set('godown_id', Godown::first()?->id) : $set('godown_id', null))
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
                        Hidden::make('godown_id'),

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
                TextInput::make('total_amount')->default(0),
                Toggle::make('payment_received')
                    ->label('Payment Received')
                    ->live(),

                Section::make([
                    Select::make('receive_ledger_id')
                        ->label('Received In')
                        ->options(function (callable $get) {
                            return Ledger::where('cash_bank', true)->pluck('name', 'id');
                        })
                        ->default(fn () => Ledger::where('default_account', true)->first()?->id)
                        ->required(),


                    Textarea::make('payment_note')
                        ->label('Payment Note')
                        ->rows(2),

                    TextInput::make('payment_amount')
                        ->label('Amount')
                        ->numeric()
                        ->default(fn (callable $get) => $get('total_amount')),
                ])
                    ->visible(fn (callable $get) => $get('payment_received') === true)
                    ->columns(2)
                    ->columnSpanFull()
            ]);
    }
}