<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    public function expense_branch()
    {
        return $this->belongsTo(branch::class,'branch_id');
    }
    public function expense_expense_detail()
    {
        return $this->hasMany(expense_details::class,'vehical_id');
    }
}
