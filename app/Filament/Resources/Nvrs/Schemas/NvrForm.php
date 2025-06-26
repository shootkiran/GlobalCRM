<?php

namespace App\Filament\Resources\Nvrs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NvrForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('ip')
                    ->required(),
                TextInput::make('gps'),
                TextInput::make('location')
                    ->required(),
                Select::make('customer_id')
                    ->relationship('customer', 'name'),
                MultiSelect::make('telegrams')
                    ->relationship('telegrams', 'title') // or 'username' or 'first_name'
                    ->label('Notification Recipients')
                    ->searchable()
                    ->preload(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
