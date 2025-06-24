<?php

namespace App\Filament\Resources\SupportCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SupportCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('description'),
            ]);
    }
}
