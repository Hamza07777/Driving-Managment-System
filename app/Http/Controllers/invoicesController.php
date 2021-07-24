<?php

namespace App\Http\Controllers;

use App\branch;
use App\invoice;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Emailclient;
use App\Models\setting;

class invoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoices.all_invoices')->with('invoice',invoice::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.register_invoices')->with('branch',branch::all())->with('student',User::all());
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
            'amount_paid' => 'required|numeric',
            'invoice_status' => 'required',
            'student_id' => 'required',
            'branch_id' => 'required',
            'due_date' => 'required',

        ]);

        $invoice = new invoice();
        $invoice->detail = $request->detail;
        $invoice->amount_paid = $request->amount_paid;
        $invoice->invoice_status = $request->invoice_status;
        $invoice->student_id = $request->student_id;
        $invoice->branch_id  = $request->branch_id ;
        $invoice->due_date  = $request->due_date ;
        $invoice->status = "active";
        $result=$invoice->save();
        
        $tax_amount=setting::tax_amount($request->amount_paid);
        $total_amount=$request->amount_paid+$tax_amount;
        $branch=branch::findOrFail($request->branch_id);
         $user=User::findOrFail($request->student_id);
         if($result){
        $email = 'dev@softlinkage.net';
        // $email =$user->email;
        $mailData = [
            'title' => 'Invoice Detail',
            'Description' => 'Dear '.$user->first_name .' '.$user->last_name .' '.$request->detail.' Amount Paid '.$request->amount_paid .' Tax Amount is '.$tax_amount.' Total Amount After Tax include is  '. $total_amount.' due date is '.$request->due_date.'Branch Name '.$branch->name,

            'url' => 'https://dsms.jhamt.com'
        ];

       Mail::to($email)->send(new Emailclient($mailData));
                    return redirect('/invoices')->with('success','Invoices Successfully Added.');
                }
                else{
                    return redirect('/invoices')->with('error','Record Not Added.');
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

       // $invoice=invoice::findOrFail($id);
         $invoice=DB::table('invoices')
            ->where('invoices.id',$id)->join('branches','branches.id','invoices.branch_id')->join('users','users.id','invoices.student_id')
            ->select('invoices.*','branches.name','users.first_name','users.last_name')
            ->first();
                    $userData['data'] = $invoice;
           // dd($userData);
         echo json_encode($userData);
        exit;

      //  return view('invoices.update_invoices')->with('invoice',$invoice)->with('branch',branch::all())->with('student',User::all());
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
                    'amount_paid' => 'required|numeric',
                    'invoice_status' => 'required',
                    'student_id' => 'required',
                    'branch_id' => 'required',
                    'due_date' => 'required',
                    

                ]);
        $tax_amount=setting::tax_amount($request->amount_paid);
        $total_amount=$request->amount_paid+$tax_amount;
        $branch=branch::findOrFail($request->branch_id);
         $user=User::findOrFail($request->student_id);
         $result=invoice::whereId($id)->update([
            'detail'=>$request->detail,
            'amount_paid'=>$request->amount_paid,
            'invoice_status'=>$request->invoice_status,
            'student_id'=>$request->student_id,
            'branch_id'=>$request->branch_id,
            'due_date'=>$request->due_date
            ]);
 
          if($result){
              
               $email = 'dev@softlinkage.net';
             // $email =$user->email;
        $mailData = [
            'title' => 'Invoice Update',
         'title' => 'Invoice Detail',
            'Description' => 'Dear '.$user->first_name .' '.$user->last_name .' '.$request->detail.' Amount Paid '.$request->amount_paid .' Tax Amount is '.$tax_amount.' Total Amount After Tax include is  '. $total_amount.' due date is '.$request->due_date.' Branch Name '.$branch->name,

            'url' => 'https://dsms.jhamt.com'
        ];

       Mail::to($email)->send(new Emailclient($mailData));
                    return redirect('/invoices')->with('success','Invoices Successfully Updated.');
                }
                else{
                    return redirect('/invoices')->with('error','Record Not Updated.');
                }

    }
    
     public function invoice_change_status($id)
    {
       $branch=invoice::findOrFail($id);
       
       if($branch->status=="active"){
           invoice::whereId($id)->update([
            'status'=>'inactive',
          
            ]);
            echo json_encode("inactive");
            exit;
       }
       else{
           invoice::whereId($id)->update([
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
        $invoice=invoice::findOrFail($id);
         $result=$invoice->delete();
         
            if($result){
                    return redirect('/invoices')->with('success','Invoices Successfully Deleted.');
                }
                else{
                    return redirect('/invoices')->with('error','Record Not Deleted.');
                }    
        
    }
}
