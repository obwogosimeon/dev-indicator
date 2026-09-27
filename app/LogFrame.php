<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogFrame extends Model
{
    protected $fillable = [
        'logframe_name', 
        'created_by', 
        'organization_id',
        //goal
        'goal_name',
        'goal_code',
        'goal_description',
        //outcome
        'outcome_goal',
        'outcome_title',
        'outcome_code',
        'outcome_description',
        //output
        'output_name',
        'output_title',
        'output_code',
        'output_description',
        //activity
        'activity_name',
        'activity_title',
        'activity_code',
        'activity_description',
    ];

    public function project(){
        return $this->hasMany('App\Project');
    }


    public function program(){
        return $this->hasMany('App\Program');
    }

    public function goal(){
        return $this->hasMany('App\Goal');
    }


    
}
