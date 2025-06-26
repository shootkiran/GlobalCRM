<?php

namespace App\Filament\Resources\VendorPayments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VendorPaymentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('vendor_id')
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
