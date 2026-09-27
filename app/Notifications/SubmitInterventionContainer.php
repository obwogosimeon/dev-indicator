<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SubmitInterventionContainer extends Notification
{
    use Queueable;

    protected $process;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($process)
    {
        $this->process = $process;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Intervention Container Review')
                    ->greeting('Hi '.$notifiable->name)
                    ->line('The '.$notifiable->container_name. 'have been sent to you for review. The item was sent ')
                    ->line('from '.$notifiable->submitted_name. 'on '.$notifiable->submitted_on)
                    ->line('Kindly login to the system {{link to the user system}} for your action')
                    ->line('Thank you for using our application!')
                    ->salutation('best regards, DevIndicator Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
