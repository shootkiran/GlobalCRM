<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as PagesDashboard;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use UnitEnum;

class Dashboard extends PagesDashboard
{
    // protected static string $routePath = 'monitor';
    protected static ?string $title = 'Dashboard';
    // protected static ?int $navigationSort = 1;

    // protected string $view = 'filament.pages.monitor-dashboard';
    public function getWidgets(): array
    {
        return [
            AccountWidget::class,
            FilamentInfoWidget::class,
        ];
    }

}
