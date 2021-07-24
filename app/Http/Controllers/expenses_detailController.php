<?php

namespace App\Http\Controllers;

use App\expense;
use App\expense_details;
use App\vehical;
use Illuminate\Http\Request;
use DB;

class expenses_detailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expenses_detail.all_expenses_detail')->with('expense_details',expense_details::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses_detail.register_expenses_detail')->with('vehical',vehical::all())->with('expense',expense::all());
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
                    'expense_id' => 'required',
                    'vehical_id' => 'required',

                ]);
        $expense_details = new expense_details();
        $expense_details->expense_id  = $request->expense_id;
        $expense_details->vehical_id = $request->vehical_id;
        $result=$expense_details->save();
         if($result){
                    return redirect('/expense_detail')->with('success','Expense Detail Successfully Added.');
                }
                else{
                    return redirect('/expense_detail')->with('error','Record Not Added.');
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
       // $expense_details=expense_details::findOrFail($id);
         $expense_details=DB::table('expense_details')
            ->where('expense_details.id',$id)->join('expenses','expenses.id','expense_details.expense_id')->join('vehicals','vehicals.id','expense_details.vehical_id')
            ->select('expense_details.*','expenses.detail','vehicals.car_name','vehicals.number_plate')
            ->first();
                    $userData['data'] = $expense_details;
           // dd($userData);
         echo json_encode($userData);
        exit;

       // return view('expenses_detail.update_expenses_detail')->with('expense_details',$expense_details)->with('vehical',vehical::all())->with('expense',expense::all());
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
            'expense_id' => 'required',
            'vehical_id' => 'required',

        ]);
        $result=expense_details::whereId($id)->update([
            'expense_id'=>$request->expense_id,
            'vehical_id'=>$request->vehical_id,
            ]);
            if($result){
                    return redirect('/expense_detail')->with('success','Expense Detail Successfully Updated.');
                }
                else{
                    return redirect('/expense_detail')->with('error','Record Not Updated.');
                }
    }
    
     public function expense_Detail_change_status($id)
    {
       $branch=expense_details::findOrFail($id);
       
       if($branch->status=="active"){
           expense_details::whereId($id)->update([
            'status'=>'inactive',
          
            ]);
            echo json_encode("inactive");
            exit;
       }
       else{
           expense_details::whereId($id)->update([
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
        $expense_details=expense_details::findOrFail($id);
        $result=$expense_details->delete();
       if($result){
                    return redirect('/expense_detail')->with('success','Expense Detail Successfully Deleted.');
                }
                else{
                    return redirect('/expense_detail')->with('error','Record Not Deleted.');
                }
    }
}
