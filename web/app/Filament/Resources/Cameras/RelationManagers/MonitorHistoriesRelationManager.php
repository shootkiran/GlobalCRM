<?php

namespace App\Filament\Resources\Cameras\RelationManagers;

use App\Filament\Resources\MonitorHistories\MonitorHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class MonitorHistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'monitor_histories';

    protected static ?string $relatedResource = MonitorHistoryResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
