<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelStatus extends Model
{
    protected $table='travel_status';
    protected $fillable = [
        'id', 'name','is_deleted'
    ];
}
