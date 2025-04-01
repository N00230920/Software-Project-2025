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
        // Example scheduled task
        $schedule->call(function () {
            \Log::info('Scheduler is working!');
        })->everyMinute();

        
        $schedule->call(function () {
        $tasks = MaintenanceSchedule::where('schedule_date', today())->get();

        foreach ($tasks as $task) {
            // Send notification (email, push, etc.)
            Notification::send($task->plantUser->user, new MaintenanceReminder($task));
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






