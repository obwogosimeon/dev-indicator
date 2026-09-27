<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'program_name', 
        'start_date', 
        'end_date',
        'log_frame_id',
        'description',
        'status',
        'organization_id',
        'created_by',
        'basecurrency_id',
        'currency'
    ];

    public function project(){
        return $this->hasMany('App\Project');
    }

    public function document(){
        return $this->hasMany('App\Document');
    }

    public function logframe()
    {
        return $this->belongsTo('App\LogFrame','log_frame_id','id');
    }

    public function basecurrency()
    {
        return $this->belongsTo('App\BaseCurrency');
    }


    public function setCurrencyAttribute($value)
    {
        $this->attributes['currency'] = json_encode($value);
    }

    public function getCurrencyAttribute($value)
    {
        return $this->attributes['currency'] = json_decode($value);
    }
}
