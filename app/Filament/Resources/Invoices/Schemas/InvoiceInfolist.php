<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Schema;

class InvoiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('customer.name')
                    ->label('Customer'),

                TextEntry::make('date')
                    ->date(),

                TextEntry::make('status')
                    ->badge(),

                TextEntry::make('total_amount')
                    ->money('USD'),

                TextEntry::make('created_at')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->dateTime(),

                RepeatableEntry::make('items')
                    ->label('Invoice Items')
                    ->columns(4)
                    ->schema([
                        TextEntry::make('itemable.name')
                            ->label('Item'),

                        TextEntry::make('quantity')
                            ->numeric(),

                        TextEntry::make('unit_price')
                            ->money('USD'),

                        TextEntry::make('total_price')
                            ->money('USD'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}