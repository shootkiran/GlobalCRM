<?php

namespace App\Console\Commands;

use App\Models\Nvr;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class CheckMonitorPing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitor:check-ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check NVR and Cameras Ping';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nvrs = Nvr::with('cameras')->get();
        foreach ($nvrs as $nvr) {
            $ip = $nvr->ip;
            $pingCheck = $nvr->pingCheck();
            if ($pingCheck) {
                $this->info("✅ {$nvr->name} ({$ip}) is reachable.");
            } else {
                $this->warn("❌ {$nvr->name} ({$ip}) is NOT reachable.");

            }
            foreach ($nvr->cameras as $camera) {
                $camip = $camera->ip;
                $pingCheck = $camera->pingCheck();
                if ($pingCheck) {
                    $this->info("✅ {$camera->name} ({$ip}) is reachable.");
                } else {
                    $this->warn("❌ {$camera->name} ({$ip}) is NOT reachable.");

                }

            }
        }
        return Command::SUCCESS;

    }
}
