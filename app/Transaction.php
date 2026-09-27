<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'project_id',
        'implementation_container_id',
        'program_id',
        'budget_id', 
        'total_expense',
        'total_budget',
        'reporting_frequency_tally',
        'total_utilization',
        'funding_id',
    ];
}
