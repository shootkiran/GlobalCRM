<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function purchase_items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
    protected static function booted(): void
    {
        static::deleted(function (Purchase $purchase) {
            $purchase->purchase_items()->delete();
        });
    }

    public function journal()
    {
        return $this->morphOne(Journal::class, 'journalable');
    }
}
