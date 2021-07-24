<?php

namespace App\Http\Controllers;
use App\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $currency = Currency::all();
    //   //  return '121';
         return view('currency.all_currrency')->with('currency',$currency);
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
        $validatedData = $request->validate([

                    'currency_name' => 'required|max:255',
                    'currency_symbol' => 'required|max:255',

                ]);
        $attendence_status =new Currency();
        $attendence_status->currency_name=$request->currency_name;
         $attendence_status->currency_symbol=$request->currency_symbol;
        $attendence_status->status="active";
        $result=$attendence_status->save();
         if($result){
                    return redirect()->route('currency.index')->with('success','currency Successfully Added.');
                }
                else{
                    return redirect()->route('currency.index')->with('error','Record Not Added.');
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
        $branch=Currency::findOrFail($id);
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
                     'currency_name' => 'required|max:255',
                    'currency_symbol' => 'required|max:255',
                ]);
        $result=Currency::whereId($id)->update([
            'currency_name'=>$request->currency_name,
            'currency_symbol'=>$request->currency_symbol,

            ]);
             if($result){
                    return redirect()->route('currency.index')->with('success','Currency Successfully Updated.');
                }
                else{
                    return redirect()->route('currency.index')->with('error','Record Not Updated.');
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
    
       
      $branch=Currency::findOrFail($id);
        $result=$branch->delete();
            if($result){
                    return redirect()->route('currency.index')->with('success','Currency Successfully Deleted.');
                }
                else{
                    return redirect()->route('currency.index')->with('error','Record Not Deleted.');
                }
    }
    
    public function currency_change_status($id)
    {
       $branch=Currency::findOrFail($id);
       
       if($branch->status=="active"){
           Currency::whereId($id)->update([
            'status'=>'inactive',
          
            ]);
            echo json_encode("inactive");
            exit;
       }
       else{
           Currency::whereId($id)->update([
            'status'=>'active',
          
            ]);
             echo json_encode("active");
            exit;
       }
        
            
    }
}
