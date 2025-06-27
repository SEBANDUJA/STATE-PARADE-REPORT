<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\ResetStudentFlags; // 👈 Make sure this command exists

class Kernel extends ConsoleKernel
{
    /**
     * Register any application commands.
     */
    protected function commands(): void
    {
        // Automatically load all Artisan commands in the Commands folder
        $this->load(__DIR__.'/Commands');

        // Optionally load routes/console.php if you use closures for commands
        require base_path('routes/console.php');
    }

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Run the reset command every 12 hours
        $schedule->command('students:reset-flags')->everyMinute();
    }
}
