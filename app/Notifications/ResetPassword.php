<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Auth;

class ResetPassword extends Notification
{
    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
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
                    return (new MailMessage)
                    ->subject('Password Reset!')
                    ->greeting('Hello '.$notifiable->name)
                    ->line('We have received a Request to reset your password')
                    ->line('Your reset Password is: '.$notifiable->rawpassword)
                    // ->action('Click here to reset', url('https://visystem.net/change-password'))
                    ->action('Click here to reset', url('https://'.Auth::user()->name. '.console.devindicators.com/change-password'))
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
