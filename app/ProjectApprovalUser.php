<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectApprovalUser extends Model
{
    protected $table="project_approval_users";
    protected $fillable = [
        'id', 'project_id','user_id'
    ];

    
}
