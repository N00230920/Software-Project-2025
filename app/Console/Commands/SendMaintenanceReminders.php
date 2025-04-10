<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Maintenance;
use App\Notifications\MaintenanceReminder;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class SendMaintenanceReminders extends Command
{
    protected $signature = 'app:send-maintenance-reminders';
    protected $description = 'Send maintenance reminders to users.';

    public function handle()
    {
        // Fetch all maintenance tasks that are due for a reminder
        Maintenance::with('plantUsers.user') // Use the many-to-many relationship 'plantUsers' here
            ->whereRaw("DATE_ADD(updated_at, INTERVAL frequency DAY) <= CURDATE()")
            ->chunk(100, function ($tasks) {
                foreach ($tasks as $task) {
                    // Loop over each plantUser associated with this task
                    foreach ($task->plantUsers as $plantUser) {
                        // Access the user through the related PlantUser model
                        $user = $plantUser->user;

                        if ($user) {
                            // Send the notification to the user
                            Notification::send($user, new MaintenanceReminder($task));

                            Log::info('Maintenance reminder sent', [
                                'user_id' => $user->id,
                                'user_email' => $user->email,
                                'plant_user_id' => $plantUser->id,
                                'maintenance_id' => $task->id,
                                'due_date' => $task->updated_at->addDays($task->frequency)->toDateString(),
                            ]);
                        }
                    }

                    // Update the maintenance task with today's date (completed_at)
                    $task->update(['completed_at' => today()]);
                }
            });

        $this->info('Maintenance reminders sent.');
    }
}