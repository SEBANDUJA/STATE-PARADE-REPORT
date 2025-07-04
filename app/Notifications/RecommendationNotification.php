<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RecommendationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $recommendation;

    public function __construct($recommendation)
    {
        $this->recommendation = $recommendation;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // or just ['database'] if no email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Recommendation')
                    ->line('You have received a new recommendation.')
                    ->line('Message: ' . $this->recommendation->message);
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->recommendation->message,
            'sent_by' => $this->recommendation->sent_by,
            'send_to' => $this->recommendation->send_to,
        ];
    }
}
