<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    protected $fillable = [
        'activity_name', 
        'activity_id',
        'funding1',
        'funding2',
        'funding3',
        'total',
        'status',
        'organization_id',
        'created_by',
        'project_id',
        'intervention_id',
        'intervention_container_id',
    ];

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

}
