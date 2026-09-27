<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Auth;

class AccountCreated extends Notification
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
        //
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
                    ->subject('Organization Account on Devindicator!')
                    ->greeting('Hello '.$notifiable->name)
                    ->line('Welcome to Devindicator. We are glad to have you on board.')
                    // ->line('Your URL: '.$notifiable->domain_name. '.devindicators.com')
                    ->line('Your Username: '.$notifiable->email)
                    ->line('Your Password is: '.$notifiable->rawpassword)
                    ->action('Click here to Login ', url('https://'.$notifiable->domain_name. '.console.devindicators.com'))
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
