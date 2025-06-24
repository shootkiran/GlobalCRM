<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $casts = [
        'date' => 'date',
    ];
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Boot Method - Auto Calculate Total
    |--------------------------------------------------------------------------
    */

    protected static function booted(): void
    {
        static::saving(function (Invoice $invoice) {
            // Only calculate if items are loaded
            if ($invoice->relationLoaded('items')) {
                $invoice->total_amount = $invoice->items->sum(function ($item) {
                    return $item->quantity * $item->unit_price;
                });
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors / Helpers
    |--------------------------------------------------------------------------
    */

    public function getPaidAmountAttribute(): float
    {
        return $this->payments->sum('amount');
    }

    public function getDueAmountAttribute(): float
    {
        return $this->total_amount - $this->paid_amount;
    }

    public function getIsPaidAttribute(): bool
    {
        return $this->due_amount <= 0;
    }
}
