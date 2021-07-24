<?php

namespace App\Http\Controllers;

use App\road_schedule;
use Illuminate\Http\Request;
use App\branch;
use App\classes;
use App\course;
use App\User;
use App\vehical;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Emailclient;

class roadScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        return view('roadschedule.all_schedule')->with('roadschedule',road_schedule::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roadschedule.register_schedule')->with('course',course::all())->with('users',User::all())->with('branch',branch::all())->with('vehical',vehical::all())->with('userss',User::all());
    }





    public function show_calender()
    {

        return view('roadschedule.all_schedule_on_calender')->with('schedules',road_schedule::all());
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
            'class_start' => 'required|before:class_end',
            'class_end' => 'required|after:class_start',
            'class_dayy' => 'required|after_or_equal:'.$todayDate,
            'student_id' => 'required',
            'instructor_id' => 'required',
            'course_id' => 'required',
            'branch_id' => 'required',
           'course_type' => 'required',
            'vehical_id' => 'required',

       ]);
        $student=User::findOrFail($request->student_id);
        $instructor=User::findOrFail($request->instructor_id);
        $roadschedule = new road_schedule();
        $roadschedule->class_start = $request->class_start;
        $roadschedule->class_end = $request->class_end;
        $roadschedule->class_day = $request->class_dayy;
        $roadschedule->student_id = $request->student_id;
        $roadschedule->instructor_id = $request->instructor_id;
        $roadschedule->course_id = $request->course_id;
        $roadschedule->branch_id = $request->branch_id;
        $roadschedule->course_type = $request->course_type;
        $roadschedule->vehical_id = $request->vehical_id;
        $roadschedule->status = "active";
        $result=$roadschedule->save();
        if($result){
            
                  $email = 'dev@softlinkage.net';
                    // $email =$student->email;

        $mailData = [
            'title' => 'Schedule',
            'Description' => 'Dear Student '.$student->first_name .' '.$student->last_name .' '.$request->text.' Schedule start '.$request->class_start .' and Schedule end '.$request->class_end.' Schedule Day '.$request->class_dayy .' with Instructor Name '.$instructor->first_name .' '.$instructor->last_name,

            'url' => 'https://dsms.jhamt.com'
        ];

       Mail::to($email)->send(new Emailclient($mailData));
       
       
        $email = 'dev@softlinkage.net';
          // $email =$student->email;

        $mailData = [
            'title' => 'Schedule',
        
              'Description' => 'Dear Instructor '.$instructor->first_name .' '.$instructor->last_name .' '.$request->text.' Schedule start '.$request->class_start .' and Schedule end '.$request->class_end.' Schedule Day '.$request->class_dayy .' with Student Name '.$student->first_name .' '.$student->last_name,

            'url' => 'https://dsms.jhamt.com'
        ];

       Mail::to($email)->send(new Emailclient($mailData));
                    return redirect('/roadschedule')->with('success','Road Schedule Successfully Added.');
                }
                else{
                    return redirect('/roadschedule')->with('error','Record Not Added.');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$road_schedule=road_schedule::findOrFail($id);
        
        $road_schedule=DB::table('road_schedules')
            ->where('road_schedules.id',$id)->join('branches','branches.id','road_schedules.branch_id')->join('courses','courses.id','road_schedules.course_id')
            ->join('vehicals','vehicals.id','road_schedules.vehical_id')->join('users AS  st','st.id','road_schedules.student_id')->join('users AS  inst','inst.id','road_schedules.instructor_id')
            ->select('road_schedules.*','branches.name AS branch_name','courses.course_name','st.first_name AS student_first_name','st.last_name AS student_last_name','vehicals.car_name','vehicals.number_plate','inst.first_name','inst.last_name')
            ->first();
            $userData['data'] = $road_schedule;
        
           // dd($userData);
         echo json_encode($userData);
         exit;
       // return view('roadschedule.update_schedule')->with('road_schedule',$road_schedule)->with('course',course::all())->with('users',User::all())->with('branch',branch::all())->with('vehical',vehical::all())->with('userss',User::all());
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
        //dd($request);
        $todayDate = date('Y/m/d');
 $validatedData = $request->validate([
            'class_start' => 'required|before:class_end',
            'class_end' => 'required|after:class_start',
            'class_day' => 'required|after_or_equal:'.$todayDate,
            'student_id' => 'required',
            'instructor_id' => 'required',
            'course_id' => 'required',
            'branch_id' => 'required',
            'course_type' => 'required',
            'vehical_id' => 'required',

                        ]);
        $student=User::findOrFail($request->student_id);
        $instructor=User::findOrFail($request->instructor_id);
        $result=road_schedule::whereId($id)->update([
            'class_start' => $request['class_start'],
            'class_end' => $request['class_end'],
            'class_day' => $request['class_day'],
            'student_id' => $request['student_id'],
            'instructor_id' => $request['instructor_id'],
            'course_id' => $request['course_id'],
            'branch_id' => $request['branch_id'],
            'course_type' => $request['course_type'],
            'vehical_id' => $request['vehical_id'],
            ]);
           if($result){
               
               
                           
             
                  $email = 'dev@softlinkage.net';
                    // $email =$student->email;

        $mailData = [
            'title' => 'Schedule',
            'Description' => 'Dear Student '.$student->first_name .' '.$student->last_name .' '.$request->text.' Schedule start '.$request->class_start .' and Schedule end '.$request->class_end.' Schedule Day '.$request->class_dayy .' with Instructor Name '.$instructor->first_name .' '.$instructor->last_name,

            'url' => 'https://dsms.jhamt.com'
        ];

       Mail::to($email)->send(new Emailclient($mailData));
       
       
        $email = 'dev@softlinkage.net';
          // $email =$instructor->email;

        $mailData = [
            'title' => 'Schedule',
        
              'Description' => 'Dear Instructor '.$instructor->first_name .' '.$instructor->last_name .' '.$request->text.' Schedule start '.$request->class_start .' and Schedule end '.$request->class_end.' Schedule Day '.$request->class_dayy .' with Student Name '.$student->first_name .' '.$student->last_name,

            'url' => 'https://dsms.jhamt.com'
        ];

       Mail::to($email)->send(new Emailclient($mailData));
                    return redirect('/roadschedule')->with('success','Road Schedule Successfully Updated.');
                }
                else{
                    return redirect('/roadschedule')->with('error','Record Not Updated.');
                }
    }
     public function scehdule_change_status($id)
        {
           $branch=road_schedule::findOrFail($id);
           
           if($branch->status=="active"){
               road_schedule::whereId($id)->update([
                'status'=>'inactive',
              
                ]);
                echo json_encode("inactive");
                exit;
           }
           else{
               road_schedule::whereId($id)->update([
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
        $road_schedule=road_schedule::findOrFail($id);
        $result=$road_schedule->delete();
        if($result){
                    return redirect('/roadschedule')->with('success','Road Schedule Successfully Deleted.');
                }
                else{
                    return redirect('/roadschedule')->with('error','Record Not Delete.');
                }
    }
}
