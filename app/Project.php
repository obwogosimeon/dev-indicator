<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  protected $fillable = [
    'project_name', 
    'start_date', 
    'end_date',
    'program_id',
    'logframe_id',
    'exchange_period',
    'description',
    'status',
    'created_by',
    'reporting_frequency',
    'organization_id',
    'basecurrency_id',
  ];

  public function program()
  {
    return $this->belongsTo('App\Program');
  }

  public function basecurrency()
  {
    return $this->belongsTo('App\BaseCurrency');
  }

  public function document(){
    return $this->hasMany('App\Document');
  }

  public function logframe()
  {
    return $this->belongsTo('App\LogFrame');
  }


  public function workplancontainers()
  {
    return $this->hasManyThrough('App\WorkPlanContainer', 'App\WorkPlan', 'container_project', 'id');
  }
  
}
