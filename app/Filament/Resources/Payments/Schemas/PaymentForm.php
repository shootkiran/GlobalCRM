<?php

namespace App\Filament\Resources\Payments\Schemas;

use App\AccountType;
use App\Models\Ledger;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->required(),

                Select::make('receive_ledger_id')
                    ->label('Received In')
                    ->default(fn () => Ledger::where('type', 'cash')->first()?->id)
                    ->options(function (callable $get) {
                        return Ledger::whereCashBank(true)->pluck('name', 'id');
                    })
                    ->required(),
                DatePicker::make('date')
                    ->default(today())
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                // TextInput::make('method'),
                Textarea::make('note')
                    ->columnSpanFull(),
            ]);
    }
}
