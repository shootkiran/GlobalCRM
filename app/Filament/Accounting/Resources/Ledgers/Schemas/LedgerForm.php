<?php

namespace App\Filament\Accounting\Resources\Ledgers\Schemas;

use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class LedgerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('ledger_class_id')
                    ->required()
                    ->relationship('ledger_class', 'name'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('code')
                    ->required(),
                Toggle::make('default_account'),
                Select::make('parent_id')
                    ->relationship('parent', 'name'),
            ]);
    }
}
