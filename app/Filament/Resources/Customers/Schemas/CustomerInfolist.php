<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\CustomerType;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CustomerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('location.name')
                    ->label('location'),
                TextEntry::make('type'),
                TextEntry::make('pan')->visible(fn ($record) => $record->type == CustomerType::ORGANISATION),
                TextEntry::make('balance')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
