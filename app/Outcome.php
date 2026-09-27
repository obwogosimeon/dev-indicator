<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    protected $fillable = [
        'outcome_goal', 
        'outcome_title',
        'outcome_code',
        'outcome_description',
        'created_by',
        'status',
        'organization_id',
        'log_frame_id',
        'goal_id',
        'program_id',
        'project_id'
    ];

     public function goal()
  {
    return $this->belongsTo('App\Goal');
  }
}
