<?php

namespace App\Filament\Resources\Telegrams;

use App\Filament\Resources\Telegrams\Pages\CreateTelegram;
use App\Filament\Resources\Telegrams\Pages\EditTelegram;
use App\Filament\Resources\Telegrams\Pages\ListTelegrams;
use App\Filament\Resources\Telegrams\Pages\ViewTelegram;
use App\Filament\Resources\Telegrams\Schemas\TelegramForm;
use App\Filament\Resources\Telegrams\Schemas\TelegramInfolist;
use App\Filament\Resources\Telegrams\Tables\TelegramsTable;
use App\Models\Telegram;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TelegramResource extends Resource
{
    protected static ?string $model = Telegram::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TelegramForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TelegramInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TelegramsTable::configure($table);
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
            'index' => ListTelegrams::route('/'),
            'create' => CreateTelegram::route('/create'),
            'view' => ViewTelegram::route('/{record}'),
            'edit' => EditTelegram::route('/{record}/edit'),
        ];
    }
}
