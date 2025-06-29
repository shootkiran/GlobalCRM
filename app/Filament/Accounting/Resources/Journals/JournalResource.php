<?php

namespace App\Filament\Accounting\Resources\Journals;

use App\Filament\Accounting\Resources\Journals\Pages\CreateJournal;
use App\Filament\Accounting\Resources\Journals\Pages\EditJournal;
use App\Filament\Accounting\Resources\Journals\Pages\ListJournals;
use App\Filament\Accounting\Resources\Journals\Pages\ViewJournal;
use App\Filament\Accounting\Resources\Journals\RelationManagers\JournalEntriesRelationManager;
use App\Filament\Accounting\Resources\Journals\Schemas\JournalForm;
use App\Filament\Accounting\Resources\Journals\Schemas\JournalInfolist;
use App\Filament\Accounting\Resources\Journals\Tables\JournalsTable;
use App\Models\Journal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JournalResource extends Resource
{
    protected static ?string $model = Journal::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return JournalForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JournalInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JournalsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            JournalEntriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJournals::route('/'),
            'create' => CreateJournal::route('/create'),
            'view' => ViewJournal::route('/{record}'),
            'edit' => EditJournal::route('/{record}/edit'),
        ];
    }
}
