<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airlines extends Model
{
    protected $table='airlines';
    protected $fillable = [
        'id', 'name', 'is_deleted', 'created_by', 'updated_by'
    ];
}
