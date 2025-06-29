<?php

namespace App\Filament\Resources\Godowns\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GodownForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('location'),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
