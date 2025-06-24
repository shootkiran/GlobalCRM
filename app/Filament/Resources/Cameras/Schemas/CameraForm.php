<?php

namespace App\Filament\Resources\Cameras\Schemas;

use App\Models\Nvr;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CameraForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('customer_id'),
                Select::make('nvr_id')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($set, $state) {
                        if ($state) {
                            $nvr = Nvr::find($state);
                            $set('customer_id', $nvr->customer_id);
                        } else {
                            $set('customer_id', null);
                        }
                    })
                    ->relationship('nvr', 'name'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('ip')
                    ->required(),
                Toggle::make('reachable')
                    ->required(),
                TextInput::make('location')
                    ->required(),
                DateTimePicker::make('last_changed'),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
