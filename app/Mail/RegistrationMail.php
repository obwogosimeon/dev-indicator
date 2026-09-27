<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $address = 'noreply@ychira.com';
      $name = 'Welcome to Devindicator Platform';
      $subject = 'Organization Account on Devindicator!';
      return $this->view('emails.mailme')
      ->from($address, $name)
      ->subject($subject);
    }
}
