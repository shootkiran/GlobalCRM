<?php

namespace App\Filament\Resources\Customers\RelationManagers;

use App\Filament\Resources\Nvrs\NvrResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class NvrsRelationManager extends RelationManager
{
    protected static string $relationship = 'nvrs';

    protected static ?string $relatedResource = NvrResource::class;
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
