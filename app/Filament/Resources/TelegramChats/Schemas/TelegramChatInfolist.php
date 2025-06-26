<?php

namespace App\Filament\Resources\TelegramChats\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TelegramChatInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('chat_id')
                    ->numeric(),
                TextEntry::make('message_id')
                    ->numeric(),
                TextEntry::make('message_date')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
