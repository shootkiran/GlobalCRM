<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum QuotationStatus: string implements HasLabel
{
    case Draft = "draft";
    case Sent = "sent";
    case Approved = "approved";
    case Rejected = "rejected";
    case Converted = "converted";
    case Expired = "expired";
    public function getLabel(): string|\Illuminate\Contracts\Support\Htmlable|null
    {
        return $this->name;
    }
}
