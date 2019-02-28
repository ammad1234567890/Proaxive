<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMembers extends Model
{
    protected $table='user_members';
    protected $fillable = [
        'id', 'user_id','first_name', 'last_name', 'passport_no', 'passport_attachment', 'is_deleted', 'relation_id'
    ];

    public function Relation(){
    	return $this->belongsTo('App\Relation', 'relation_id');
    }
}
