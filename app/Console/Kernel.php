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
        $schedule->command('downgrade:user_level')
            ->daily()
            ->timezone('Asia/Kuala_Lumpur')
            ->runInBackground()
            ->emailOutputTo('vvinners.development@gmail.com')
            ->emailOutputOnFailure('vvinners.development@gmail.com');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
