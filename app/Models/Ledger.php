<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ledger extends Model
{
    public function ledger_class(): BelongsTo
    {
        return $this->belongsTo(LedgerClass::class);
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Ledger::class);
    }
    public function journal_entries(): HasMany
    {
        return $this->hasMany(JournalEntry::class);
    }
   
    public function calculateBalance()
    {
        $debit = $this->journal_entries()->where('type', 'debit')->sum('amount');
        $credit = $this->journal_entries()->where('type', 'credit')->sum('amount');
        $this->balance = $debit - $credit;
        $this->save();
    }
    
}
