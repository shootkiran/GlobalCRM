<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class InvoiceItem extends Model
{
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function itemable()
    {
        return $this->morphTo();
    }
    public function stock_movement(): MorphOne
    {
        return $this->morphOne(StockMovement::class, 'related');
    }
    protected static function booted(): void
    {
        static::created(function (InvoiceItem $item) {
            if ($item->itemable_type === StockItem::class) {
                $item->stock_movement()->create([
                    'stock_item_id' => $item->itemable_id,
                    'quantity' => $item->quantity * -1,
                    'type' => 'sale',
                    'note' => 'Auto-created from InvoiceItem',
                ]);
            }
        });

        static::updated(function (InvoiceItem $item) {
            $wasStockItem = $item->getOriginal('itemable_type') === StockItem::class;
            $isNowStockItem = $item->itemable_type === StockItem::class;

            if ($wasStockItem && $isNowStockItem) {
                // Still a StockItem — just update
                $item->stock_movement()->update([
                    'stock_item_id' => $item->itemable_id,
                    'quantity' => $item->quantity * -1,
                ]);
            } elseif ($wasStockItem && ! $isNowStockItem) {
                // Changed from StockItem → something else — delete movement
                $item->stock_movement()->delete();
            } elseif (! $wasStockItem && $isNowStockItem) {
                // Changed from something else → StockItem — create movement
                $item->stock_movement()->create([
                    'stock_item_id' => $item->itemable_id,
                    'quantity' => $item->quantity * -1,
                    'type' => 'sale',
                    'note' => 'Auto-created after type change to StockItem',
                ]);
            }
        });

        static::deleted(function (InvoiceItem $item) {
            $item->stock_movement()->delete();
        });
    }

}
