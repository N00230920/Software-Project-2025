<?php

namespace App\Console;

use App\Console\Commands\SendMaintenanceReminders; // Import your custom command
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Register the SendMaintenanceReminders command
        SendMaintenanceReminders::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Schedule the SendMaintenanceReminders command to run daily at 8:00 AM
        $schedule->command('app:send-maintenance-reminders')->dailyAt('08:00');
        
        // You can add other scheduled commands here if necessary
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Load the commands from the `routes/console.php` file
        $this->load(__DIR__.'/Commands');

        // Include the routes for the Artisan console commands
        require base_path('routes/console.php');
    }
}
