<?php

namespace App\Filament\Accounting\Resources\Journals\Schemas;

use App\Models\LedgerClass;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JournalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->required(),
                TextInput::make('note'),
                TextInput::make('user_id')
                    ->numeric(),
                Repeater::make('journal_entries')
                    ->relationship()
                    ->columnSpanFull()
                    ->defaultItems(2)
                    ->table([
                        TableColumn::make('Ledger Class'),
                        TableColumn::make('Ledger'),
                        TableColumn::make('Type'),
                        TableColumn::make('Amount'),
                    ])
                    ->schema([
                        Select::make('ledger_class')
                            ->required()
                            ->live()
                            ->dehydrated(false)
                            ->options(LedgerClass::pluck('name', 'id')),
                        Select::make('ledger_id')
                            ->required()
                            ->options(function (callable $get) {
                                $ledgerClassId = $get('ledger_class');
                                return \App\Models\Ledger::where('ledger_class_id', $ledgerClassId)->pluck('name', 'id');
                            }),
                        Select::make('type')
                            ->options([
                                'debit' => 'DR.',
                                'credit' => 'CR.',
                            ]),
                        TextInput::make('amount')
                            ->label('Amount')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2)
                    ->required(),
            ]);
    }
}
