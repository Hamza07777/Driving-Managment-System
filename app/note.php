<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class note extends Model
{
    protected $fillable = [
        'note', 'admin_id', 'receptionist_id','branch_id',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id');
    }
    public function note_user()
    {
        return $this->belongsTo(User::class,'receptionist_id');
    }
}
