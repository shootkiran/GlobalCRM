<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Godown extends Model
{
  protected $fillable = ['name', 'location', 'notes'];

  public function stock_items()
  {
    return $this->belongsToMany(StockItem::class)
      ->withPivot('quantity')
      ->withTimestamps();
  }
}
