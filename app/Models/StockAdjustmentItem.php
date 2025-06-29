<?php

namespace App\Models;

use App\Models\StockAdjustment;
use App\Models\StockItem;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockMovement;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class StockAdjustmentItem extends Model
{
    protected $fillable = [
        'stock_adjustment_id',
        'stock_item_id',
        'godown_id',
        'quantity',
        'notes',
    ];

    public function stock_movement(): MorphOne
    {
        return $this->morphOne(StockMovement::class, 'related');
    }
    public function godown()
    {
        return $this->belongsTo(Godown::class);
    }
    protected static function booted(): void
    {
        static::created(function (StockAdjustmentItem $item) {
            $item->stock_movement()->create([
                'stock_item_id' => $item->stock_item_id,
                'quantity' => $item->quantity,
                'godown_id' => $item->godown_id,
                'type' => 'adjustment',
                'note' => 'Auto-created from StockAdjustmentItem',
            ]);
        });

        static::updated(function (StockAdjustmentItem $item) {
            if ($item->wasChanged(['quantity', 'stock_item_id'])) {
                $item->stock_movement()->update([
                    'stock_item_id' => $item->stock_item_id,
                    'godown_id' => $item->godown_id,
                    'quantity' => $item->quantity,
                ]);
            }
        });
        static::deleted(function (StockAdjustmentItem $item) {
            $item->stock_movement()->delete();
        });
    }

    public function stock_adjustment()
    {
        return $this->belongsTo(StockAdjustment::class, 'stock_adjustment_id');
    }

    public function stock_item()
    {
        return $this->belongsTo(StockItem::class, 'stock_item_id');
    }
}