<?php

namespace App\Http\Controllers;
use App\branch;
use App\classes;
use App\expense;
use App\invoice;
use App\note;
use App\package;
use App\vehical;
use App\course;
use App\User;
use App\Models\Attendence;
use App\user_meta;
use App\course_student;
use App\road_schedule;
use App\expense_details;
use App\package_student;
use App\appointment_student;
use App\appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $branch = branch::all();
    //   //  return '121';
         return view('branches.all_branches')->with('branch',$branch);
      
       // return View::make('branches.all_branches');
    }
   public function brach_all_data()
    {
         $branch = DB::table('branches')->get();
        // dd($branch);
        //   return view('branches.branches_table', compact('branch'))->render();
         //dd(json_encode($branch));
            $userData['data'] = $branch;
           // dd($userData);
         echo json_encode($userData);
        exit;
        //return '121';
        // return view('branches.all_branches')->with('branch',$branch);
      
    }
       public function instructor_all_data(Request $request)
    {
        //return $request->id;
         $branch = DB::table('users')->where('user_type','instructor')->where('branch_id',$request->id)->get();
        // dd($branch);
        //   return view('branches.branches_table', compact('branch'))->render();
         //dd(json_encode($branch));
            $userData['data'] = $branch;
           // dd($userData);
         echo json_encode($userData);
        exit;
        //return '121';
        // return view('branches.all_branches')->with('branch',$branch);
      
    }
    
        public function student_all_data(Request $request)
    {
        //return $request->id;
         $branch = DB::table('users')->where('user_type','user')->where('branch_id',$request->id)->get();
        // dd($branch);
        //   return view('branches.branches_table', compact('branch'))->render();
         //dd(json_encode($branch));
            $userData['data'] = $branch;
           // dd($userData);
         echo json_encode($userData);
        exit;
        //return '121';
        // return view('branches.all_branches')->with('branch',$branch);
      
    }
    
    
    
    public function all_class_data(Request $request)
    {
         $branch = DB::table('classes')->where('branch_id',$request->id)->get();
        // dd($branch);
        //   return view('branches.branches_table', compact('branch'))->render();
         //dd(json_encode($branch));
            $userData['data'] = $branch;
           // dd($userData);
         echo json_encode($userData);
        exit;
        //return '121';
        // return view('branches.all_branches')->with('branch',$branch);
      
    }
    
       public function all_course_data(Request $request)
    {
        $branch = DB::table('classes')
            ->where('classes.branch_id',$request->id)
            ->join('courses','courses.class_id','classes.id')
            ->select('courses.*')
            ->get();
        //  DB::table('courses')->get();
        // dd($branch);
        //   return view('branches.branches_table', compact('branch'))->render();
         //dd(json_encode($branch));
            $userData['data'] = $branch;
           // dd($userData);
         echo json_encode($userData);
        exit;
        //return '121';
        // return view('branches.all_branches')->with('branch',$branch);
      
    }
    
    
        public function all_package_data()
    {
         $branch = DB::table('packages')->get();
        // dd($branch);
        //   return view('branches.branches_table', compact('branch'))->render();
         //dd(json_encode($branch));
            $userData['data'] = $branch;
           // dd($userData);
         echo json_encode($userData);
        exit;
        //return '121';
        // return view('branches.all_branches')->with('branch',$branch);
      
    }
    
    
         public function vehical_all_data(Request $request)
    {
         $branch = DB::table('vehicals')->where('branch_id',$request->id)->get();
        // dd($branch);
        //   return view('branches.branches_table', compact('branch'))->render();
         //dd(json_encode($branch));
            $userData['data'] = $branch;
           // dd($userData);
         echo json_encode($userData);
        exit;
        //return '121';
        // return view('branches.all_branches')->with('branch',$branch);
      
    }
    
    
         public function expenses_all_data(Request $request)
    {
         $branch = DB::table('expenses')->where('branch_id',$request->id)->where('expense_category','vehical')->get();
        // dd($branch);
        //   return view('branches.branches_table', compact('branch'))->render();
         //dd(json_encode($branch));
            $userData['data'] = $branch;
           // dd($userData);
         echo json_encode($userData);
        exit;
        //return '121';
        // return view('branches.all_branches')->with('branch',$branch);
      
    }
    
     public function search_brach_all_data(Request $request)
    {
        $query = $request->get('query');
         $branch = DB::table('branches')
         ->where('name', 'like', '%'.$query.'%')
         ->orWhere('location', 'like', '%'.$query.'%')
         ->orderBy('id', 'desc')
         ->get();
         //dd(json_encode($branch));
            $userData['data'] = $branch;
           // dd($userData);
         echo json_encode($userData);
         exit;
        //return '121';
        // return view('branches.all_branches')->with('branch',$branch);
      
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branches.register_branch');
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
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:branches',
            'location' => 'required|max:255',
            'phone_number' => 'required',

        ]);
