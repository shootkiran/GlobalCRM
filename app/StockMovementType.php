<?php

namespace App;
use Filament\Support\Contracts\HasLabel;

enum StockMovementType: string implements HasLabel
{
    case PurchaseItem = 'App\Models\PurchaseItem';
    case StockAdjustmentItem = 'App\Models\StockAdjustmentItem';
    case InvoiceItem = 'App\Models\InvoiceItem';
    case SalesReturnItem = 'App\Models\SalesReturnItem';
    case Manual = 'manual';
    public function getLabel(): string|\Illuminate\Contracts\Support\Htmlable|null
    {
        return match ($this) {
            self::PurchaseItem => 'Purchase Item',
            self::StockAdjustmentItem => 'Stock Adjustment Item',
            self::SalesReturnItem => 'Sales Return Item',
            self::InvoiceItem => 'Sales Item',
        };
    }
}