<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkPlan extends Model
{
  protected $fillable = [
    'activity',
    'start_date', 
    'end_date', 
    'workplan_name',
    'workplan_description',
    'status',
    'created_by',
    'organization_id',
    'financial_year',
    'exchange_rate',
    'work_plan_container_id',
    ''
  ];

  public function workplancontainer()
  {
    return $this->belongsTo('App\WorkPlanContainer');
  }

  public function budget()
  {
    return $this->belongsTo('App\budget');
  }
}
