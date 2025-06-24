<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum CustomerType: string implements HasLabel
{
    case PERSONAL = 'personal';
    case ORGANISATION = 'organisation';

    public function getLabel(): string|\Illuminate\Contracts\Support\Htmlable|null
    {
        return $this->name;
    }
}
