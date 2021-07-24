<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;

    public function attendence_status()
    {
        return $this->belongsTo(Attendence_Status::class,'status');
    }

    protected $fillable = [
        'student_id', 'status', 'attendance_date',
    ];
}