// store in the database
            $branch = new branch;
            $branch->name = $request->name;
            $branch->email = $request->email;
            $branch->location = $request->location;
            $branch->phone_number = $request->phone_number;
            $branch->status = "active";
            $result=$branch->save();
              if($result){
                    return redirect('/branch')->with('success','Branch Successfully Added.');
                }
                else{
                    return redirect('/branch')->with('error','Record Not Added.');
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
        return view('')->with('branch', branch::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch=branch::findOrFail($id);
          $userData['data'] = $branch;
           // dd($userData);
         echo json_encode($userData);
         exit;
        //return view('branches.update_branch')->with('branch',$branch);
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
                    'name' => 'required|max:255',
                    'email' => 'required|max:255',
                    'location' => 'required|max:255',
                    'phone_number' => 'required',

                ]);
        $result=branch::whereId($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'location'=>$request->location,
            'phone_number'=>$request->phone_number,
            ]);
             if($result){
                    return redirect('/branch')->with('success','Branch Successfully Updated.');
                }
                else{
                    return redirect('/branch')->with('error','Record Not Updated.');
                }
    }

   public function change_status($id)
    {
       $branch=branch::findOrFail($id);
       
       if($branch->status=="active"){
           branch::whereId($id)->update([
            'status'=>'inactive',
          
            ]);
            echo json_encode("inactive");
            exit;
       }
       else{
           branch::whereId($id)->update([
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
        
      $road_schedule = road_schedule::where('branch_id', $id)->count();
       if( $road_schedule > 0){
            road_schedule::where('branch_id', $id)->delete();
       }
       
       
        $classes = classes::where('branch_id', $id)->get();
         if( !empty($classes)){
             
             foreach ($classes as $classes) {
                $course = course::where('class_id', $classes->id)->get();
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
                          
                          
                           
                           
                           
                           
                           
                              
                            course::where('class_id', $classes->id)->delete();
                      }
                }
            classes::where('branch_id', $id)->delete();
       }
       
       
        $expense = expense::where('branch_id', $id)->get();
         if( !empty($expense)){
             
              foreach ($expense as $expense) {
                $expense_details = expense_details::where('expense_id', $expense->id)->get();
                      if(!empty($expense_details)){
                           $expense_details = expense_details::where('expense_id', $expense->id)->delete();
                      }
                }
             expense::where('branch_id', $id)->delete();
           
       }
       
          $invoice = invoice::where('branch_id', $id)->count();
         if( $invoice > 0){
            invoice::where('branch_id', $id)->delete();
       }
       
       
       $note = note::where('branch_id', $id)->count();
         if( $note > 0){
           note::where('branch_id', $id)->delete();
       }
       
       $package = package::where('branch_id', $id)->get();
         if(!empty($package)){
           foreach ($package as $package) {
                $package_student = package_student::where('package_id', $package->id)->get();
                      if(!empty($package_student)){
                           $package_student = package_student::where('package_id', $package->id)->delete();
                      }
                }
  
            package::where('branch_id', $id)->delete();
       }

        $vehical = vehical::where('branch_id', $id)->get();
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
               
              if (isset($vehical->image) && file_exists(public_path('vehicalimage/'.$vehical->image))) {
            unlink(public_path('vehicalimage/'.$vehical->image));
        }
            vehical::where('branch_id', $id)->delete(); 
       }
        
    
    
    
    
    
     $User = User::where('branch_id', $id)->get();
     if( !empty($User)){
         foreach ($User as $User) {
             
               $vehical = vehical::where('instructor_id', $User->id)->get();
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

              if (isset($vehical->image) && file_exists(public_path('vehicalimage/'.$vehical->image))) {
            unlink(public_path('vehicalimage/'.$vehical->image));
        }
            vehical::where('instructor_id', $User->id)->delete(); 
            
            
            
         }
               $appointment = appointment::where('instructor_id', $User->id)->get();
                           if( !empty($appointment)){
                               foreach ($appointment as $appointment) {
                                        $appointment_student = appointment_student::where('appointment_id', $appointment->id)->get();
                                       if( !empty($appointment_student)){
                                           appointment_student::where('appointment_id', $appointment->id)->delete();
                                       }
                               }
                               
                                appointment::where('instructor_id', $User->id)->delete();
                           }
                           
                          
                       
                       
                        $appointment_student = appointment_student::where('student_id', $User->id)->get();
                                       if( !empty($appointment_student)){
                                           appointment_student::where('student_id', $User->id)->delete();
                                       }   
                                       
                                       
                          
                         $Attendence = Attendence::where('student_id', $User->id)->get();
                                       if( !empty($Attendence)){
                                            Attendence::where('student_id', $User->id)->delete();
                                       } 
                                       
                                       
                         
                         
                    $course = course::where('instructor_id', $User->id)->get();
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
      
                            course::where('instructor_id', $User->id)->delete();
                      }              
                          
                                       
                          $course_student = course_student::where('student_id', $User->id)->get();
                              if( !empty($course_student)){
                                   course_student::where('student_id', $User->id)->delete();
                              }              
                          
                          
                             $invoice = invoice::where('student_id', $User->id)->count();
                                 if( $invoice > 0){
                                    invoice::where('student_id', $User->id)->delete();
                               } 
                                        
                                                  
                          $note = note::where('admin_id', $User->id)->count();
                             if( $note > 0){
                               note::where('admin_id', $User->id)->delete();
                           }
                          
                           $notes = note::where('receptionist_id', $User->id)->count();
                             if( $notes > 0){
                                 note::where('receptionist_id', $User->id)->delete();
                            }
       
                     $package_student = package_student::where('student_id', $User->id)->get();
                                  if(!empty($package_student)){
                                       $package_student = package_student::where('student_id', $User->id)->delete();
                                  }
                            
                            
                        $road_scheduless = road_schedule::where('student_id', $User->id)->count();
                       if( $road_scheduless > 0){
                            road_schedule::where('student_id', $User->id)->delete();
                       }
       
        $road_schedules = road_schedule::where('instructor_id', $User->id)->count();
                       if( $road_schedules > 0){
                            road_schedule::where('instructor_id', $User->id)->delete();
                       }
       
       
        $user_meta = user_meta::where('user_id', $User->id)->count();
                       if( $user_meta > 0){
                            user_meta::where('user_id', $User->id)->delete();
                       }
         }
         
         
        $note=User::findOrFail($User->id);
        
               if (isset($note->image) && file_exists(public_path('userImages/'.$note->image))) {
            unlink(public_path('userImages/'.$note->image));
        }
        $result=$note->delete();
         
     }

     
        
        
       

        $branch=branch::findOrFail($id);
        $result=$branch->delete();
            if($result){
                    return redirect('/branch')->with('success','Branch Successfully Deleted.');
                }
                else{
                    return redirect('/branch')->with('error','Record Not Deleted.');
                }
    }
    
    
    
}
