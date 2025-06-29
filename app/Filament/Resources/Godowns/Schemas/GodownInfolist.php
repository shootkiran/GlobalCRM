<?php

namespace App\Filament\Resources\Godowns\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class GodownInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('location'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
