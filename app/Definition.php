<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Definition extends Model
{
    protected $fillable = [
        'template_id', 
        'definition_title',
        'standard',
        'status',
        'created_by',
        'organization_id'
    ];
}
