<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $fillable = [
        'activity_name', 
        'goal_name',
        'output_name',
        'outcome_name',
        'indicator_title',
        'reporting_frequency',
        'disaggregation',
        'indicator_description',
        'type',
        'status',
        'organization_id',
        'created_by',
        'log_frame_id',
        'goal_id',
        'label_none',
        'baseline_none',
        'target_none',
        'dvalue',
        'dtarget',
        'dbaseline',
        'activity_id',
        'output_id',
        'outcome_id',
        'project_id',
        'program_id',
        
    ];

    public function goal()
    {
        return $this->belongsTo('App\Goal');
    }

    public function indicatortarget()
    {
        return $this->hasManay('App\IndicatorTarget');
    }


    public function setDvalueAttribute($value)
    {
        $this->attributes['dvalue'] = json_encode($value);
    }
  
    /**
     * Get the categories
     *
     */
    public function getDvalueAttribute($value)
    {
        return $this->attributes['dvalue'] = json_decode($value);
    }



    public function setDbaselineAttribute($value)
    {
        $this->attributes['dbaseline'] = json_encode($value);
    }
  
    /**
     * Get the categories
     *
     */
    public function getDbaselineAttribute($value)
    {
        return $this->attributes['dbaseline'] = json_decode($value);
    }


    public function setDtargetAttribute($value)
    {
        $this->attributes['dtarget'] = json_encode($value);
    }
  
    /**
     * Get the categories
     *
     */
    public function getDtargetAttribute($value)
    {
        return $this->attributes['dtarget'] = json_decode($value);
    }
}
