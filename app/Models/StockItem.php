<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    public function stock_movements()
    {
        return $this->hasMany(StockMovement::class);
    }
    public function getCurrentStockAttribute(): int
    {
        return $this->stock_movements->sum('quantity') ?? 0;
    }
    public function godowns()
    {
        return $this->belongsToMany(Godown::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
