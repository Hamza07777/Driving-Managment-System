<?php

namespace App\Http\Controllers;

use App\branch;
use App\expense;
use App\expense_details;
use Illuminate\Http\Request;
use DB;

class expensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sum = expense::sum('amount');
        return view('expenses.all_expenses')->with('expense',expense::all())->with('sum',$sum);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.register_expenses')->with('branch',branch::all());
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
            'amount' => 'required|numeric',
            'expense_category' => 'required',
               'branch_id' => 'required',
        ]);
        $expense = new expense();
        $expense->detail = $request->detail;
        $expense->amount = $request->amount;
        $expense->expense_category = $request->expense_category;
        $expense->branch_id = $request->branch_id;
        $expense->status = "active";
        $result=$expense->save();
        if($result){
                    return redirect('/expenses')->with('success','Expenses Successfully Added.');
                }
                else{
                    return redirect('/expenses')->with('error','Record Not Added.');
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

       // $expense=expense::findOrFail($id);
         $expense=DB::table('expenses')
            ->where('expenses.id',$id)->join('branches','branches.id','expenses.branch_id')
            ->select('expenses.*','branches.name')
            ->first();
                    $userData['data'] = $expense;
           // dd($userData);
         echo json_encode($userData);
        exit;

       // return view('expenses.update_expenses')->with('expense',$expense)->with('branch',branch::all());
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
                    'detail' => 'required',
                    'amount' => 'required',
                    'expense_category' => 'required',
                       'branch_id' => 'required',
                ]);
        $result=expense::whereId($id)->update([
            'detail'=>$request->detail,
            'amount'=>$request->amount,
            'expense_category'=>$request->expense_category,
            'branch_id'=>$request->branch_id,
            ]);
            if($result){
                    return redirect('/expenses')->with('success','Expenses Successfully Updated.');
                }
                else{
                    return redirect('/expenses')->with('error','Record Not Updated.');
                }
    }
    
     public function expense_change_status($id)
    {
       $branch=expense::findOrFail($id);
       
       if($branch->status=="active"){
           expense::whereId($id)->update([
            'status'=>'inactive',
          
            ]);
            echo json_encode("inactive");
            exit;
       }
       else{
           expense::whereId($id)->update([
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
         $expense_details = expense_details::where('expense_id', $id)->get();
                      if(!empty($expense_details)){
                           $expense_details = expense_details::where('expense_id', $id)->delete();
                      }
        $expense=expense::findOrFail($id);
        $result=$expense->delete();
          if($result){
                    return redirect('/expenses')->with('success','Expenses Successfully Deleted.');
                }
                else{
                    return redirect('/expenses')->with('error','Record Not Deleted.');
                }
       
    }
    
     public function expense_filter(Request $request)
    {
       // dd($request);
        $validatedData = $request->validate([
                    'expense_day' => 'required|before_or_equal:end_day',
                    'branch_id' => 'required',
                    'end_day' => 'required|after_or_equal:expense_day',
                    
                    
                ]);
        $branch_id=$request->branch_id;
        $start_date = date("Y-m-d", strtotime($request->expense_day));
         $end_day = date("Y-m-d", strtotime($request->end_day));
        // dd($end_day);
        // $expense_day=->format('Y-m-d');
         $sum = expense::where('branch_id',$branch_id)->whereBetween('created_at',[$start_date, $end_day])->sum('amount');
        return view('expenses.all_expenses')->with('expense',expense::where('branch_id',$branch_id)->whereBetween('created_at',[$start_date, $end_day])->get())->with('sum',$sum);
    }
    
}
