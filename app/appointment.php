<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class appointment extends Model
{
    public function appoinment_user()
    {
        return $this->belongsTo(User::class,'instructor_id');
    }
    public function appoinment_course()
    {
        return $this->belongsTo(course::class,'course_id');
    }
    public function appointment_student_appoinment()
    {
        return $this->hasMany(appointment_student::class,'appointment_id ');
    }
}
