<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class road_schedule extends Model
{
    public function road_schedule_instructor()
    {
        return $this->belongsTo(User::class,'instructor_id');
    }
    public function road_schedule_student()
    {
        return $this->belongsTo(User::class,'student_id');
    }
    public function road_schedule_coursess()
    {
        return $this->belongsTo(course::class,'course_id');
    }
    public function road_schedule_branch()
    {
        return $this->belongsTo(branch::class,'branch_id');
    }
    public function road_schedule_vehical()
    {
        return $this->belongsTo(vehical::class,'vehical_id');
    }


    public function calender()
    {
        $events = [];
        $data = road_schedule::all();
        if($data->count())
         {
            foreach ($data as $key => $value) 
            {
                $events[] = Calender::event(
                    $value->title,
                    true,
                    new \DateTime($value->start_date),
                    new \DateTime($value->end_date.'+1 day'),
                    null,
                    // Add color
                 [
                     'color' => '#000000',
                     'textColor' => '#008000',
                 ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);
        return view('calender', compact('calendar'));
    }
}
