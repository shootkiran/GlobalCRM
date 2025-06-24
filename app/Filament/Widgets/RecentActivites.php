<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Cameras\CameraResource;
use App\Filament\Resources\Nvrs\NvrResource;
use App\Models\Camera;
use App\Models\MonitorHistory;
use App\Models\Nvr;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentActivites extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => MonitorHistory::query()->orderBy('created_at', 'desc'))
            ->columns([
                TextColumn::make('monitorable.name')
                    ->searchable()
                    ->url(function ($record) {
                        if ($record->monitorable_type == Nvr::class) {
                            return NvrResource::getUrl('view', ['record' => $record->monitorable_id]);
                        }
                        if ($record->monitorable_type == Camera::class) {
                            return CameraResource::getUrl('view', ['nvr' => $record->monitorable->nvr_id, 'record' => $record->monitorable_id]);
                        }
                    })
                    ->openUrlInNewTab(),
                TextColumn::make('log')
                    ->searchable(),
                TextColumn::make('state')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->since(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
