<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JournalEntry extends Model
{
    //
    protected $fillable = ['journal_id', 'ledger_id', 'type', 'amount'];

    public function journal(): BelongsTo
    {
        return $this->belongsTo(Journal::class);
    }

    public function ledger(): BelongsTo
    {
        return $this->belongsTo(Ledger::class);
    }
    public function getDrAmountAttribute(): float
    {
        return $this->type === 'debit' ? $this->amount : 0.0;
    }
    public function getCrAmountAttribute(): float
    {
        return $this->type === 'credit' ? $this->amount : 0.0;
    }
    protected static function booted(): void
    {
        static::created(function (self $journalEntry) {
            $journalEntry->ledger->calculateBalance();
        });

        static::updated(function (self $journalEntry) {
            $journalEntry->ledger->calculateBalance();
        });

    }
}
