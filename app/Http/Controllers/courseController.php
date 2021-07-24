<?php

namespace App\Http\Controllers;
use App\branch;
use App\classes;
use App\course;
use App\User;
use Illuminate\Http\Request;
use DB;
use App\course_student;
use App\road_schedule;

class courseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('courses.all_courses')->with('course',course::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.register_course')->with('classes',classes::all())->with('users',User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'course_name' => 'required',
            'price' => 'required|numeric',
            'time_period' => 'required',
            'course_type' => 'required',
             'class_id' => 'required',
            'instructor_id' => 'required',

        ]);
        $course = new course();
        $course->course_name = $request->course_name;
        $course->price = $request->price;
        $course->time_period = $request->time_period;
        $course->course_type = $request->course_type;
        $course->class_id = $request->class_id;
        $course->instructor_id = $request->instructor_id;
        $course->status = "active";
       $result= $course->save();
          if($result){
                    return redirect('/course')->with('success','Course Successfully Added.');
                }
                else{
                    return redirect('/course')->with('error','Record Not Added.');
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
        //$course=course::findOrFail($id);
        
         $course=DB::table('courses')
            ->where('courses.id',$id)->join('classes','classes.id','courses.class_id')->join('users','users.id','courses.instructor_id')
            ->select('courses.*','classes.class_name','users.first_name','users.last_name')
            ->first();
  $userData['data'] = $course;
           // dd($userData);
         echo json_encode($userData);
        exit;
        
//return view('courses.update_course')->with('course',$course)->with('classes',classes::all())->with('users',User::all());
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
                    'course_name' => 'required',
                    'price' => 'required|numeric',
                    'time_period' => 'required',
                    'course_type' => 'required',
                       'class_id' => 'required',
                    'instructor_id' => 'required',

                ]);

        $result=course::whereId($id)->update([
            'course_name'=>$request->course_name,
            'price'=>$request->price,
            'time_period'=>$request->time_period,
            'course_type'=>$request->course_type,
            'class_id'=>$request->class_id,
            'instructor_id'=>$request->instructor_id,
            ]);
          if($result){
                    return redirect('/course')->with('success','Course Successfully Updated.');
                }
                else{
                    return redirect('/course')->with('error','Record Not Updated.');
                }


    }
    
     public function course_change_status($id)
    {
       $branch=course::findOrFail($id);
        //   $userData['data'] = $branch;
        //   // dd($userData);
        //  echo json_encode($userData);
        //  exit;
        // //retu
       if($branch->status=="active"){
           course::whereId($id)->update([
            'status'=>'inactive',
          
            ]);
            echo json_encode("inactive");
            exit;
       }
       else{
           course::whereId($id)->update([
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
        
           $course_student = course_student::where('course_id', $id)->get();
                              if( !empty($course_student)){
                                  $course_student = course_student::where('course_id', $id)->delete();
                              }
                                $road_schedule = road_schedule::where('course_id', $course->id)->get();
                           if( !empty($road_schedule)){
                                road_schedule::where('course_id', $course->id)->delete();
                           }
        $course=course::findOrFail($id);
        $result=$course->delete();
         if($result){
                    return redirect('/course')->with('success','Course Successfully Deleted.');
                }
                else{
                    return redirect('/course')->with('error','Record Not Deleted.');
                }
    }
}
