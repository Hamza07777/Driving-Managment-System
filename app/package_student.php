<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class package_student extends Model
{
    public function student_package_package()
    {
        return $this->belongsTo(package::class,'package_id');
    }
    public function student_package_student()
    {
        return $this->belongsTo(User::class,'student_id');
    }
}
