<?php

namespace App\Filament\Resources\Nvrs;

use App\Filament\Resources\Customers\RelationManagers\CamerasRelationManager;
use App\Filament\Resources\Nvrs\Pages\CreateNvr;
use App\Filament\Resources\Nvrs\Pages\EditNvr;
use App\Filament\Resources\Nvrs\Pages\ListNvrs;
use App\Filament\Resources\Nvrs\Pages\ViewNvr;
use App\Filament\Resources\Nvrs\RelationManagers\MonitorHistoriesRelationManager;
use App\Filament\Resources\Nvrs\Schemas\NvrForm;
use App\Filament\Resources\Nvrs\Schemas\NvrInfolist;
use App\Filament\Resources\Nvrs\Tables\NvrsTable;
use App\Models\Nvr;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class NvrResource extends Resource
{
    protected static ?string $model = Nvr::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = "Monitor";

    public static function form(Schema $schema): Schema
    {
        return NvrForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return NvrInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NvrsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            MonitorHistoriesRelationManager::class,
            CamerasRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNvrs::route('/'),
            'create' => CreateNvr::route('/create'),
            'view' => ViewNvr::route('/{record}'),
            'edit' => EditNvr::route('/{record}/edit'),
        ];
    }
}
