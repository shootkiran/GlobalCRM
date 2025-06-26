<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    protected $fillable = [
        'stock_item_id',
        'quantity',
        'type',
        'related_type',
        'related_id',
        'note',
    ];

    /**
     * Get the stock item this movement belongs to.
     */
    public function stockItem(): BelongsTo
    {
        return $this->belongsTo(StockItem::class);
    }

    /**
     * Get the related model (purchase, sale, etc.)
     */
    public function related(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Determine if movement is IN type (positive quantity).
     */
    public function isInbound(): bool
    {
        return $this->quantity > 0;
    }

    /**
     * Determine if movement is OUT type (negative quantity).
     */
    public function isOutbound(): bool
    {
        return $this->quantity < 0;
    }
}