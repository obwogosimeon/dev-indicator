<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarNotification extends Model
{
    protected $fillable = [
        'type', 
        'datetime', 
        'organizationfrom',
        'description',
        'user_id',
        'status',
        'rejected_by',
        'rejection_comment',
        'accept_comment',
        'approved_by',
        'organization_id',
        'close_comment',
        'closed_by'
    ];
}
