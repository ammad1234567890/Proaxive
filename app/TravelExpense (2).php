<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelExpense extends Model
{
    protected $table='travel_expense';
    protected $fillable = [
        'id', 
        'employee_id',
        'travelexpense_no',
        'expense_type',
        'travel_id',
        'expense_authorization_docs',
        'attachment_docs', 
        'travel_purpose', 
        'payment_order_number',
        'destination_id',
        'destination',
        'payment_order_ number', 
        'email_date', 
        'currency_id', 
        'by_order_of',
        'on_account_of',
        'on_account_of_location',
        'total_amount',
        'created_at',
        'updated_at',
		'user_id',
		'expense_claim_no'
    ];

   
}
