<?php

namespace App\Filament\Accounting\Resources\LedgerClasses;

use App\Filament\Accounting\Resources\LedgerClasses\Pages\CreateLedgerClass;
use App\Filament\Accounting\Resources\LedgerClasses\Pages\EditLedgerClass;
use App\Filament\Accounting\Resources\LedgerClasses\Pages\ListLedgerClasses;
use App\Filament\Accounting\Resources\LedgerClasses\Pages\ViewLedgerClass;
use App\Filament\Accounting\Resources\LedgerClasses\Schemas\LedgerClassForm;
use App\Filament\Accounting\Resources\LedgerClasses\Schemas\LedgerClassInfolist;
use App\Filament\Accounting\Resources\LedgerClasses\Tables\LedgerClassesTable;
use App\Models\LedgerClass;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LedgerClassResource extends Resource
{
    protected static ?string $model = LedgerClass::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return LedgerClassForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LedgerClassInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LedgerClassesTable::configure($table);
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
            'index' => ListLedgerClasses::route('/'),
            'create' => CreateLedgerClass::route('/create'),
            'view' => ViewLedgerClass::route('/{record}'),
            'edit' => EditLedgerClass::route('/{record}/edit'),
        ];
    }
}
