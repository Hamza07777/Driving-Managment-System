<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    public function invoice_student()
    {
        return $this->belongsTo(User::class,'student_id');
    }
    public function invoice_branch()
    {
        return $this->belongsTo(branch::class,'branch_id');
    }
}
