<?php

namespace App\Filament\Resources\MonitorHistories\Schemas;

use App\Models\Nvr;
use App\Models\Camera;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MonitorHistoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('monitorable_type')
                ->options([
                    Nvr::class=>'nvr',
                    Camera::class=>'camera'
                ])
                    ->required(),
                TextInput::make('monitorable_id')
                    ->required()
                    ->numeric(),
                TextInput::make('log')
                    ->required(),
                TextInput::make('state'),
            ]);
    }
}
