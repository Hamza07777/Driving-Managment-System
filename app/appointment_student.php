<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class appointment_student extends Model
{
    public function student_appoinment_appointment()
    {
        return $this->belongsTo(appointment::class,'appointment_id');
    }

    public function appointment_student_appoinmentss()
    {
        return $this->belongsTo(User::class,'student_id');
    }

}
