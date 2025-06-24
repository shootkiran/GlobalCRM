<?php

namespace App\Filament\Resources\Payments\Schemas;

use App\Models\Invoice;
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
                    ->required()
                    ->live(),
                Select::make('invoice_id')
                    ->options(function (callable $get) {
                        $customerId = $get('customer_id');

                        if (! $customerId) {
                            return [];
                        }

                        return Invoice::where('customer_id', $customerId)
                            ->pluck('id', 'id'); // You can customize display
                    })
                    ->searchable()
                    ->required()
                    ->visible(fn (callable $get) => filled($get('customer_id'))),
                DatePicker::make('date')
                ->default(now())
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                TextInput::make('method'),
                Textarea::make('note')
                    ->columnSpanFull(),
            ]);
    }
}
