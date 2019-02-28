<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $table='locations';
    protected $fillable = [
        'id', 'name','code', 'is_deleted', 'created_by', 'updated_by'
    ];
}
