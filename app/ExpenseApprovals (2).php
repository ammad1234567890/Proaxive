<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseApprovals extends Model {

    protected $table = 'expense_approvals';
    protected $fillable = [
        'id', 'expense_id', 'user_id', 'comment', 'status','request_status', 'created_at', 'updated_at'
    ];

}
