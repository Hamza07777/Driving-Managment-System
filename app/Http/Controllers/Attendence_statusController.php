<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Attendence_Status;
use Illuminate\Http\Request;

class Attendence_statusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $branch = Attendence_Status::all();
    //   //  return '121';
         return view('attendence_status.all_attendence_status')->with('branch',$branch);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attendence_status.register_attendence_status');
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

                    'status' => 'required|max:255',

                ]);
        $attendence_status =new Attendence_Status();
        $attendence_status->status=$request->status;
        $attendence_status->att_status="active";
        $result=$attendence_status->save();
         if($result){
                    return redirect()->route('attendence_status.index')->with('success','Attendence Status Successfully Added.');
                }
                else{
                    return redirect()->route('attendence_status.index')->with('error','Record Not Added.');
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
        $branch=Attendence_Status::findOrFail($id);
          $userData['data'] = $branch;
           // dd($userData);
         echo json_encode($userData);
         exit;
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
                    'status' => 'required|max:255',
                ]);
        $result=Attendence_Status::whereId($id)->update([
            'status'=>$request->status,

            ]);
             if($result){
                    return redirect()->route('attendence_status.index')->with('success','Attendence Status Successfully Updated.');
                }
                else{
                    return redirect()->route('attendence_status.index')->with('error','Record Not Updated.');
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
    
         $invoice = Attendence::where('status', $id)->count();
         if( $invoice > 0){
            Attendence::where('status', $id)->delete();
       } 
      $branch=Attendence_Status::findOrFail($id);
        $result=$branch->delete();
            if($result){
                    return redirect()->route('attendence_status.index')->with('success','Attendence Status Successfully Deleted.');
                }
                else{
                    return redirect()->route('attendence_status.index')->with('error','Record Not Deleted.');
                }
    }
    
      public function attendence_change_status($id)
    {
       $branch=Attendence_Status::findOrFail($id);
       
       if($branch->att_status=="active"){
           Attendence_Status::whereId($id)->update([
            'att_status'=>'inactive',
          
            ]);
            echo json_encode("inactive");
            exit;
       }
       else{
           Attendence_Status::whereId($id)->update([
            'att_status'=>'active',
          
            ]);
             echo json_encode("active");
            exit;
       }
        
            
    }
    
    
}
