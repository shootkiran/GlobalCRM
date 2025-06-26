<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Process\Process;

class Camera extends Model
{
    public function nvr()
    {
        return $this->belongsTo(Nvr::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function monitor_histories()
    {
        return $this->morphMany(MonitorHistory::class, 'monitorable');
    }
    public function pingCheck()
    {
        $ip = $this->ip;
        $process = Process::fromShellCommandline("ping -c 1 -W 1 $ip");
        $process->run();
        if ($process->isSuccessful()) {
            if (! $this->reachable) {
                $message = "✅ CAMERA UP: \n
{$this->name} ({$this->ip}) is now rechable.";
                $this->nvr->telegrams->each(fn ($telegram) => $telegram->sendMessage("{$message}"));

                $this->monitor_histories()->create(['log' => "{$ip} is reachable", 'state' => "UP"]);
            }
            return true;
        } else {
            if ($this->reachable) {
                $message = "❌ CAMERA DOWN: \n
{$this->name} ({$this->ip}) is NOT rechable.";
                $this->nvr->telegrams->each(fn ($telegram) => $telegram->sendMessage("{$message}"));

                $this->monitor_histories()->create(['log' => "{$ip} is NOT reachable", 'state' => "DOWN"]);
            }
            return false;
        }
    }
}
