<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function nvrs()
    {
        return $this->hasMany(Nvr::class);
    }

    public function cameras()
    {
        return $this->hasMany(Camera::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function ledger()
    {
        return $this->belongsTo(Ledger::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getTotalInvoicedAttribute(): float
    {
        return $this->invoices()->sum('total_amount');
    }

    public function getTotalPaidAttribute(): float
    {
        return $this->payments()->sum('amount');
    }

    public function getBalanceAttribute(): float
    {
        return $this->total_invoiced - $this->total_paid;
    }

    /*
    |--------------------------------------------------------------------------
    | Model Events (Optional)
    |--------------------------------------------------------------------------
    */

    protected static function booted(): void
    {
        // Example: you can log, sync external systems, or queue balance updates
        static::updated(function (Customer $customer) {
            // Log::info("Customer {$customer->id} updated. Current balance: {$customer->balance}");
        });
    }
}