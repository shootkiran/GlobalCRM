<?php

namespace App\Filament\Resources\SupportCategories\Pages;

use App\Filament\Resources\SupportCategories\SupportCategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSupportCategory extends ViewRecord
{
    protected static string $resource = SupportCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
