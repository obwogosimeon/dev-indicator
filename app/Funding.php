<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
    protected $fillable = [
        'funding_name', 
        'funding_type',
        'expenditure',
        'variable_name',
        'description',
        'organization_id',
        'created_by',
        'type',
        'status',
        'updated_by',
        'program_id',
    ];

    public function budget()
    {
        return $this->hasMany('App\Budget');
    }
}
