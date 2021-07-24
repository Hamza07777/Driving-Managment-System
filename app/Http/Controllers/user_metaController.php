<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class user_metaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('instructor.experience_letter_or_cv');
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
                             'license_pic' => 'required',
                             'instructor_card' => 'required',
                             'cv_letter' => 'required',
                             'piece_of_identity' => 'required',
                              'medical_form' => 'required',
                             'wage_per_hours' => 'required|numeric',
                              'total_hours' => 'required|numeric',
                             'total_hours_student' => 'required|numeric',
                        ]);
        $id=Auth::user()->id;
        if($request->hasFile('license_pic') & $request->hasFile('instructor_card') & $request->hasFile('cv_letter') & $request->hasFile('piece_of_identity') & $request->hasFile('medical_form')){
                  $extension_license_pic=$request->license_pic->extension();
    	          $filename_license_pic=time()."_.".$extension_license_pic;
                  $request->license_pic->move(public_path('license_pic'),$filename_license_pic);

                  $extension_instructor_card=$request->instructor_card->extension();
    	          $filename_instructor_card=time()."_.".$extension_instructor_card;
                  $request->instructor_card->move(public_path('instructor_card'),$filename_instructor_card);

                  $extension_cv_letter=$request->cv_letter->extension();
    	          $filename_cv_letter=time()."_.".$extension_cv_letter;
                  $request->cv_letter->move(public_path('cv_letter'),$filename_cv_letter);

                  $extension_piece_of_identity=$request->piece_of_identity->extension();
    	          $filename_piece_of_identity=time()."_.".$extension_piece_of_identity;
                  $request->piece_of_identity->move(public_path('piece_of_identity'),$filename_piece_of_identity);

                  $extension_medical_form=$request->medical_form->extension();
    	          $filename_medical_form=time()."_.".$extension_medical_form;
                  $request->medical_form->move(public_path('medical_form'),$filename_medical_form);
        }
        $result=DB::table('user_metas')->insert([
            ['user_id'=>$id,'user_key' => 'license_pic', 'user_meta' => $filename_license_pic],
            ['user_id'=>$id,'user_key' => 'instructor_card', 'user_meta' => $filename_instructor_card],
            ['user_id'=>$id,'user_key' => 'cv_letter', 'user_meta' => $filename_cv_letter],
            ['user_id'=>$id,'user_key' => 'piece_of_identity', 'user_meta' => $filename_piece_of_identity],
            ['user_id'=>$id,'user_key' => 'medical_form', 'user_meta' => $filename_medical_form],
            ['user_id'=>$id,'user_key' => 'wage_per_hours', 'user_meta' => $request->wage_per_hours],
            ['user_id'=>$id,'user_key' => 'total_hours', 'user_meta' => $request->total_hours],
            ['user_id'=>$id,'user_key' => 'total_hours_student', 'user_meta' => $request->total_hours_student],
        ]);
         if($result){
                    return redirect('/')->with('success','Instructor Detail Successfully Added.');
                }
                else{
                    return redirect('/')->with('error','Record Not Added.');
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
        //
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

}
