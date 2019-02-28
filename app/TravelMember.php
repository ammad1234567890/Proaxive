<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelMember extends Model
{
    protected $table='travel_members';
    protected $fillable = [
        'id', 'travel_id','user_member_id','is_deleted'
    ];

    public function UserMember()
    {
        return $this->belongsTo('App\UserMembers', 'user_member_id');
    }
}
