<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password','last_name','user_type','date_of_birth','phone_number','image','address','city','province','postal_code','gender','status','branch_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function routeNotificationForNexmo($notification)
    {
        return $this->phone_number;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function notes()
    {
        return $this->hasMany(note::class,'admin_id');
    }

    public function user_notesss()
    {
        return $this->hasMany(note::class,'receptionist_id');
    }

    public function user_vehical()
    {
        return $this->hasMany(vehical::class,'instructor_id');
    }

    public function user_course()
    {
        return $this->hasMany(course::class,'instructor_id');
    }

    public function student_roadschedule()
    {
        return $this->hasMany(road_schedule::class,'student_id');
    }

    public function instructor_roadschedule()
    {
        return $this->hasMany(road_schedule::class,'instructor_id');
    }

    public function user_appoinmnet()
    {
        return $this->hasMany(appointment::class,'instructor_id');
    }

    public function student_student_package()
    {
        return $this->hasMany(package_student::class,'student_id');
    }

    public function student_course_student()
    {
        return $this->hasMany(course_student::class,'student_id');
    }

    public function student_invoice()
    {
        return $this->hasMany(invoice::class,'student_id');
    }

    public function student_student_appoinment()
    {
        return $this->hasMany(appointment_student::class,'student_id');
    }
}
