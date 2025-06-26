<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class SalesReturnItem extends Model
{
    protected $fillable = [
        'sales_return_id',
        'stock_item_id',
        'quantity',
        'reason',
    ];

    public function sales_return()
    {
        return $this->belongsTo(SalesReturn::class);
    }

    public function stock_item()
    {
        return $this->belongsTo(StockItem::class);
    }
    public function stock_movement(): MorphOne
    {
        return $this->morphOne(StockMovement::class, 'related');
    }
    protected static function booted(): void
    {
        static::created(function (SalesReturnItem $item) {
            $item->stock_movement()->create([
                'stock_item_id' => $item->stock_item_id,
                'quantity' => $item->quantity,
                'type' => 'sales_return',
                'note' => 'Auto-created from SalesReturnItem',
            ]);
        });

        static::deleting(function (SalesReturnItem $item) {
            $item->stock_movement()->delete();
        });
    }
}
