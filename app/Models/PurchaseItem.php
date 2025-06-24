<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    public function stock_item()
    {
        return $this->belongsTo(StockItem::class);
    }
}
