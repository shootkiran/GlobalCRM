<?php

namespace App\Filament\Resources\Customers\RelationManagers;

use App\Filament\Resources\Cameras\CameraResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class CamerasRelationManager extends RelationManager
{
    protected static string $relationship = 'cameras';

    protected static ?string $relatedResource = CameraResource::class;
    public function isReadOnly(): bool
    {
        return false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
