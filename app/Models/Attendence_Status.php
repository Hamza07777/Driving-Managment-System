<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence_Status extends Model
{
    public function attendence_status_status()
    {
        return $this->hasMany(Attendence::class,'status');
    }
    use HasFactory;
}
