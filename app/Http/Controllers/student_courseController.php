<?php

namespace App\Http\Controllers;

use App\course;
use App\course_student;
use App\User;
use Illuminate\Http\Request;
use DB;

class student_courseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('student_courses.all_student_courses')->with('student_course',course_student::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student_courses.register_student_courses')->with('course',course::all())->with('student',User::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required',
            'student_id' => 'required',

       ]);
        $course_student = new course_student();
        $course_student->course_id = $request->course_id;
        $course_student->student_id = $request->student_id;
        $course_student->status = "active";
        $result=$course_student->save();
          if($result){
                    return redirect('/student_course')->with('success','student Course Successfully Added.');
                }
                else{
                    return redirect('/student_course')->with('error','Record Not Added.');
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
        $course_student=course_student::findOrFail($id);
         $course_student=DB::table('course_students')
            ->where('course_students.id',$id)->join('courses','courses.id','course_students.course_id')->join('users','users.id','course_students.student_id')
            ->select('course_students.*','courses.course_name','users.first_name','users.last_name')
            ->first();
          $userData['data'] = $course_student;
           // dd($userData);
         echo json_encode($userData);
        exit;
//        return view('student_courses.update_student_courses')->with('course_student',$course_student)->with('course',course::all())->with('student',User::all());

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
         $validatedData = $request->validate([
                             'course_id' => 'required',
                             'student_id' => 'required',

                        ]);
        $result=course_student::whereId($id)->update([
            'course_id'=>$request->course_id,
            'student_id'=>$request->student_id,
            ]);
       if($result){
                    return redirect('/student_course')->with('success','student Course Successfully Updated.');
                }
                else{
                    return redirect('/student_course')->with('error','Record Not Updated.');
                }
    }
     public function student_course_change_status($id)
        {
           $branch=course_student::findOrFail($id);
           
           if($branch->status=="active"){
               course_student::whereId($id)->update([
                'status'=>'inactive',
              
                ]);
                echo json_encode("inactive");
                exit;
           }
           else{
               course_student::whereId($id)->update([
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
        $road_schedule=course_student::findOrFail($id);
        $result=$road_schedule->delete();
         if($result){
                    return redirect('/student_course')->with('success','student Course Successfully Delete.');
                }
                else{
                    return redirect('/student_course')->with('error','Record Not Delete.');
                }
    }
}
