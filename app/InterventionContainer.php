<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class InterventionContainer extends Model
{
    use Notifiable;

    protected $fillable = [
        'container_name',
        'status',
        'submitted_by',
        'submission_comment',
        'approved_by',
        'approved_on',
        'approved_by_email',
        'approval_comment',
        'forward_by',
        'forward_comment',
        'rejected_by',
        'reject_comment',
        'rejected_by_email',
        'rejected_on',
        'project_id',
        'created_by',
        'organization_id',
        'email',
        'name',
        'submitted_name',
        'submitted_on',
        'cancel_comment',
        'submitted_to',
        'submitted_to_email',
        'forward_to_email',
        'forwarded_by',
        'forwarded_on'
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\User');
    }
    
}
