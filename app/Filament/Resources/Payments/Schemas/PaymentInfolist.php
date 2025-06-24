<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PaymentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('customer.name')
                    ->numeric(),
                TextEntry::make('invoice.id')
                    ->numeric(),
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('method'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
