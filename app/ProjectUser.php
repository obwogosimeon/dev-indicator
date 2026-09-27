<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProjectUser extends Notification
{

    use Notifiable;

    protected $fillable = [
        'project_name', 
        'project_id', 
        'user_id',
        'email',
        'name',
    ];
}
