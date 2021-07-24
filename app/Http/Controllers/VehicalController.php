<?php

namespace App\Http\Controllers;

use App\branch;
use App\User;
use App\vehical;
use App\road_schedule;
use App\expense_details;
use Illuminate\Http\Request;
use DB;

class VehicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        return view('vehicals.all_vehical')->with('vehical',vehical::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=User::where('user_type','user')->get();
        return view('vehicals.register_vehical')->with('branch',branch::all())->with('user',$user);
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
            'car_no' => 'required|max:255|unique:vehicals',
            'number_plate' => 'required|max:255',
            'manufacturing_company' => 'required|max:255',
            'car_name' => 'required|max:255',
             'model_year' => 'required|max:255',
            'branch_id' => 'required',
             'instructor_id' => 'required',
            'image' => 'required',
       ]);

        $vehical = new vehical();
         if($request->hasFile('image')){
            $extension=$request->image->extension();
    	          $filename=time()."_.".$extension;
    	          $request->image->move(public_path('vehicalimage'),$filename);
                $vehical->car_no = $request->car_no;
                $vehical->number_plate = $request->number_plate;
                $vehical->manufacturing_company = $request->manufacturing_company;
                $vehical->car_name = $request->car_name;
                $vehical->model_year = $request->model_year;
                $vehical->branch_id = $request->branch_id;
                $vehical->instructor_id = $request->instructor_id;
                $vehical->status = 'active';
                $vehical->image = $filename;
                $result=$vehical->save();
                if($result){
                    return redirect('/vehical')->with('success','Vehicle Successfully Added.');
                }
                else{
                    return redirect('/vehical')->with('error','Record Not Added.');
                }
            
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

      //  $user=User::where('user_type','user')->get();
      
        //$vehical=vehical::findOrFail($id);
        // $id=5;
           
         $vehical=DB::table('vehicals')
            ->where('vehicals.id',$id)->join('branches','branches.id','vehicals.branch_id')->join('users','users.id','vehicals.instructor_id')
             ->select('vehicals.*','branches.id AS branch_id' ,'branches.name AS branch_name' ,'users.first_name','users.last_name')
             ->first();
   
         
        $userData['data'] = $vehical;
        
           // dd($userData);
         echo json_encode($userData);
         exit;
//return view('vehicals.update_vehical')->with('vehical',$vehical)->with('branch',branch::all())->with('user',$user);
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
        $assignment = vehical::findOrFail($id);
        $validatedData = $request->validate([
                             'car_no' => 'required|max:255',
                             'number_plate' => 'required|max:255',
                             'manufacturing_company' => 'required|max:255',
                             'car_name' => 'required|max:255',
                              'model_year' => 'required|max:255',
                             'branch_id' => 'required',
                              'instructor_id' => 'required',
                            // 'image' => 'required',
                        ]);
        if($request->hasFile('image')){
            $extension=$request->image->extension();
    	          $filename=time()."_.".$extension;
                  $request->image->move(public_path('vehicalimage'),$filename);
                  
                  if (isset($assignment->image) && file_exists(public_path('vehicalimage/'.$assignment->image))) {
            unlink(public_path('vehicalimage/'.$assignment->image));
        }
                  
                  $result=vehical::whereId($id)->update([
                    'car_no'=>$request->car_no,
                    'number_plate'=>$request->number_plate,
                    'manufacturing_company'=>$request->manufacturing_company,
                    'car_name'=>$request->car_name,
                    'model_year'=>$request->model_year,
                    'branch_id'=>$request->branch_id,
                    'instructor_id'=>$request->instructor_id,
                    'image'=>$filename,
                    ]);
                      if($result){
                    return redirect('/vehical')->with('success','Vehicle Successfully Updated.');
                }
                else{
                    return redirect('/vehical')->with('error','Record Not Updated.');
                }
               
         }
          else{
               $result=vehical::whereId($id)->update([
                    'car_no'=>$request->car_no,
                    'number_plate'=>$request->number_plate,
                    'manufacturing_company'=>$request->manufacturing_company,
                    'car_name'=>$request->car_name,
                    'model_year'=>$request->model_year,
                    'branch_id'=>$request->branch_id,
                    'instructor_id'=>$request->instructor_id,
                    ]);
                      if($result){
                    return redirect('/vehical')->with('success','Vehical Successfully Updated.');
                }
                else{
                    return redirect('/vehical')->with('error','Record Not Updated.');
                }
                    
                }

    }
    
     public function vehical_change_status($id)
    {
       $branch=vehical::findOrFail($id);
       
       if($branch->status=="active"){
           vehical::whereId($id)->update([
            'status'=>'inactive',
          
            ]);
            echo json_encode("inactive");
            exit;
       }
       else{
           vehical::whereId($id)->update([
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
            $expense_details = expense_details::where('vehical_id', $id)->get();
                      if(!empty($expense_details)){
                           $expense_details = expense_details::where('vehical_id', $id)->delete();
                      }
                      
                       $road_schedule = road_schedule::where('vehical_id', $id)->get();
                           if( !empty($road_schedule)){
                                road_schedule::where('vehical_id', $id)->delete();
                           }
        $vehical=vehical::findOrFail($id);
              if (isset($vehical->image) && file_exists(public_path('vehicalimage/'.$vehical->image))) {
            unlink(public_path('vehicalimage/'.$vehical->image));
        }
         $result=$vehical->delete();
         if($result){
                    return redirect('/vehical')->with('success','Vehical Successfully Deleted.');
                }
                else{
                    return redirect('/vehical')->with('error','Record Not Delete.');
                }
    }
}
