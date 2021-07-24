<?php

namespace App\Http\Controllers;

use App\package;
use App\package_student;
use App\User;
use Illuminate\Http\Request;
use DB;

class student_packageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //     $id=3;
    //   $package_student=DB::table('package_students')
    //         ->where('package_students.id',$id)->join('packages',function ($join) {
    //         $join->orOn('packages.id','package_students.package_id');})->join('users','users.id','package_students.student_id')
    //          ->select('package_students.*','packages.detail AS detail' ,'users.first_name','users.last_name')
    //          ->first();
    //          dd($package_student);
        return view('student_packages.all_student_packages')->with('package',package_student::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student_packages.register_student_packages')->with('package',package::all())->with('student',User::all());
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
            'package_id' => 'required',
            'student_id' => 'required',

       ]);
        $package_student = new package_student();
        $package_student->package_id = $request->package_id;
        $package_student->student_id = $request->student_id;
        $package_student->status = "active";
        $result=$package_student->save();
        if($result){
                    return redirect('/student_package')->with('success','Student Package Successfully Added.');
                }
                else{
                    return redirect('/student_package')->with('error','Record Not Update.');
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
      //  $package_student=package_student::findOrFail($id);
         $package_student=DB::table('package_students')
            ->where('package_students.id',$id)->join('packages',function ($join) {
            $join->orOn('packages.id','package_students.package_id');})->join('users','users.id','package_students.student_id')
             ->select('package_students.*','packages.detail AS detail' ,'users.first_name','users.last_name')
             ->first();
             
        $userData['data'] = $package_student;
           // dd($userData);
         echo json_encode($userData);
        exit;
        //return view('student_packages.update_student_packages')->with('package_student',$package_student)->with('package',package::all())->with('student',User::all());
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
                             'package_id' => 'required',
                             'student_id' => 'required',

                        ]);
        $result=package_student::whereId($id)->update([
            'package_id'=>$request->package_id,
            'student_id'=>$request->student_id,
            ]);
        if($result){
                    return redirect('/student_package')->with('success','Student Package Successfully Update.');
                }
                else{
                    return redirect('/student_package')->with('error','Record Not Added.');
                }
    }


     public function student_package_change_status($id)
        {
           $branch=package_student::findOrFail($id);
           
           if($branch->status=="active"){
               package_student::whereId($id)->update([
                'status'=>'inactive',
              
                ]);
                echo json_encode("inactive");
                exit;
           }
           else{
               package_student::whereId($id)->update([
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
        $road_schedule=package_student::findOrFail($id);
        $result=$road_schedule->delete();
        if($result){
                    return redirect('/student_package')->with('success','Student Package Successfully Delete.');
                }
                else{
                    return redirect('/student_package')->with('error','Record Not Delete.');
                }
    }
}
