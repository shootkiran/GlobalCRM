<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramChat extends Model
{
    protected $casts = [
        'payload' => 'array',
        'message_date' => 'datetime',
    ];
}
