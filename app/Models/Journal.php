<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Journal extends Model
{
    protected $fillable = ['date', 'note', 'created_by'];

    public function journal_entries(): HasMany
    {
        return $this->hasMany(JournalEntry::class);
    }
    public function journalable()
    {
        return $this->morphTo();
    }
}
