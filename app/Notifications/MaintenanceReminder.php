<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MaintenanceReminder extends Notification
{

    
    use Queueable;

    public $task;
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
{
    

    return (new MailMessage)
        ->subject('Maintenance Reminder')
        ->greeting("Hello {$notifiable->name},")
        ->line('This is a friendly reminder to complete your pending maintenance task.')
        ->line('Task: ' . $this->task->task) // Assuming $task is passed into the constructor
        ->line('Due date: ' . $this->task->updated_at->addDays($this->task->frequency)->toFormattedDateString())
        ->action('Complete Task', url('/tasks/' . $this->task->id)) // Link to complete the task
        ->line('Thank you for using our service!');
}
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
