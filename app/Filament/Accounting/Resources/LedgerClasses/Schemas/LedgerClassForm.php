<?php

namespace App\Filament\Accounting\Resources\LedgerClasses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LedgerClassForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('type')
                    ->required(),
            ]);
    }
}
