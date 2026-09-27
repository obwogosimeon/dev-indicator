<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Auth;

class InviteMember extends Notification
{
    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
                    ->subject('Organization Invite!')
                    ->greeting('Hello '.$notifiable->name)
                    ->line('Welcome to Devindicator! The Monitoring and Evaluation web-based system of ' .Auth::user()->organization_name)
                    ->line('Your Username: '.$notifiable->email)
                    ->line('Your Password is: '.$notifiable->rawpassword)
                    ->action('Click here to Login ', url('https://'.Auth::user()->name. '.console.devindicators.com'))
                    ->line('For more information, please contact the system administrator at ' .Auth::user()->email)
                    ->salutation('Best regards, DevIndicator Team');
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
