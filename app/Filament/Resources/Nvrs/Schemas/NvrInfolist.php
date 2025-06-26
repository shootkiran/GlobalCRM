<?php

namespace App\Filament\Resources\Nvrs\Schemas;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class NvrInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('ip'),
                TextEntry::make('lat')
                ->label('Gps')
                ->formatStateUsing(fn ($record) => $record->lat.",".$record->lng),
                TextEntry::make('location'),
                TextEntry::make('customer.name')
                    ->label('Customer')
                    ->url(fn ($record) => CustomerResource::getUrl('view', ['record' => $record]))
                ,
                IconEntry::make('reachable')
                    ->boolean(),
                TextEntry::make('last_changed')
                    ->dateTime()
                    ->since(),

            ]);
    }
}
