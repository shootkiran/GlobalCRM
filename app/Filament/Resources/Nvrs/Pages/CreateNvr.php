<?php

namespace App\Filament\Resources\Nvrs\Pages;

use App\Filament\Resources\Nvrs\NvrResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNvr extends CreateRecord
{
    protected static string $resource = NvrResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
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
