<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Attendence_Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attendence.enroll_attendence')->with('user', User::where('user_type','user')->get())->with('attendence_status',Attendence_Status::where('att_status','active')->get());
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
            'attendance_date' => 'required|before_or_equal:'.$todayDate,
 
      ]);
       
        // dd($request);
        $j=0;
        $new_insert_array=array();
        // dd($request);
        $count =User::count();
        // dd($count);
        // for ($i=0; $i < $count; $i++) {
        // print_r($request->student_id[$i]);
        // $count = count($request->student_id);
        $attendence=new Attendence();
        for ($i=1; $i <= $count; $i++) {
            if(isset($request->student_id[$i])){

                $new_insert_array=array('status'=>$request->attendence_status,'student_id'=>$request->student_id[$i],'attendance_date'=>$request->attendance_date);
                //  dd($new_insert_array);
                $attendence::create($new_insert_array);
            }else{
                continue;
            }
        // $attendence->status=$request->attendence_status;
        // $attendence->student_id=$request->student_id[$i];
        // $attendence->save();

        // $j++;
        }
        return redirect()->route('attendence.create')->with('success','Attendance Marked Successfully.');
        // dd($new_insert_array);
        // $attendence::insert($new_insert_array);
        // $attendence->save();
        // dd($count);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =User::findOrFail($id);
        return view('attendence.show_all_attendence_of_student')->with('attendence',Attendence::where('student_id',$id)->get())->with('user',$user);

    }
    
      public function student_filter(Request $request)
    {
         $branch = DB::table('course_students')
            ->where('course_students.course_id',$request->course_id)
            ->join('users','users.id','course_students.student_id')
            ->select('users.*')
            ->get();
            
            return view('attendence.enroll_attendence')->with('user',$branch)->with('attendence_status',Attendence_Status::where('att_status','active')->get());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
