<?php

namespace App\Filament\Resources\Nvrs\Pages;

use App\Filament\Resources\Nvrs\NvrResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditNvr extends EditRecord
{
    protected static string $resource = NvrResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($data['lat'] && $data['lng']) {
            $data['gps'] = $data['lat'].",".$data['lng'];
        }
        return $data;
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $lat = null;
        $lng = null;
        list($lat, $lng) = explode(',', $data['gps']);
        $data['lat'] = $lat;
        $data['lng'] = $lng;
        unset($data['gps']);
        return $data;
    }

}
