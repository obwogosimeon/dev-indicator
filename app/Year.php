<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = [
        'year_name', 
        'start_date', 
        'end_date',
        'status',
        'created_by',
        'organization_id',
        'program_id',
        'project_id',

    ];

    public function workplancontainer()
    {
        return $this->hasMany('App\WorkPlanContainer');
    }
}
