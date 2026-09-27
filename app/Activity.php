<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'activity_name', 
        'activity_title', 
        'activity_code',
        'activity_description',
        'goal_id',
        'log_frame_id',
        'status',
        'created_by',
        'organization_id',
        'outcome_id',
        'output_id',
        'program_id',
        'project_id',
    ];

    public function goal()
    {
        return $this->belongsTo('App\Goal');
    }

    public function intervention(){
        return $this->hasMany('App\Intervention');
    }
}
