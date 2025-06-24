<?php

namespace App\Filament\Resources\MonitorHistories\Pages;

use App\Filament\Resources\MonitorHistories\MonitorHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMonitorHistories extends ListRecords
{
    protected static string $resource = MonitorHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
