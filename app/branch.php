<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    public function branch_name()
    {
        return $this->hasMany(vehical::class,'branch_id');
    }
    public function branch_class()
    {
        return $this->hasMany(classes::class,'branch_id');
    }
    public function branch_roadschedule()
    {
        return $this->hasMany(road_schedule::class,'branch_id ');
    }
    public function branch_package()
    {
        return $this->hasMany(package::class,'branch_id');
    }
     public function branch_invoice()
    {
        return $this->hasMany(invoice::class,'branch_id');
    }
    public function branch_expenses()
    {
        return $this->hasMany(expense::class,'branch_id');
    }
}
