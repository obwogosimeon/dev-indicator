<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'doc_name',
        'organization_id',
        'status',
        'program_id', 
        'user_id',
        'project_id',
        'status'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public function organization(){
        return $this->belongsTo('App\Organization');
    }

    public function program(){
        return $this->belongsTo('App\Program');
    }

    public function project(){
        return $this->belongsTo('App\Project');
    }
}
