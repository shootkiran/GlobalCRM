<?php

namespace App\Filament\Widgets;

use App\Models\Camera;
use App\Models\Nvr;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MonitorStats1 extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Nvrs', Nvr::count()),
            Stat::make('Cameras', Camera::count()),

            Stat::make('Down Nvr', Nvr::where('reachable', false)->count()),
            Stat::make('Up Nvr', Nvr::where('reachable', true)->count()),
            Stat::make('Down Cameras', Camera::where('reachable', false)->count())
                ->description('camera in Down State')->color('danger'),
            Stat::make('Up Cameras', Camera::where('reachable', true)->count())
                ->description('camera in Up State')
                ->descriptionColor('success'),
        ];
    }
}
