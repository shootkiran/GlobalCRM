<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitorHistory extends Model
{
    public function monitorable()
    {
        return $this->morphTo();
    }
    protected static function booted(): void
    {
        // Example: you can log, sync external systems, or queue balance updates
        static::created(function (MonitorHistory $monitorHistory) {
            if ($monitorHistory->state == "UP") {
                $monitorable = $monitorHistory->monitorable;
                if (! $monitorable->reachable) {
                    $monitorable->update(['reachable' => true, 'last_changed' => now()]);
                }

            } else if ($monitorHistory->state == "DOWN") {
                $monitorable = $monitorHistory->monitorable;
                if ($monitorable->reachable) {
                    $monitorable->update(['reachable' => false, 'last_changed' => now()]);
                }
            }
        });
    }
}
