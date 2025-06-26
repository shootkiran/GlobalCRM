<?php

namespace App\Filament\Resources\TelegramChats\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                Textarea::make('message')
                    ->columnSpanFull(),
                TextInput::make('message_id')
                    ->numeric(),
                Textarea::make('payload')
                    ->columnSpanFull(),
                DateTimePicker::make('message_date'),
            ]);
    }
}
