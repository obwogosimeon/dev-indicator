<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Organization extends Notification
{

    use Notifiable;

    protected $fillable = [
        'access_code',
        'kra_pin',
        'address',
        'email',
        'organization_name',
        'created_by',
        'status',
        'package_type_id',
        'organization_level',
        'parent_id',
        'country',
        'domain_name',
        'phone_number',
        'filename',
        'mime',
        'original_filename',
        'yourorganization'
    ];

    public function notification(){
        return $this->hasMany('App\Notification');
    }

    public function user(){
        return $this->hasMany('App\User');
    }

    public function document(){
        return $this->hasMany('App\Document');
    }

    public function packagetype()
    {
        return $this->belongsTo('App\PackageType');
    }


    
}
