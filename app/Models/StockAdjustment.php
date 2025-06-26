<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockAdjustment extends Model
{
    protected $fillable = [
        'reason',
        'notes',
        'user_id',
    ];

    /**
     * Get the user who made the adjustment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the items involved in this adjustment.
     */
    public function stock_adjustment_items(): HasMany
    {
        return $this->hasMany(StockAdjustmentItem::class);
    }
    protected static function booted(): void
    {
        static::deleting(function (StockAdjustment $item) {
            $item->stock_adjustment_items()->delete();
        });
        static::deleted(function (StockAdjustment $stockAdjustment) {
            $items = $stockAdjustment->stock_adjustment_items;

            foreach ($items as $item) {
                $item->delete(); // this will fire the deleting event on StockAdjustmentItem
            }
        });
    }

}
