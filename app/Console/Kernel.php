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
        $schedule->call(function () {
            $tasks = Maintenance::whereDate(
                'last_maintenance_date',
                today()->subDays('frequency')
            )->get();
    
            foreach ($tasks as $task) {
                Notification::send($task->plantUser->user, new MaintenanceReminder($task));
    
                // Update last maintenance date
                $task->update(['last_maintenance_date' => today()]);
            }
        })->daily();
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
