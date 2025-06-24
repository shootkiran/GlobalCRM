<?php

namespace App\Filament\Resources\SupportCategories\Pages;

use App\Filament\Resources\SupportCategories\SupportCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSupportCategory extends EditRecord
{
    protected static string $resource = SupportCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
