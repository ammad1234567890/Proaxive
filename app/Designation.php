<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table='designation';
    protected $fillable = [
        'id', 'name','is_deleted','created_by', 'updated_by'
    ];
}
