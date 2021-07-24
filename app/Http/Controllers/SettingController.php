<?php

namespace App\Http\Controllers;

use App\Models\setting;
use App\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $setting=setting::first();
          $currency = Currency::all();
        if(!empty($setting)){
            return view('settings.update_company_setting')->with('setting',$setting)->with('currency',$currency);
        }
        else{
            return view('settings.add_company_setting')->with('currency',$currency);
        }

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
        $setting=new setting();

        if($request->hasFile('logo')){
            $extension=$request->logo->extension();
    	          $logo=time()."_.".$extension;
    	          $request->logo->move(public_path('CompanyLogo'),$logo);
                 
        }
         else{
                    $logo=null;
                }
                
        if($request->hasFile('favi_icon')){
            $extension=$request->favi_icon->extension();
    	          $favi_icon=time()."_.".$extension;
    	          $request->logo->move(public_path('Companyfavi_icon'),$favi_icon);
                 
        }
         else{
                    $favi_icon=null;
                }        
            
                App::setlocale($request->language);
        $setting->Company_Name=$request->Company_Name;
        $setting->Company_Email=$request->Company_Email;
        $setting->Company_Phone=$request->Company_Phone;
        $setting->language=$request->language;
        $setting->date_formate=$request->date_formate;
        $setting->currency=$request->currency;
        $setting->logo=$logo;
        $setting->favi_icon=$favi_icon;
        $setting->tax_ratio=$request->tax_ratio;
        $setting->Company_Website=$request->Company_Website;
        $setting->Company_Address=$request->Company_Address;
        $result=$setting->save();
        if($result){
                    return redirect()->back()->with('success','Setting Successfully Added.');
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
        //
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
         $setting=setting::where('id',$id)->first();
        if($request->hasFile('logo')){
            $extension=$request->logo->extension();
    	          $logo=time()."_.".$extension;
    	          $request->logo->move(public_path('CompanyLogo'),$logo);
    	             if (isset($setting->logo) && file_exists(public_path('CompanyLogo/'.$setting->logo))) {
            unlink(public_path('CompanyLogo/'.$setting->logo));
        }
                 
        }
        elseif(!empty($setting->logo)){
            $logo=$setting->logo;

        }
        else{
            $logo=null;
        }
        
        
            if($request->hasFile('favi_icon')){
            $extension=$request->favi_icon->extension();
    	          $favi_icon=time()."_.".$extension;
    	          $request->favi_icon->move(public_path('Companyfavi_icon'),$favi_icon);
    	             if (isset($setting->favi_icon) && file_exists(public_path('Companyfavi_icon/'.$setting->favi_icon))) {
            unlink(public_path('Companyfavi_icon/'.$setting->favi_icon));
        }
                 
        }
        elseif(!empty($setting->favi_icon)){
            $favi_icon=$setting->favi_icon;

        }
        else{
            $favi_icon=null;
        }
     
    //   $result= App::setlocale($request['language']);
         // dd(App::setlocale(fr));
        $result=setting::whereId($id)->update([
            'Company_Name' => $request['Company_Name'],
            'Company_Email' => $request['Company_Email'],
            'Company_Phone' => $request['Company_Phone'],
            'Company_Website' => $request['Company_Website'],
            'date_formate'=>$request['date_formate'],
            'language' => $request['language'],
            'tax_ratio' => $request['tax_ratio'],
            'Company_Address' => $request['Company_Address'],
            'currency' => $request['currency'],
            'logo' => $logo,
            'favi_icon' => $favi_icon,
            ]);
 if($result){
                    return redirect()->back()->with('success','Setting Successfully Update.');
                }
                else{
                    return redirect()->back()->with('error','Record Not Added.');
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
        //
    }
    
     public function remove_logo()
    {
        $setting=setting::first();
               if (isset($setting->logo) && file_exists(public_path('CompanyLogo/'.$setting->logo))) {
            unlink(public_path('CompanyLogo/'.$setting->logo));
        }
        setting::whereId($setting->id)->update([
            'logo' => null,
            ]);
            return "Success";
            exit;
    }
    
     public function remove_favi()
    {
        $setting=setting::first();
        if (isset($setting->favi_icon) && file_exists(public_path('Companyfavi_icon/'.$setting->favi_icon))) {
            unlink(public_path('Companyfavi_icon/'.$setting->favi_icon));
        }
        setting::whereId($setting->id)->update([
            'favi_icon' => null,
            ]);
            return "Success";
            exit;
    }
    
    
    
}
