<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelExpenseList extends Model
{
    protected $table='travel_expense_list';
    protected $fillable = [
        'id', 
        'expense_type',
        'travel_expense_id',
        'date',
        'description',
        'receipt_number',
        'amount', 
        'created_at', 
        'updated_at'
    ];

   
}
