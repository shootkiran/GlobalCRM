<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class PurchaseItem extends Model
{
    /**
     * Get the related stock item.
     */
    public function stock_item(): BelongsTo
    {
        return $this->belongsTo(StockItem::class);
    }

    /**
     * Get the related stock movement.
     */
    public function stock_movement(): MorphOne
    {
        return $this->morphOne(StockMovement::class, 'related');
    }

    protected static function booted(): void
    {
        static::created(function (PurchaseItem $item) {
            $item->stock_movement()->create([
                'stock_item_id' => $item->stock_item_id,
                'quantity' => $item->quantity,
                'type' => 'purchase',
                'note' => 'Auto-created from PurchaseItem',
            ]);
        });

        static::updated(function (PurchaseItem $item) {
            if ($item->wasChanged(['quantity', 'stock_item_id'])) {
                $item->stock_movement()->update([
                    'stock_item_id' => $item->stock_item_id,
                    'quantity' => $item->quantity,
                ]);
            }
        });

        static::deleted(function (PurchaseItem $item) {
            $item->stock_movement()->delete();
        });
    }
}