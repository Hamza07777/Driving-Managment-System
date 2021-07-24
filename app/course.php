<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    public function course_class()
    {
        return $this->belongsTo(classes::class,'class_id');
    }
    public function course_user()
    {
        return $this->belongsTo(User::class,'instructor_id');
    }
    public function course_roadschedule()
    {
        return $this->hasMany(road_schedule::class,'course_id');
    }
    public function course_appoinmnet()
    {
        return $this->hasMany(course::class,'course_id');
    }
    public function course_course_student()
    {
        return $this->hasMany(course_student::class,'course_id');
    }
}
