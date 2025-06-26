<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Telegram extends Model
{
    protected $fillable = [
        'chat_id',
        'type',
        'title',
        'username',
        'first_name',
        'last_name',
        'user_id',
        'active',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function notifiables()
    {
        return $this->morphedByMany(
            related: NotificationReceiver::class,
            name: 'notifiable',
        );
    }
    public function sendMessage(string $text): bool
    {
        $botToken = env('TELEGRAM_TOKEN');

        if (! $botToken || ! $this->chat_id) {
            return false;
        }

        $response = Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $this->chat_id,
            'text' => $text,
        ]);

        return $response->successful();
    }
}