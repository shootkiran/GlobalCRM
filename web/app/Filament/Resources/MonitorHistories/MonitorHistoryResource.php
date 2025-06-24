<?php

namespace App\Filament\Resources\MonitorHistories;

use App\Filament\Resources\MonitorHistories\Pages\CreateMonitorHistory;
use App\Filament\Resources\MonitorHistories\Pages\EditMonitorHistory;
use App\Filament\Resources\MonitorHistories\Pages\ListMonitorHistories;
use App\Filament\Resources\MonitorHistories\Pages\ViewMonitorHistory;
use App\Filament\Resources\MonitorHistories\Schemas\MonitorHistoryForm;
use App\Filament\Resources\MonitorHistories\Schemas\MonitorHistoryInfolist;
use App\Filament\Resources\MonitorHistories\Tables\MonitorHistoriesTable;
use App\Models\MonitorHistory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MonitorHistoryResource extends Resource
{
    protected static ?string $model = MonitorHistory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = "Monitor";

    public static function form(Schema $schema): Schema
    {
        return MonitorHistoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MonitorHistoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MonitorHistoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMonitorHistories::route('/'),
            'create' => CreateMonitorHistory::route('/create'),
            'view' => ViewMonitorHistory::route('/{record}'),
            'edit' => EditMonitorHistory::route('/{record}/edit'),
        ];
    }
}
