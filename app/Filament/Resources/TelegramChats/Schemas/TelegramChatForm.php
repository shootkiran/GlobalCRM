<?php

namespace App\Filament\Resources\TelegramChats\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TelegramChatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('chat_id')
                    ->required()
                    ->numeric(),
                TextInput::make('type')
                    ->required(),
                TextInput::make('title'),
                TextInput::make('username'),
                TextInput::make('first_name'),
                TextInput::make('last_name'),
                TextInput::make('user_id')
                    ->numeric(),
            ]);
    }
}
