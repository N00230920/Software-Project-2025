<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Maintenance;
use App\Notifications\MaintenanceReminder;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    Maintenance::with('plantUser.user')
        ->whereRaw("DATE_ADD(updated_at, INTERVAL frequency DAY) <= CURDATE()")
        ->chunk(100, function ($tasks) {
            foreach ($tasks as $task) {
                $user = $task->plantUser->user ?? null;

                if ($user) {
                    Notification::send($user, new MaintenanceReminder($task));

                    Log::info('Maintenance reminder sent', [
                        'user_id' => $user->id,
                        'user_email' => $user->email,
                        'plant_user_id' => $task->plant_user_id,
                        'maintenance_id' => $task->id,
                        'due_date' => $task->updated_at->addDays($task->frequency)->toDateString(),
                    ]);
                }

                $task->update(['last_maintenance_date' => today()]);
            }
        });

    $this->info('Maintenance reminders sent.');
}
    

}
