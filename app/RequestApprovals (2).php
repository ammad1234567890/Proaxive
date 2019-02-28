<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestApprovals extends Model
{
    protected $table='request_approvals';
    protected $fillable = [
        'id', 'request_id','user_id', 'comment', 'status','request_status'
    ];

    public function User(){
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function travel_request(){
    	return $this->belongsTo('App\TravelRequest', 'request_id');
    }

    
}
