<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expense_details extends Model
{
    public function expense_detail_vehical()
    {
        return $this->belongsTo(vehical::class,'vehical_id');
    }
    public function expense_detail_expense()
    {
        return $this->belongsTo(expense::class,'expense_id');
    }
}
