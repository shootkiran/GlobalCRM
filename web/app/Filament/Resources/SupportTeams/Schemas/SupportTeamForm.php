<?php

namespace App\Filament\Resources\SupportTeams\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SupportTeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
