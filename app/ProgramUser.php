<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProgramUser extends Notification
{
    use Notifiable;

    protected $fillable = [
        'program_name', 
        'program_id', 
        'user_id',
        'email',
        'name',
    ];
}
