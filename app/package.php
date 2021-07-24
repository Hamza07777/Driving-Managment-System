<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    public function package_branch()
    {
        return $this->belongsTo(branch::class,'branch_id');
    }
    public function package_student_package()
    {
        return $this->hasMany(package_student::class,'package_id');
    }
}
