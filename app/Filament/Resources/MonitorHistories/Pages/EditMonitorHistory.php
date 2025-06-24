<?php

namespace App\Filament\Resources\MonitorHistories\Pages;

use App\Filament\Resources\MonitorHistories\MonitorHistoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMonitorHistory extends EditRecord
{
    protected static string $resource = MonitorHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
