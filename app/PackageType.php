<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageType extends Model
{
    protected $fillable = [
        'package_name', 
        'package_amount',
        'user',
        'project'
    ];


        public function organization()
        {
        return $this->hasMany('App\Organization');
    	}
}
