<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImplementationContainer extends Model
{
    protected $fillable = [
        'container_name',
        'planning_type',
        'status',
        'created_by',
        'organization_id',
        'exchange_rate',
        'project_id',
        'financial_year',
        'workplancontainer_id',
        'submitted_by',
        'container_type',
        'implementation_start_date',
        'imeplementation_end_date',
        'reporting_frequency',
    ];

    public function workplancontainer()
    {
        return $this->belongsTo('App\WorkPlanContainer');
    }
}
