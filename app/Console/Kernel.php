<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('queue:restart')->everyTenMinutes();
        $schedule->exec('php ' . base_path('artisan') . ' queue:work --stop-when-empty')->everyTenMinutes();
        $schedule->command('backup:database')->daily();
        $schedule->command('rescron:last-run')->everyFiveMinutes();
        
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
