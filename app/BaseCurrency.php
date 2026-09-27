<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseCurrency extends Model
{
    protected $fillable = [
        'currency_name', 
        'created_by', 
        'updated_by',
    ];

    public function program(){
        return $this->hasMany('App\Program');
    }

    public function project(){
        return $this->hasMany('App\Project');
    }
    
}
