<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Notification extends Model
{
    protected $fillable = [
        'organization_id', 
        'host',
        'port',
        'encryption',
        'username',
        'password',
        'driver',
        'created_by'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = $password === null ? null : Crypt::encrypt($password);
    }

    public function getPasswordAttribute($password)
    {
        if ($password === null || $password === '') {
            return $password;
        }

        try {
            return Crypt::decrypt($password);
        } catch (DecryptException $exception) {
            return $password;
        }
    }

    public function organization()
  {
    return $this->belongsTo('App\Organization');
  }
}
