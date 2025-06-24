<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\CustomerType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('type')
                    ->required()
                    ->options(CustomerType::class)
                    ->live()
                    ->default('personal'),
                TextInput::make('name')
                    ->required(),
                Select::make('location_id')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->relationship('location', 'name'),
                TextInput::make('pan')
                ->required()
                ->visible(fn ($get) => $get('type') == CustomerType::ORGANISATION),
            ]);
    }
}
