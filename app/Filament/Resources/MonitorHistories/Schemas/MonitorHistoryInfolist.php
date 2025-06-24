<?php

namespace App\Filament\Resources\MonitorHistories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MonitorHistoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('monitorable_type'),
                TextEntry::make('monitorable_id')
                    ->numeric(),
                TextEntry::make('log'),
                TextEntry::make('state'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
