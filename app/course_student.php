<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_student extends Model
{
    public function student_course_course()
    {
        return $this->belongsTo(course::class,'course_id');
    }
    public function course_student_student()
    {
        return $this->belongsTo(User::class,'student_id');
    }
}
