<?php

namespace App\Filament\Accounting\Resources\Ledgers;

use App\Filament\Accounting\Resources\Ledgers\Pages\CreateLedger;
use App\Filament\Accounting\Resources\Ledgers\Pages\EditLedger;
use App\Filament\Accounting\Resources\Ledgers\Pages\ListLedgers;
use App\Filament\Accounting\Resources\Ledgers\Pages\ViewLedger;
use App\Filament\Accounting\Resources\Ledgers\RelationManagers\JournalEntriesRelationManager;
use App\Filament\Accounting\Resources\Ledgers\Schemas\LedgerForm;
use App\Filament\Accounting\Resources\Ledgers\Schemas\LedgerInfolist;
use App\Filament\Accounting\Resources\Ledgers\Tables\LedgersTable;
use App\Models\Ledger;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LedgerResource extends Resource
{
    protected static ?string $model = Ledger::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return LedgerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LedgerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LedgersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            JournalEntriesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLedgers::route('/'),
            'create' => CreateLedger::route('/create'),
            'view' => ViewLedger::route('/{record}'),
            'edit' => EditLedger::route('/{record}/edit'),
        ];
    }
}
