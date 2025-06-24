<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('subject')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('support_category_id')
                    ->numeric(),
                TextInput::make('support_team_id')
                    ->numeric(),
                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
                TextInput::make('started_by')
                    ->numeric(),
                TextInput::make('completed_by')
                    ->numeric(),
                TextInput::make('closed_by')
                    ->numeric(),
                DateTimePicker::make('started_at'),
                DateTimePicker::make('completed_at'),
                DateTimePicker::make('closed_at'),
                TextInput::make('priority')
                    ->required()
                    ->default('normal'),
                TextInput::make('status')
                    ->required()
                    ->default('new'),
            ]);
    }
}
