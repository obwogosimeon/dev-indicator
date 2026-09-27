<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'account_name', 
        'account_code', 
        'account_type',
        'account_group',
        'description',
        'status',
        'created_by',
        'organization_id',
        'type', 
    ];
}
