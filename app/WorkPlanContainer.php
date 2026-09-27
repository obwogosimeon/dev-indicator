<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class WorkPlanContainer extends Model
{

    use Notifiable;

    protected $fillable = [
        'container_name',
        'planning_type',
        'status',
        'created_by',
        'organization_id',
        'wactivity',
        'wstart_date',
        'wend_date',
        'wname',
        'wstatus',
        'wcreated_by',
        'exchange_rate',
        'project_id',
        'financial_year',
        'submitted_by',
        'submission_comment',
        'cancel_comment',
        'cancel_date',
        'submitted_to',
        'submitted_to_email',
        'submitted_on',
        'email',
    ];


    public function workplan()
    {
        return $this->hasMany('App\WorkPlan');
    }

    public function budget()
    {
        return $this->hasMany('App\Budget');
    }

    public function indicatortarget()
    {
        return $this->hasMany('App\IndicatorTarget');
    }

    public function implementationcontainer()
    {
        return $this->hasMany('App\ImplementationContainer');
    }


    public function projects()
    {
        return $this->hasMany('WorkPlan', 'workplancontainer_id', 'id');
    }

    public function year()
    {
        return $this->belongsTo('App\Year');
    }
}

