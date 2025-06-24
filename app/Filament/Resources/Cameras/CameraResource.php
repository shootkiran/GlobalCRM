<?php

namespace App\Filament\Resources\Cameras;

use App\Filament\Resources\Cameras\Pages\CreateCamera;
use App\Filament\Resources\Cameras\Pages\EditCamera;
use App\Filament\Resources\Cameras\Pages\ListCameras;
use App\Filament\Resources\Cameras\Pages\ViewCamera;
use App\Filament\Resources\Cameras\RelationManagers\MonitorHistoriesRelationManager;
use App\Filament\Resources\Cameras\Schemas\CameraForm;
use App\Filament\Resources\Cameras\Schemas\CameraInfolist;
use App\Filament\Resources\Cameras\Tables\CamerasTable;
use App\Filament\Resources\Nvrs\NvrResource;
use App\Models\Camera;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CameraResource extends Resource
{
    protected static ?string $model = Camera::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = "Monitor";
    // protected static ?string $parentResource = NvrResource::class;

    public static function form(Schema $schema): Schema
    {
        return CameraForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CameraInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CamerasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            MonitorHistoriesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCameras::route('/'),
            'create' => CreateCamera::route('/create'),
            'view' => ViewCamera::route('/{record}'),
            'edit' => EditCamera::route('/{record}/edit'),
        ];
    }
}
