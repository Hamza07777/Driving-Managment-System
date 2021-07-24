<?php

namespace App\Http\Controllers;

use App\branch;
use App\package;
use App\package_student;
use Illuminate\Http\Request;
use DB;

class packageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('packages.all_packages')->with('package',package::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('packages.register_packages')->with('branch',branch::all());
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
            'detail' => 'required',
            'theory_hours' => 'required',
            'practical_hours' => 'required',
            'exam_attempt' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'branch_id' => 'required',

       ]);
        $package = new package();
            $package->detail = $request->detail;
            $package->theory_hours = $request->theory_hours;
            $package->practical_hours = $request->practical_hours;
            $package->exam_attempt = $request->exam_attempt;
            $package->duration = $request->duration;
            $package->price = $request->theory_hours;
            $package->branch_id = $request->branch_id;
            $package->status = "active";
            $result=$package->save();
              if($result){
                    return redirect('/package')->with('success','Package Successfully Added.');
                }
                else{
                    return redirect('/package')->with('error','Record Not Added.');
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
       // $package=package::findOrFail($id);
         $package=DB::table('packages')
            ->where('packages.id',$id)->join('branches','branches.id','packages.branch_id')
            ->select('packages.*','branches.name')
            ->first();
           $userData['data'] = $package;
           // dd($userData);
         echo json_encode($userData);
        exit;
      //  return view('packages.update_packages')->with('branch',branch::all())->with('package',$package);
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
      //  dd($request);

        $validatedData = $request->validate([
                             'detail' => 'required',
                             'theory_hours' => 'required',
                             'practical_hours' => 'required',
                             'exam_attempt' => 'required',
                             'duration' => 'required',
                             'price' => 'required',
                             'branch_id' => 'required',

                        ]);
        $result=package::whereId($id)->update([
            'detail'=>$request->detail,
            'theory_hours'=>$request->theory_hours,
            'practical_hours'=>$request->practical_hours,
            'exam_attempt'=>$request->exam_attempt,
            'duration'=>$request->duration,
            'price'=>$request->price,
            'branch_id'=>$request->branch_id,
            ]);
           if($result){
                    return redirect('/package')->with('success','Package Successfully Updated.');
                }
                else{
                    return redirect('/package')->with('error','Record Not Updated.');
                }
    }
 public function package_change_status($id)
    {
       $branch=package::findOrFail($id);
       
       if($branch->status=="active"){
           package::whereId($id)->update([
            'status'=>'inactive',
          
            ]);
            echo json_encode("inactive");
            exit;
       }
       else{
           package::whereId($id)->update([
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
                $package_student = package_student::where('package_id', $id)->get();
                      if(!empty($package_student)){
                           $package_student = package_student::where('package_id', $id)->delete();
                      }
        $road_schedule=package::findOrFail($id);
        $result=$road_schedule->delete();
         if($result){
                    return redirect('/package')->with('success','Package Successfully Deleted.');
                }
                else{
                    return redirect('/package')->with('error','Record Not Deleted.');
                }
    }
}
