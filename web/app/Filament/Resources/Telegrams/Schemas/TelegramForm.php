<?php

namespace App\Filament\Resources\Telegrams\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TelegramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('chat_id')
                    ->required(),
                TextInput::make('user_id')
                    ->numeric(),
                Toggle::make('active')
                    ->required(),
            ]);
    }
}
