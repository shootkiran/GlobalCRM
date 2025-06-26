<?php

namespace App\Filament\Resources\TelegramChats;

use App\Filament\Resources\TelegramChats\Pages\CreateTelegramChat;
use App\Filament\Resources\TelegramChats\Pages\EditTelegramChat;
use App\Filament\Resources\TelegramChats\Pages\ListTelegramChats;
use App\Filament\Resources\TelegramChats\Pages\ViewTelegramChat;
use App\Filament\Resources\TelegramChats\Schemas\TelegramChatForm;
use App\Filament\Resources\TelegramChats\Schemas\TelegramChatInfolist;
use App\Filament\Resources\TelegramChats\Tables\TelegramChatsTable;
use App\Models\TelegramChat;
use UnitEnum;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TelegramChatResource extends Resource
{
    protected static ?string $model = TelegramChat::class;   
     protected static ?string $modelLabel = "Incoming Telegram Chat";


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = "System";

    public static function form(Schema $schema): Schema
    {
        return TelegramChatForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TelegramChatInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TelegramChatsTable::configure($table);
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
            'index' => ListTelegramChats::route('/'),
            'create' => CreateTelegramChat::route('/create'),
            'view' => ViewTelegramChat::route('/{record}'),
            'edit' => EditTelegramChat::route('/{record}/edit'),
        ];
    }
}
