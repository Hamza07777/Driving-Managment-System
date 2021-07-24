<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehical extends Model
{
    public function vehical_branch()
    {
        return $this->belongsTo(branch::class,'branch_id');
    }
    public function vehical_instructor()
    {
        return $this->belongsTo(User::class,'instructor_id');
    }
    public function vehical_roadschedule()
    {
        return $this->hasMany(road_schedule::class,'vehical_id ');
    }
    public function vehical_expense_detail()
    {
        return $this->hasMany(expense_details::class,'vehical_id');
    }
}
