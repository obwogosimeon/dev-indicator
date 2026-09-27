<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    protected $fillable = [
        'output_name', 
        'output_code',
        'output_title',
        'output_description',
        'created_by',
        'status',
        'organization_id',
        'outcome_id',
        'log_frame_id',
        'program_id',
        'project_id'
    ];
}
