<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Auth;

class AddUsertoProgram extends Notification
{
    use Queueable;

    protected $programuser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($programuser)
    {
        $this->programuser = $programuser;
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
                    ->subject('Program Invite!')
                    ->greeting('Hello '.$notifiable->name)
                    ->line('You have been invited to program '.$notifiable->program_name)
                    ->action('Click here to Login ', url('https://'.Auth::user()->name. '.console.devindicators.com'))
                    ->line('For more information kindly contact project admin '.Auth::user()->email)
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
