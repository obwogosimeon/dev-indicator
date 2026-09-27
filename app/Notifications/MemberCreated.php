<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Auth;

class MemberCreated extends Notification
{
    use Queueable;

    protected $member;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($member)
    {
        $this->member = $member;
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
                    ->line('Welcome to Devindicator. We are glad to have you on board.')
                    ->line('You have been invited to : '.$notifiable->organization_name)
                    ->line('Your Username: '.$notifiable->email)
                    ->line('Your Password is: '.$notifiable->rawpassword)
                    ->action('Click here to Login ', url('https://'.Auth::user()->name. '.console.devindicators.com'))
                    ->line('Thank you for using our application!')
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
