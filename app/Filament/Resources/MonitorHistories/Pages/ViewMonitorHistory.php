<?php

namespace App\Filament\Resources\MonitorHistories\Pages;

use App\Filament\Resources\MonitorHistories\MonitorHistoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMonitorHistory extends ViewRecord
{
    protected static string $resource = MonitorHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
