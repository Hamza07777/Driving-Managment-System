<?php

namespace App\Http\Controllers;

use App\branch;
use App\note;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use App\User;

class notesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('notes.all_notes')->with('note',note::all())->with('branch',branch::all());;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
         $id=Auth::user()->id;
$validatedData = $request->validate([
                    'note' => 'required|string|',
                    'receptionist_id' => 'required',
                    'branch_id' => 'required',
                        ]);
        $note = new note();
        $note->note = $request->note;
        $note->admin_id = $id;
        $note->receptionist_id = $request->receptionist_id;
        $note->branch_id =$request->branch_id;
        $note->status = "active";
       $result= $note->save();
          if($result){
                   return redirect()->back()->with('success','Note Successfully Added.');
                }
                else{
                    return redirect()->back()->with('error','Record Not Added.');
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
        $note = note::where('receptionist_id',$id)->get();
        // dd($note);
        return view('users.single_user')->with('user', User::findOrFail($id))->with('note',$note)->with('branch',branch::all());;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note=note::findOrFail($id);
        //$branch=branch::findOrFail($id);
          $userData['data'] = $note;
           // dd($userData);
         echo json_encode($userData);
         exit;
        return view('notes.update_notes')->with('note',$note);
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
                            'note' => 'required',
                        ]);

        $result=note::whereId($id)->update([
            'note'=>$request->note,

            ]);
             if($result){
                   return redirect('/note')->with('success','Note Successfully Updated.');
                }
                else{
                    return redirect('/note')->with('error','Record Not Updated.');
                }
            

    }
    
     public function note_change_status($id)
    {
       $branch=note::findOrFail($id);
        
       if($branch->status=="active"){
           note::whereId($id)->update([
            'status'=>'inactive',
          
            ]);
            echo json_encode("inactive");
            exit;
       }
       else{
           note::whereId($id)->update([
            'status'=>'active',
          
            ]);
             echo json_encode("active");
            exit;
       }
        
            
    }
    
         public function note_change_statuss($id)
    {
       $branch=note::findOrFail($id);
    
       if($branch->status=="active"){
           note::whereId($id)->update([
            'status'=>'inactive',
          
            ]);
            echo json_encode("inactive");
            exit;
       }
       else{
           note::whereId($id)->update([
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
        $note=note::findOrFail($id);
        $result=$note->delete();
         if($result){
                   return redirect('/note')->with('success','Note Successfully Deleted.');
                }
                else{
                    return redirect('/note')->with('error','Record Not Deleted.');
                }
    }
     public function note_destroy($id)
    {
        $note=note::findOrFail($id);
        $result=$note->delete();
         if($result){
                   return redirect('/note')->with('success','Note Successfully Deleted.');
                }
                else{
                    return redirect('/note')->with('error','Record Not Deleted.');
                }
    }
    
     public function multiplenote_quizdelete(Request $request)
	{
		$id = $request->id;
	//	dd($id);
		foreach ($id as $user) 
		{
            $course = note::findOrFail($user);
          
            $course->delete();
		}
		return redirect('/note')->with('success','Note Successfully Deleted.');
    
	}
}
