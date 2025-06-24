<?php

namespace App\Filament\Resources\Quotations\Schemas;

use App\CustomerType;
use App\Filament\Resources\Customers\CustomerResource;
use App\Filament\Resources\Customers\Schemas\CustomerForm;
use App\QuotationStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuotationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer_id')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->relationship('customer', 'name')
                    ->createOptionForm([
                        Select::make('type')
                            ->required()
                            ->options(CustomerType::class)
                            ->live()
                            ->default('personal'),
                        TextInput::make('name')
                            ->required(),
                        Select::make('location_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('location', 'name'),
                        TextInput::make('pan')
                            ->required()
                            ->visible(fn ($get) => $get('type') == CustomerType::ORGANISATION),
                    ])
                ,
                DatePicker::make('date')
                    ->default(today())
                    ->required(),
                Select::make('status')
                    ->required()
                    ->options(QuotationStatus::class)
                    ->default('open'),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
