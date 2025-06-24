<?php

namespace App\Filament\Resources\Vendors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VendorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('contact'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
