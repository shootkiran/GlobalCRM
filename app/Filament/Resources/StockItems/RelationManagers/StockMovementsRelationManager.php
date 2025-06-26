<?php

namespace App\Filament\Resources\StockItems\RelationManagers;

use App\Filament\Resources\StockMovements\StockMovementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StockMovementsRelationManager extends RelationManager
{
    protected static string $relationship = 'stock_movements';

    protected static ?string $relatedResource = StockMovementResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('created_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('related')
                    ->formatStateUsing(fn ($state) => $state->id)
                    ->prefix(fn($record)=>$record->related_type->name ." #")
                    ->searchable(),
                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type')
                    ->searchable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
