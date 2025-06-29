<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'date',
        'amount',
        'method',
        'note',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
    public function receive_ledger(): BelongsTo
    {
        return $this->belongsTo(Ledger::class, 'receive_ledger_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class); // Optional shortcut access
    }

    public function journal()
    {
        return $this->morphOne(Journal::class, 'journalable');
    }
    public function generateJournals()
    {

        // Prevent duplicate journal
        if ($this->journal()->exists()) {
            return;
        }
        // Safety check
        if (! $this->customer?->ledger_id || ! $this->receive_ledger_id) {
            throw new \Exception("Missing required ledger for payment #{$this->id}");
        }
        $journal = \App\Models\Journal::create([
            'date' => $this->date,
            'note' => 'Payment #'.$this->id.' for '.$this->customer->name,
            'journalable_type' => Payment::class,
            'journalable_id' => $this->id,
        ]);
        $journal->journal_entries()->create([
            'type' => 'credit',
            'amount' => $this->amount,
            'ledger_id' => $this->customer?->ledger_id,
        ]);
        $journal->journal_entries()->create([
            'type' => 'debit',
            'ledger_id' => $this->receive_ledger_id,
            'amount' => $this->amount,
        ]);

    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getCustomerNameAttribute(): ?string
    {
        return $this->customer?->name;
    }

    public function getIsOverpaymentAttribute(): bool
    {
        return $this->amount > $this->invoice?->due_amount;
    }
}