<?php

namespace App\Http\Controllers;
use App\branch;
use App\classes;
use Illuminate\Http\Request;
use DB;
use App\course;
use App\course_student;
use App\road_schedule;
use App\appointment_student;
use App\appointment;

class classesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {
        //      $classes=DB::table('classes')
        //     ->where('classes.branch_id',$id)->join('branches','branches.id','classes.branch_id')
        //     ->select('classes.*','branches.name')
        //     ->first();
        //   //  dd($classes);
            return view('classes.all_classes')->with('branch',branch::all())->with('classes',classes::all());
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classes.register_classes')->with('branch',branch::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'class_name' => 'required',
            'class_duration' => 'required',
            'no_of_theoratical' => 'required|numeric',
            'no_of_practical' => 'required|numeric',
             'branch_id' => 'required',
        ]);
        $classes = new classes();
            $classes->class_name = $request->class_name;
            $classes->class_duration = $request->class_duration;
            $classes->no_of_theoratical = $request->no_of_theoratical;
            $classes->no_of_practical = $request->no_of_practical;
            $classes->branch_id = $request->branch_id;
            $classes->status = "active";
            $result=$classes->save();
            if($result){
                    return redirect('/classes')->with('success','Class Successfully Added.');
                }
                else{
                    return redirect('/classes')->with('error','Record Not Added.');
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
            $classes=DB::table('classes')
            ->where('classes.id',$id)->join('branches','branches.id','classes.branch_id')
            ->select('classes.*','branches.name')
            ->first();
          //  dd($classes);
        //$classes=classes::findOrFail($id);
        $userData['data'] = $classes;
        
           // dd($userData);
         echo json_encode($userData);
         exit;
       // return view('classes.update_classes')->with('classes',$classes)->with('branch',branch::all());
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
            'class_name' => 'required',
                 'class_duration' => 'required',
            'no_of_theoratical' => 'required|numeric',
            'no_of_practical' => 'required|numeric',
             'branch_id' => 'required',
        ]);
        $result=classes::whereId($id)->update([
            'class_name'=>$request->class_name,
            'class_duration'=>$request->class_duration,
            'no_of_theoratical'=>$request->no_of_theoratical,
            'no_of_practical'=>$request->no_of_practical,
            'branch_id'=>$request->branch_id,


            ]);
            if($result){
                    return redirect('/classes')->with('success','Class Successfully Updated.');
                }
                else{
                    return redirect('/classes')->with('error','Record Not Updated.');
                }
    }


 public function class_change_status($id)
    {
       $branch=classes::findOrFail($id);
       
       if($branch->status=="active"){
           classes::whereId($id)->update([
            'status'=>'inactive',
          
            ]);
            echo json_encode("inactive");
            exit;
       }
       else{
           classes::whereId($id)->update([
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
        
        
         $course = course::where('class_id', $id)->get();
                      if(!empty($course)){
                          foreach ($course as $course) {
                              $course_student = course_student::where('course_id', $course->id)->get();
                              if( !empty($course_student)){
                                  $course_student = course_student::where('course_id', $course->id)->delete();
                              }
                              
                              
                               $road_schedule = road_schedule::where('course_id', $course->id)->get();
                           if( !empty($road_schedule)){
                                road_schedule::where('course_id', $course->id)->delete();
                           }
                           
                           
                           
                            $appointment = appointment::where('course_id', $course->id)->get();
                           if( !empty($appointment)){
                               foreach ($appointment as $appointment) {
                                        $appointment_student = appointment_student::where('appointment_id', $appointment->id)->get();
                                       if( !empty($appointment_student)){
                                           appointment_student::where('appointment_id', $appointment->id)->delete();
                                       }
                               }
                               
                                appointment::where('course_id', $course->id)->delete();
                           }
                           
                          } 
                          
                          
                            course::where('class_id', $id)->delete();
                      }
        
        
        $classes=classes::findOrFail($id);
        $result=$classes->delete();
         if($result){
                    return redirect('/classes')->with('success','Class Successfully Deleted.');
                }
                else{
                    return redirect('/classes')->with('error','Record Not Deleted.');
                }
    }
}
