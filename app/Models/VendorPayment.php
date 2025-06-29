<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorPayment extends Model
{
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }   

    public function journal()
    {
        return $this->morphOne(Journal::class, 'journalable');
    }
}
