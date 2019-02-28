<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelRequest extends Model
{
    protected $table='travel_request';
    protected $fillable = [
        'id', 
        'request_no',
        'purpose',
        'trip_from_loc',
        'trip_to_loc',
        'travel_type', 
        'user', 
        'start_date',
        'end_date', 
        'line_manager_attachments',
        'class',
        'is_deleted', 
        'status', 
        'airline_id',
        'comment'
    ];

    public function FromLoc()
    {
        return $this->belongsTo('App\Locations', 'trip_from_loc');
    }
    public function Toloc()
    {
        return $this->belongsTo('App\Locations', 'trip_to_loc');
    }
    public function Traveltype()
    {
        return $this->belongsTo('App\TravelType', 'travel_type');
    }
    public function User()
    {
        return $this->belongsTo('App\User', 'user');
    }
    public function Status()
    {
        return $this->belongsTo('App\TravelStatus', 'status');
    }
    public function Airline()
    {
        return $this->belongsTo('App\Airlines', 'airline_id');
    }
    public function Members()
    {
        return $this->hasMany('App\TravelMember', 'travel_id');
    }
    public function Approvals()
    {
        return $this->hasMany('App\RequestApprovals', 'request_id');
    }
}
