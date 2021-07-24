<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\Emailclient;
use App\road_schedule;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\User;

class sendmail_everymint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email Send succesfully';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todayDate = date('Y/m/d');
        $scedule=road_schedule::where('class_day',$todayDate)->get();
        
         foreach( $scedule as $scedule )
         {
             
        $student=User::findOrFail($scedule->student_id);
        $instructor=User::findOrFail($scedule->instructor_id);
        $email = 'dev@softlinkage.net';
        // $email =$student->email;
        $mailData = [
            'title' => 'Today Student Schedule',
            // 'Description' => $scedule->class_start,
            'Description' => 'Class will start at '.$scedule->class_start.' and end at '.$scedule->class_end.' with instructor name '.$instructor->first_name.' '.$instructor->last_name.' with student '.$student->first_name.' '.$student->last_name.' of course '.$scedule->road_schedule_coursess->course_name.' of vehical '.$scedule->road_schedule_vehical->car_name.' '.$scedule->road_schedule_vehical->car_no,
            'url' => 'https://dsms.jhamt.com'
        ];

             Mail::to($email)->send(new Emailclient($mailData));
             
             
        $email = 'dev@softlinkage.net';
 // $email =$instructor->email;
        $mailData = [
            'title' => 'Today Instructor Schedule',
            // 'Description' => $scedule->class_start,
            'Description' => 'Class will start at '.$scedule->class_start.' and end at '.$scedule->class_end.' with instructor name '.$instructor->first_name.' '.$instructor->last_name.' with student '.$student->first_name.' '.$student->last_name.' of course '.$scedule->road_schedule_coursess->course_name.' of vehical '.$scedule->road_schedule_vehical->car_name.' '.$scedule->road_schedule_vehical->car_no,
            'url' => 'https://dsms.jhamt.com'
        ];

             Mail::to($email)->send(new Emailclient($mailData));
         }
           
        // return redirect()->back();
    }
}
