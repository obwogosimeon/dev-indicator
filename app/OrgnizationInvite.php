<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrgnizationInvite extends Notification
{
    use Notifiable;

    protected $fillable = [
        'inviter_id', 
        'invited_id',
        'status',
        'email',
        'yourorganization',
    ];
}
