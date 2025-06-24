<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\MonitorStats1;
use App\Filament\Widgets\RecentActivites;
use Filament\Pages\Dashboard;
use Filament\Pages\Page;
use UnitEnum;

class MonitorDashboard extends Dashboard
{
    protected static string $routePath = 'monitor';
    protected static ?string $title = 'Monitor dashboard';
    // protected static ?int $navigationSort = 1;
    protected static string|UnitEnum|null $navigationGroup = "Monitor";

    // protected string $view = 'filament.pages.monitor-dashboard';
    public function getWidgets(): array
    {
        return [
            MonitorStats1::class,
            RecentActivites::class,
        ];
    }

}
