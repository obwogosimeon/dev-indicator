<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
  protected $fillable = [
    'goal_name', 
    'goal_code',
    'goal_description',
    'log_frame_id',
    'organization_id',
    'created_by',
    'status'
  ];

  public function logframe()
  {
    return $this->belongsTo('App\LogFrame');
  }

  public function outcome()
  {
    return $this->hasMany('App\Outcome');
  }

  public function indicator(){
    return $this->hasMany('App\Indicator');
  }

  public function activity(){
    return $this->hasMany('App\Activity');
  }

}
