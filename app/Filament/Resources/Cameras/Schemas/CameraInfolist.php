<?php

namespace App\Filament\Resources\Cameras\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CameraInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nvr_id')
                    ->numeric(),
                TextEntry::make('name'),
                TextEntry::make('ip'),
                IconEntry::make('reachable')
                    ->boolean(),
                TextEntry::make('location'),
                TextEntry::make('customer.name')
                    ,
                TextEntry::make('last_changed')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
