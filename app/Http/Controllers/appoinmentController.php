<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\appointment;
use App\appointment_student;
use App\branch;
use App\classes;
use App\course;
use App\User;
use App\vehical;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Emailclient;

class appoinmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('appoinment.all_appoinment')->with('appointment',appointment::all());
    }
    public function student_appoinment()
    {

    }

    public function show_calender_appoinment()
    {

        return view('appoinment.all_appoinment_on_calender')->with('appointment',appointment::all());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appoinment.register_appoinment')->with('course',course::all())->with('users',User::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $todayDate = date('Y/m/d');
        $validatedData = $request->validate([
            'text' => 'required|max:255',
            'appoinment_start' => 'required|max:255|before:appoinment_end',
            'appoinment_end' => 'required|max:255|after:appoinment_start',
            'appoinment_day' => 'required|max:255|after_or_equal:'.$todayDate,
            'instructor_id' => 'required|max:255',
            'course_id' => 'required|max:255',
            'student_id' => 'required|max:255',
        ]);
              $student=User::findOrFail($request->student_id);
        $instructor=User::findOrFail($request->instructor_id);
        $appointment = new appointment();
        $appointment->text = $request->text;
        $appointment->appoinment_start = $request->appoinment_start;
        $appointment->appoinment_end = $request->appoinment_end;
        $appointment->appoinment_day = $request->appoinment_day;
        $appointment->instructor_id = $request->instructor_id;
        $appointment->course_id = $request->course_id;
        $appointment->status = "active";
        $result=$appointment->save();
        $id=appointment::max('id');
        //$student_id=Auth::user()->id;
        $student_appoinment=new appointment_student();
        $student_appoinment->student_id=$request->student_id;
        $student_appoinment->appointment_id =$id;
        $student_appoinment->save();
        
  
        if($result){
            
                $email = 'dev@softlinkage.net';
               // $email =$student->email;

        $mailData = [
            'title' => 'Appointments Schedule',
            'Description' => 'Dear Student '.$student->first_name .' '.$student->last_name .' '.$request->text.' appointments start '.$request->appoinment_start .' and appointments end '.$request->appoinment_end.' Instructor Name '.$instructor->first_name .' '.$instructor->last_name,

            'url' => 'https://dsms.jhamt.com'
        ];

       Mail::to($email)->send(new Emailclient($mailData));
       
       
        $email = 'dev@softlinkage.net';
        // $email =$instructor->email;
        $mailData = [
            'title' => 'Appointment Schedule',
             'Description' => 'Dear Instructor '.$instructor->first_name .' '.$instructor->last_name .' '.$request->text.' Appointments Start'.$request->appoinment_start .' Appointments End '.$request->appoinment_end.' Student Name '.$student->first_name .' '.$student->last_name,

            'url' => 'https://dsms.jhamt.com'
        ];

       Mail::to($email)->send(new Emailclient($mailData));
                    return redirect('/appoinment')->with('success','Appoinment Successfully Added.');
                }
                else{
                    return redirect('/appoinment')->with('error','Record Not Added.');
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //  $appointment=appointment::findOrFail($id);
         $appointment=DB::table('appointments')
            ->where('appointments.id',$id)->join('courses','courses.id','appointments.course_id')->join('users','users.id','appointments.instructor_id')->join('appointment_students','appointment_students.appointment_id','appointments.id')->join('users As student_user','student_user.id','appointment_students.student_id')
            ->select('appointments.*','courses.course_name','users.first_name','users.last_name','student_user.id As student_id','student_user.first_name As student_first_name','student_user.last_name As student_last_name')
            ->first();
           $userData['data'] = $appointment;
           // dd($userData);
         echo json_encode($userData);
        exit;
       // return view('appoinment.update_appoinment')->with('appointment',$appointment)->with('course',course::all())->with('users',User::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $todayDate = date('Y/m/d');
        $validatedData = $request->validate([
                    'text' => 'required|max:255',
                    'appoinment_start' => 'required|max:255|before:appoinment_end',
            'appoinment_end' => 'required|max:255|after:appoinment_start',
            'appoinment_day' => 'required|max:255|after_or_equal:'.$todayDate,
                    'instructor_id' => 'required|max:255',
                    'course_id' => 'required|max:255',
                     'student_id' => 'required|max:255',
                ]);
      $student=User::findOrFail($request->student_id);
        $instructor=User::findOrFail($request->instructor_id);
        $result=appointment::whereId($id)->update([
            'text'=>$request['text'],
            'appoinment_start' => $request['appoinment_start'],
            'appoinment_end' => $request['appoinment_end'],
            'appoinment_day' => $request['appoinment_day'],
            'instructor_id' => $request['instructor_id'],
            'course_id' => $request['course_id'],
            ]);
            appointment_student::where('appointment_id',$id)->update([
            'student_id'=>$request['student_id'],
            ]);
           if($result){
               
                 $email = 'dev@softlinkage.net';
                 // $email =$student->email;
                 

        $mailData = [
            'title' => 'Appointment Update',
            'Description' => 'Dear Student '.$student->first_name .' '.$student->last_name .' '.$request->text.' appointments start '.$request->appoinment_start .' and appointments end '.$request->appoinment_end.' Instructor Name '.$instructor->first_name .' '.$instructor->last_name,

            'url' => 'https://dsms.jhamt.com'
        ];

       Mail::to($email)->send(new Emailclient($mailData));
       
       
        $email = 'dev@softlinkage.net';
        // $email =$instructor->email;

        $mailData = [
            'title' => 'Appointments Schedule',
             'Description' => 'Dear Instructor '.$instructor->first_name .' '.$instructor->last_name .' '.$request->text.' Appointments Start'.$request->appoinment_start .' Appointments End '.$request->appoinment_end.' Student Name '.$student->first_name .' '.$student->last_name,

            'url' => 'https://dsms.jhamt.com'
        ];

       Mail::to($email)->send(new Emailclient($mailData));
                    return redirect('/appoinment')->with('success','Appoinment Successfully Updated.');
                }
                else{
                    return redirect('/appoinment')->with('error','Record Not Updated.');
                }

    }
    
     public function appointment_change_status($id)
    {
       $branch=appointment::findOrFail($id);
       
       if($branch->status=="active"){
           appointment::whereId($id)->update([
            'status'=>'inactive',
          
            ]);
            echo json_encode("inactive");
            exit;
       }
       else{
           appointment::whereId($id)->update([
            'status'=>'active',
          
            ]);
             echo json_encode("active");
            exit;
       }
        
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 


                        $appointment_student = appointment_student::where('appointment_id', $id)->get();
                                       if( !empty($appointment_student)){
                                           appointment_student::where('appointment_id', $id)->delete();
                                       }
        $road_schedule=appointment::findOrFail($id);
        $result=$road_schedule->delete();
          if($result){
                    return redirect('/appoinment')->with('success','Appoinment Successfully Deleted.');
                }
                else{
                    return redirect('/appoinment')->with('error','Record Not Deleted.');
                }

    }
    //delete student appoinmnet


}
