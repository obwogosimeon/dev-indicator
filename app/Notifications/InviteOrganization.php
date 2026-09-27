<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Auth;

class InviteOrganization extends Notification
{
    use Queueable;

    protected $input;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->input = $input;
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
                    // ->greeting('Hello '.$notifiable->name)
                    ->line('Welcome to Devindicator! The Monitoring and Evaluation web-based system of ' .$notifiable->yourorganization)
                    ->line($notifiable->yourorganization. ' invites you to be an affilicate organization')
                    ->action('Click here to Login ', url('https://'.Auth::user()->name. '.console.devindicators.com'))
                    ->line('For more information, please contact the organization administrator at ' .Auth::user()->email);
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
