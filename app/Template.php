<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'template_name', 
        'project_id',
        'program_id',
        'report_type',
        'report_draft_entry',
        'closed_reported_entry',
        'draft_entry',
        'approved_entry',
        'status',
        'created_by',
        'organization_id'
    ];
}
