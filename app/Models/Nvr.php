<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Process\Process;

class Nvr extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function monitor_histories()
    {
        return $this->morphMany(MonitorHistory::class, 'monitorable');
    }
    public function cameras()
    {
        return $this->hasMany(Camera::class);
    }
    public function telegrams()
    {
        return $this->morphToMany(
            \App\Models\Telegram::class,
            'notifiable',
            'notification_receivers'
        );
    }
    public function pingCheck()
    {
        $ip = $this->ip;
        $process = Process::fromShellCommandline("ping -c 1 -W 1 $ip");
        $process->run();
        if ($process->isSuccessful()) {
            if (! $this->reachable) {
                $message = "✅ NVR UP: \n
{$this->name} ({$this->ip}) is now rechable.";
                $this->telegrams->each(fn ($telegram) => $telegram->sendMessage("{$message}"));
                $this->monitor_histories()->create(['log' => "{$ip} is reachable", 'state' => "UP"]);
            }
            return true;
        } else {
            if ($this->reachable) {
                $message = "❌ NVR DOWN: \n
{$this->name} ({$this->ip}) is NOT rechable. Please Check Soon!!!.";
                $this->telegrams->each(fn ($telegram) => $telegram->sendMessage("{$message}"));

                $this->monitor_histories()->create(['log' => "{$ip} is NOT reachable", 'state' => "DOWN"]);
            }
            return false;
        }
    }
}
