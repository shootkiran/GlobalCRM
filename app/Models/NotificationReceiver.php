<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class NotificationReceiver extends Model
{
    protected $fillable = [
        'notifiable_type',
        'notifiable_id',
        'telegram_id',
    ];

    /**
     * The notifiable model (e.g., Nvr, Camera, etc.)
     */
    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * The Telegram recipient.
     */
    public function telegram(): BelongsTo
    {
        return $this->belongsTo(Telegram::class);
    }
}
