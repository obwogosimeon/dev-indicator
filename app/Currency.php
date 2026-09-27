<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
     protected $fillable = [
        'currency_name', 
        'start_date',
        'kes',
        'rwf',
        'tzs',
        'ugx',
        'usd',
        'euro',
        'status',
        'created_by',
        'organization_id',
        'program_id',
    ];
}
