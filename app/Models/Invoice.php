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
    public function journal()
    {
        return $this->morphOne(Journal::class, 'journalable');
    }
    public function generateJournals()
    {
        if (! $this->items()->exists()) {
            return;
        }
        // Prevent duplicate journal
        if ($this->journal()->exists()) {
            return;
        }
        $this->loadMissing('customer.ledger', 'items');
        $journal = \App\Models\Journal::create([
            'date' => $this->date,
            'note' => 'Invoice #'.$this->id.' for '.$this->customer->name,
            'journalable_type' => Invoice::class,
            'journalable_id' => $this->id,
        ]);
        $totalAmount = 0;
        // dd($this->items);

        foreach ($this->items as $item) {
            $amount = $item->quantity * $item->unit_price;
            $totalAmount += $amount;

            $ledgerName = $item->itemable_type === \App\Models\StockItem::class
                ? 'Sales Of Stock A/C'
                : 'Service Charges A/C';

            $incomeLedger = \App\Models\Ledger::where('name', $ledgerName)->first();

            $journal->journal_entries()->create([
                'type' => 'credit',
                'amount' => $amount,
                'ledger_id' => $incomeLedger->id,
            ]);
        }

        // Debit: Customer
        $journal->journal_entries()->create([
            'type' => 'debit',
            'amount' => $totalAmount,
            'ledger_id' => $this->customer?->ledger_id,
        ]);
    }

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
