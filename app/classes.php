<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    public function class_branch()
    {
        return $this->belongsTo(branch::class,'branch_id');
    }
    public function class_course()
    {
        return $this->hasMany(course::class,'class_id');
    }
}
