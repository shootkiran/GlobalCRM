<?php

namespace App\Models;

use App\StockMovementType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    protected $fillable = [
        'stock_item_id',
        'quantity',
        'godown_id',
        'type',
        'related_type',
        'related_id',
        'note',
    ];
    protected $casts = [
        'related_type' => StockMovementType::class
    ];
    
    public function stockItem(): BelongsTo
    {
        return $this->belongsTo(StockItem::class);
    }
    public function godown()
    {
        return $this->belongsTo(Godown::class);
    }
    public function related(): MorphTo
    {
        return $this->morphTo();
    }

  
    public function isInbound(): bool
    {
        return $this->quantity > 0;
    }

  
    public function isOutbound(): bool
    {
        return $this->quantity < 0;
    }
}