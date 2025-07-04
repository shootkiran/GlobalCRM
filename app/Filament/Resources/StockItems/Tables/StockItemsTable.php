<?php

namespace App\Filament\Resources\StockItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StockItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->color(fn($record)=>$record->current_stock<$record->minimum_stock?'danger':'')
                    ->description(fn($record)=>$record->current_stock<$record->minimum_stock?'Stock Low':''),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                TextColumn::make('unit')
                    ->searchable(),
                TextColumn::make('cost_price')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('selling_price')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('minimum_stock')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('current_stock')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
