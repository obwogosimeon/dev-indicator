<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'project_id', 
        'entry_id', 
        'workplan_name',
        'annual_amounta',
        'annual_amountb',
        'annual_amountx',
        'financial_year',
        'exchange_rate',
        'status',
        'created_by',
        'organization_id',
        'activity_id',
        'indicator_id',
        'work_plan_container_id',
        'start_date',
        'end_date',
        'activity',
        'total',
        'budget_current_period1',
        'expense_current_period1',
        'comment1',
        'implementation_container_id',
    ];

    public function workplancontainer()
    {
        return $this->belongsTo('App\WorkPlanContainer');
    }

    public function budgetexpense()
    {
        return $this->hasMany('App\BudgetExpense');
    }

    public function funding()
  {
    return $this->belongsTo('App\Funding');
  }
}
