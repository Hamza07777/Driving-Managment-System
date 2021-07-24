<?php

namespace App\Http\Controllers;

use App\appointment;
use App\branch;
use App\classes;
use App\course;
use App\expense;
use App\invoice;
use App\Models\license;
use App\user_meta;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\note;
use App\package;
use App\phase;
use App\road_schedule;
use App\vehical;
use App\course_student;
use App\expense_details;
use App\package_student;
use App\appointment_student;
use App\Models\Attendence;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function admin_home()
    {
        $user_count=User::count();$vehical_count=vehical::count();$road_schedule=road_schedule::count();$phases=phase::count();$Packages=package::count();$notes=note::count();$invoices=invoice::count();$expenses=expense::count();$course=course::count();$classes=classes::count();$branch=branch::count();$appoinment=appointment::count();$all_notes=note::latest()->limit(2)->get();$user_name=User::latest()->limit(8)->get();$package=Package::latest()->limit(4)->get();

        return view('admin_home')->with('user_count',$user_count)->with('vehical_count',$vehical_count)->with('road_schedule',$road_schedule)->with('phases',$phases)->with('Packages',$Packages)->with('notes',$notes)->with('invoices',$invoices)->with('expenses',$expenses)->with('course',$course)->with('classes',$classes)->with('branch',$branch)->with('appoinment',$appoinment)->with('all_notes',$all_notes)->with('user_name',$user_name)->with('package',$package)
        ->with('schedules',road_schedule::all());
    }

    public function admin_profile()
    {
        $id=Auth::user()->id;
        $user = DB::table('users')->where('id',$id)->first();

        return view('admin.profile')->with('user',$user);

    }
    public function all_users()
    {

        $user = DB::table('users')->paginate(9);

        return view('users.all_user')->with('users',$user );

    }
    public function user_destroy($id)
    {
       // dd($id);
       
       
            $vehical = vehical::where('instructor_id', $id)->get();
         if( !empty($vehical)){
             foreach ($vehical as $vehical) {
                $expense_details = expense_details::where('vehical_id', $vehical->id)->get();
                      if(!empty($expense_details)){
                           $expense_details = expense_details::where('vehical_id', $vehical->id)->delete();
                      }
                      
                       $road_schedule = road_schedule::where('vehical_id', $vehical->id)->get();
                           if( !empty($road_schedule)){
                                road_schedule::where('vehical_id', $vehical->id)->delete();
                           }
                }
            vehical::where('instructor_id', $id)->delete(); 
            
            
            
         }
               $appointment = appointment::where('instructor_id', $id)->get();
                           if( !empty($appointment)){
                               foreach ($appointment as $appointment) {
                                        $appointment_student = appointment_student::where('appointment_id', $appointment->id)->get();
                                       if( !empty($appointment_student)){
                                           appointment_student::where('appointment_id', $appointment->id)->delete();
                                       }
                               }
                               
                                appointment::where('instructor_id', $id)->delete();
                           }
                           
                          
                       
                       
                        $appointment_student = appointment_student::where('student_id', $id)->get();
                                       if( !empty($appointment_student)){
                                           appointment_student::where('student_id', $id)->delete();
                                       }   
                                       
                                       
                          
                         $Attendence = Attendence::where('student_id', $id)->get();
                                       if( !empty($Attendence)){
                                            Attendence::where('student_id', $id)->delete();
                                       } 
                                       
                                       
                         
                         
                    $course = course::where('instructor_id', $id)->get();
                      if(!empty($course)){
                          foreach ($course as $course) {
                              $course_student = course_student::where('course_id', $course->id)->get();
                              if( !empty($course_student)){
                                  $course_student = course_student::where('course_id', $course->id)->delete();
                              }
                              
                              
                               $road_schedule = road_schedule::where('course_id', $course->id)->get();
                           if( !empty($road_schedule)){
                                road_schedule::where('course_id', $course->id)->delete();
                           }
                           
                           
                           
                            $appointment = appointment::where('course_id', $course->id)->get();
                           if( !empty($appointment)){
                               foreach ($appointment as $appointment) {
                                        $appointment_student = appointment_student::where('appointment_id', $appointment->id)->get();
                                       if( !empty($appointment_student)){
                                           appointment_student::where('appointment_id', $appointment->id)->delete();
                                       }
                               }
                               
                                appointment::where('course_id', $course->id)->delete();
                           }
                           
                        } 
      
                            course::where('instructor_id', $id)->delete();
                      }              
                          
                                       
                          $course_student = course_student::where('student_id', $id)->get();
                              if( !empty($course_student)){
                                   course_student::where('student_id', $id)->delete();
                              }              
                          
                          
                             $invoice = invoice::where('student_id', $id)->count();
                                 if( $invoice > 0){
                                    invoice::where('student_id', $id)->delete();
                               } 
                                        
                                                  
                          $note = note::where('admin_id', $id)->count();
                             if( $note > 0){
                               note::where('admin_id', $id)->delete();
                           }
                          
                           $notes = note::where('receptionist_id', $id)->count();
                             if( $notes > 0){
                                 note::where('receptionist_id', $id)->delete();
                            }
       
                     $package_student = package_student::where('student_id', $id)->get();
                                  if(!empty($package_student)){
                                       $package_student = package_student::where('student_id', $id)->delete();
                                  }
                            
                            
                        $road_scheduless = road_schedule::where('student_id', $id)->count();
                       if( $road_scheduless > 0){
                            road_schedule::where('student_id', $id)->delete();
                       }
       
        $road_schedules = road_schedule::where('instructor_id', $id)->count();
                       if( $road_schedules > 0){
                            road_schedule::where('instructor_id', $id)->delete();
                       }
       
       
        $user_meta = user_meta::where('user_id', $id)->count();
                       if( $user_meta > 0){
                            user_meta::where('user_id', $id)->delete();
                       }
       
       
       
        $note=User::findOrFail($id);
         if (isset($note->image) && file_exists(public_path('userImages/'.$note->image))) {
            unlink(public_path('userImages/'.$note->image));
         }
        $result=$note->delete();
         if($result){
                   return redirect('/admin_show_user')->with('success','User Successfully Deleted.');
                }
                else{
                    return redirect('/admin_show_user')->with('error','Record Not Deleted.');
                }
    }
    
    
     public function user_edit($id)
    {
       
       $branch = branch::all();
        $user=User::findOrFail($id);
        return view('admin.user_edit')->with('user',$user )->with('branch',$branch);
      
    }
    
    
      public function user_update(Request $request)
     {
         
         if(!empty($request->password)){
              $validatedData = $request->validate([
                    'firstname' => 'required|string|max:255',
                    'lastname' => 'required|max:255',
                       'email' => 'required|string|email|max:255',
                    'password' => 'string|min:8|confirmed',
                    'phone_number' => 'required',
                    'address' => 'required|string|max:255',
                       'city' => 'required|string|max:255',
                    'province' => 'required|string|max:255',
                    'postal_code' => 'required',

                ]);
             
         }
         else{
              $validatedData = $request->validate([
                    'firstname' => 'required|string|max:255',
                    'lastname' => 'required|max:255',
                       'email' => 'required|string|email|max:255',
                   // 'password' => 'string|min:8|confirmed',
                    'phone_number' => 'required',
                    'address' => 'required|string|max:255',
                       'city' => 'required|string|max:255',
                    'province' => 'required|string|max:255',
                    'postal_code' => 'required',

                ]);
         }
     //   'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        

        $id=$request['id'];
        $userss = DB::table('users')->where('id',$id)->first();
        if($request->hasFile('image')){
            $extension=$request->image->extension();
    	          $filename=time()."_.".$extension;
    	          $request->image->move(public_path('userImages'),$filename);
    	          
    	              if (isset($userss->image) && file_exists(public_path('userImages/'.$userss->image))) {
            unlink(public_path('userImages/'.$userss->image));
    	              }
        }
        elseif(!empty($userss->image)){
            $filename=$userss->image;
        }
        else{
            $filename=null;
        }
        if(!empty($request->password))
        {
            $pasword=Hash::make($request['password']);
        }
        else{
            $pasword=$userss->password;
        }
        $result=User::whereId($id)->update([
            'first_name' => $request['firstname'],
            'last_name' => $request['lastname'],
            'email' => $request['email'],
            'password' => $pasword,
            'phone_number' => $request['phone_number'],
            'image' => $filename,
            'address' => $request['address'],
            'city' => $request['city'],
            'province' => $request['province'],
            'postal_code' => $request['postal_code'],
            'branch_id'=>$request['branch_id'],
            'user_type' => $request['user_type'],
            ]);
            $user = DB::table('users')->where('id',$id)->first();
             if($result){
                    return redirect('/')->with('user',$user )->with('success','User Successfully Updated.');
                }
                else{
                   return redirect('/')->with('user',$user )->with('error','Record Not Updated.');
                }

        
    }
    
    
    
    
     public function user_add(Request $request)
    {
       // dd($request);
       if($request['user_type']=="instructor"){
           
           
             $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'license_pic' => 'required',
            'instructor_card' => 'required',
            'cv_letter' => 'required',
            'piece_of_identity' => 'required',
            'medical_form' => 'required',
            'wage_per_hours' => 'required|numeric',
            'total_hours' => 'required|numeric',
            'total_hours_student' => 'required|numeric',
        ]);
         if($request->hasFile('image')){
            $extension=$request->image->extension();
    	          $filename=time()."_.".$extension;
    	          $request->image->move(public_path('userImages'),$filename);
           
        }
        elseif(!empty($userss->image)){
            $filename=$userss->image;
        }
        else{
            $filename=null;
        }
        
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
        
        
        $result=User::create([
            'first_name' => $request['firstname'],
            'last_name' => $request['lastname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone_number' => $request['phone_number'],
            'address' => $request['address'],
            'city' => $request['city'],
            'province' => $request['province'],
            'postal_code' => $request['postal_code'],
            'gender' => $request['gender'],
            'image' => $filename,
            'branch_id'=>$request['branch_id'],
            'user_type' => $request['user_type'],
            'date_of_birth' => '22/2/19',
            ]);
            
           $result2= DB::table('user_metas')->insert([
            ['user_id'=>$result->id,'user_key' => 'license_pic', 'user_meta' => $filename_license_pic],
            ['user_id'=>$result->id,'user_key' => 'instructor_card', 'user_meta' => $filename_instructor_card],
            ['user_id'=>$result->id,'user_key' => 'cv_letter', 'user_meta' => $filename_cv_letter],
            ['user_id'=>$result->id,'user_key' => 'piece_of_identity', 'user_meta' => $filename_piece_of_identity],
            ['user_id'=>$result->id,'user_key' => 'medical_form', 'user_meta' => $filename_medical_form],
            ['user_id'=>$result->id,'user_key' => 'wage_per_hours', 'user_meta' => $request->wage_per_hours],
            ['user_id'=>$result->id,'user_key' => 'total_hours', 'user_meta' => $request->total_hours],
            ['user_id'=>$result->id,'user_key' => 'total_hours_student', 'user_meta' => $request->total_hours_student],
        ]);
        if($result){
                    return redirect('/admin_show_user')->with('success','User Successfully Added.');
                }
                else{
                   return redirect('/admin_show_user')->with('error','Record Not Added.');
                }
           
           
           
           
           
       }
       else{
           
       
            $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
        ]);
         if($request->hasFile('image')){
            $extension=$request->image->extension();
    	          $filename=time()."_.".$extension;
    	          $request->image->move(public_path('userImages'),$filename);
           
        }
        elseif(!empty($userss->image)){
            $filename=$userss->image;
        }
        else{
            $filename="";
        }
        $result=User::create([
            'first_name' => $request['firstname'],
            'last_name' => $request['lastname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone_number' => $request['phone_number'],
            'address' => $request['address'],
            'city' => $request['city'],
            'province' => $request['province'],
            'postal_code' => $request['postal_code'],
            'gender' => $request['gender'],
            'image' => $filename,
            'branch_id'=>$request['branch_id'],
            'user_type' => $request['user_type'],
            'date_of_birth' => '22/2/19',
            ]);
        if($result){
                    return redirect('/admin_show_user')->with('success','User Successfully Added.');
                }
                else{
                   return redirect('/admin_show_user')->with('error','Record Not Added.');
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
        $note = note::where('receptionist_id',$id)->get();
        // dd($note);
        return view('users.single_user')->with('user', User::findOrFail($id))->with('note',$note)->with('branch',branch::all());
    }

    public function requirments()
    {
        // $value = env("APP_NAME");

        // dd($value);
        return view('install.install');
    }
    public function permission(Request $request)
    {
        
        // include('http://jhamt.com/verification/dms-verification.php');
     //   dd($request->dbname);
   

        $env_update = $this->changeEnv([
            // 'DB_HOST'   => request()->getHost(),
            'DB_DATABASE'   => $request->dbname,
            'DB_USERNAME'   => $request->username,
            'DB_PASSWORD'       => $request->pwd
        ]);
       
        $firstname=$request->firstname;
        $lastname=$request->lastname;
        $email=$request->email;
        $password=$request->password;
        // dd($env_update);
         if($env_update){



            return Redirect::route('database_migrate')->with( [ 'firstname' => $firstname,'lastname' => $lastname, 'email' => $email, 'password' => $password,  ] );
        }


    }



    public function license()
    {
        $string = Str::random(40);
        return view('license.license')->with('string',$string);
    }




    public function license_store(Request $request)
    {
        // dd(request()->getHost());
        //   dd($request);
        $license=new license();
        $license->key=$request->license;
        $license->email=$request->email;
        $license->doamin=request()->getHost();
        $license->save();
        Storage::disk('local')->put('license.txt','LICENSE CERTIFICATE : Envato Market Item
        ==============================================

This document certifies the purchase of:
ONE REGULAR LICENSE
as defined in the standard terms and conditions on Envato Market.

Licensors Author Username:
Softlinkage

Licensee:
TELERECO INC.

Email:
'.$request->email.'

Item Title:
'.config('app.name', 'Laravel').'

Item Purchase Code:
'.$request->license.'

Purchase Date:
'.date('Y-m-d H:i:s').'

For any queries related to this document or license please contact Help Team via https://help.market.envato.com

Envato Pty. Ltd. (ABN 11 119 159 741)
PO Box 16122, Collins Street West, VIC 8007, Australia

==== THIS IS NOT A TAX RECEIPT OR INVOICE ===='
        );
        return Storage::download('license.txt');
        $string = Str::random(50);
        return view('license.license')->with('string',$string);
    }











    public function datbase_form(Request $request){
        return view('update_database.update_db');
    }


    public function database_migrate(){




         //dd(session()->get( 'name' ));
        $status = Artisan::call('migrate:status');
        // dd($status);
        if($status==1){
            Artisan::call('migrate:refresh'); //migrate database

        }
        Artisan::call('optimize:clear');
        $firstname=session()->get( 'firstname' );
        $lastname=session()->get( 'lastname' );
        $email=session()->get( 'email' );
        $password=session()->get( 'password' );
        // dd($email);
        User::create([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'email' => $email,
            'password' => Hash::make($password),
            'user_type' => 'admin',
        ]);

        return Redirect::route('login');
    }

    protected function changeEnv($data = array()){
            if(count($data) > 0){

                // Read .env-file
                $env = file_get_contents(base_path() . '/.env');

                // Split string on every " " and write into array
                $env = preg_split('/\s+/', $env);;

                // Loop through given data
                foreach((array)$data as $key => $value){

                    // Loop through .env-data
                    foreach($env as $env_key => $env_value){

                        // Turn the value into an array and stop after the first split
                        // So it's not possible to split e.g. the App-Key by accident
                        $entry = explode("=", $env_value, 2);

                        // Check, if new key fits the actual .env-key
                        if($entry[0] == $key){
                            // If yes, overwrite it with the new one
                            $env[$env_key] = $key . "=" . $value;
                        } else {
                            // If not, keep the old one
                            $env[$env_key] = $env_value;
                        }
                    }
                }

                // Turn the array back to an String
                $env = implode("\n", $env);

                // And overwrite the .env with the new data
                file_put_contents(base_path() . '/.env', $env);

                return true;
            } else {
                return false;
            }
            if (file_exists(App::getCachedConfigPath())) {
                Artisan::call("config:cache");
            }
        }

}
