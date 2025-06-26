<?php

namespace App\Filament\Resources\Telegrams\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TelegramInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('chat_id')
                    ->numeric(),
                TextEntry::make('type'),
                TextEntry::make('title'),
                TextEntry::make('username'),
                TextEntry::make('first_name'),
                TextEntry::make('last_name'),
                TextEntry::make('user_id')
                    ->numeric(),
                IconEntry::make('active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
