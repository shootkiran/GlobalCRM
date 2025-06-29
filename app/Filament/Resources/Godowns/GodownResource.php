<?php

namespace App\Filament\Resources\Godowns;

use App\Filament\Resources\Godowns\Pages\CreateGodown;
use App\Filament\Resources\Godowns\Pages\EditGodown;
use App\Filament\Resources\Godowns\Pages\ListGodowns;
use App\Filament\Resources\Godowns\Pages\ViewGodown;
use App\Filament\Resources\Godowns\Schemas\GodownForm;
use App\Filament\Resources\Godowns\Schemas\GodownInfolist;
use App\Filament\Resources\Godowns\Tables\GodownsTable;
use App\Models\Godown;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GodownResource extends Resource
{
    protected static ?string $model = Godown::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return GodownForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GodownInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GodownsTable::configure($table);
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
            'index' => ListGodowns::route('/'),
            'create' => CreateGodown::route('/create'),
            'view' => ViewGodown::route('/{record}'),
            'edit' => EditGodown::route('/{record}/edit'),
        ];
    }
}
