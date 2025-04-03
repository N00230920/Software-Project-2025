<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Maintenance;
use App\Notifications\MaintenanceReminder;
use Illuminate\Support\Facades\Notification;

class SendMaintenanceReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-maintenance-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Maintenance::whereRaw("DATE_ADD(updated_at, INTERVAL frequency DAY) <= CURDATE()")->get();
    
        if ($tasks->isEmpty()) {
            $this->info('No maintenance tasks due today.');
            return;
        }
    
        foreach ($tasks as $task) {
            Notification::send($task->plantUser->user, new MaintenanceReminder($task));
            $task->update(['last_maintenance_date' => today()]);
        }
    
        $this->info('Maintenance reminders sent.');
    }
    

}
