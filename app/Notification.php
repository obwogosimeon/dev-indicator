<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function organization()
  {
    return $this->belongsTo('App\Organization');
  }
}
