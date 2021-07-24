<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\HomeController;
use App\Http\Controllers\appoinmentController;
use App\Http\Controllers\Attendence_statusController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\classesController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\expenses_detailController;
use App\Http\Controllers\expensesController;
use App\Http\Controllers\invoicesController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\notesController;
use App\Http\Controllers\packageController;
use App\Http\Controllers\roadScheduleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\smsController;
use App\Http\Controllers\student_appoinmentController;
use App\Http\Controllers\student_courseController;
use App\Http\Controllers\student_packageController;
use App\Http\Controllers\user_metaController;
use App\Http\Controllers\VehicalController;
use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\setting;
use Illuminate\Support\Facades\Schema;



// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => ['installed']], function() {
Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::resource('branch', BranchController::class);
    Route::resource('note', notesController::class);
    Route::resource('vehical', VehicalController::class);
    Route::resource('classes', classesController::class);
    Route::resource('course', courseController::class);
    Route::resource('roadschedule', roadScheduleController::class);
    Route::resource('appoinment', appoinmentController::class);
    Route::resource('package', packageController::class);
    Route::resource('student_package', student_packageController::class);
    Route::resource('student_course', student_courseController::class);
    Route::resource('invoices', invoicesController::class);
    Route::resource('expenses', expensesController::class);
    Route::resource('expense_detail', expenses_detailController::class);
    Route::resource('user_meta', user_metaController::class);
    Route::resource('student_appoinment', student_appoinmentController::class);
    Route::resource('student_sms', smsController::class);
    Route::resource('mail', MailController::class);
    Route::resource('attendence_status', Attendence_statusController::class);
    Route::resource('attendence', AttendenceController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('currency', CurrencyController::class);
    
    
    if (Schema::hasTable('settings')) {
         $lan= setting::first();
  if(!empty($lan))
       {
            App::setlocale($lan->language);
       }
       else{
           App::setlocale('en');
       }
         
        }
    
           



    // New Routes For Showing the All record From Database 
    
    Route::get('brach_all_data', [BranchController::class, 'brach_all_data'])->name('brach_all_data');
    Route::get('search_brach_all_data', [BranchController::class, 'search_brach_all_data'])->name('search_brach_all_data');
    Route::get('instructor_all_data', [BranchController::class, 'instructor_all_data'])->name('instructor_all_data');
    Route::get('all_class_data', [BranchController::class, 'all_class_data'])->name('all_class_data');
    Route::get('all_course_data', [BranchController::class, 'all_course_data'])->name('all_course_data');
    Route::get('all_package_data', [BranchController::class, 'all_package_data'])->name('all_package_data');
    Route::get('vehical_all_data', [BranchController::class, 'vehical_all_data'])->name('vehical_all_data');
    Route::get('expenses_all_data', [BranchController::class, 'expenses_all_data'])->name('expenses_all_data');
     Route::get('student_all_data', [BranchController::class, 'student_all_data'])->name('student_all_data');
    
    
    
    Route::get('/branch_change_status/{id}',  [BranchController::class, 'change_status'])->name('branch_change_status');
    
    Route::get('/vehical_change_status/{id}',  [VehicalController::class, 'vehical_change_status'])->name('vehical_change_status');
    
    Route::get('/appointment_change_status/{id}',  [appoinmentController::class, 'appointment_change_status'])->name('appointment_change_status');
    
    Route::get('/class_change_status/{id}',  [classesController::class, 'class_change_status'])->name('class_change_status');
    
    Route::get('/course_change_status/{id}',  [courseController::class, 'course_change_status'])->name('course_change_status');
    
    Route::get('/expense_change_status/{id}',  [expensesController::class, 'expense_change_status'])->name('expense_change_status');
    
    Route::get('/expense_Detail_change_status/{id}',  [expenses_detailController::class, 'expense_Detail_change_status'])->name('expense_Detail_change_status');
    
    Route::get('/invoice_change_status/{id}',  [invoicesController::class, 'invoice_change_status'])->name('invoice_change_status');
    
    Route::get('/note_change_status/{id}',  [notesController::class, 'note_change_status'])->name('note_change_status');
    
    Route::get('/package_change_status/{id}',  [packageController::class, 'package_change_status'])->name('package_change_status');
    
    Route::get('/scehdule_change_status/{id}',  [roadScheduleController::class, 'scehdule_change_status'])->name('scehdule_change_status');
    
    Route::get('/student_course_change_status/{id}',  [student_courseController::class, 'student_course_change_status'])->name('student_course_change_status');
    
    Route::get('/student_package_change_status/{id}',  [student_packageController::class, 'student_package_change_status'])->name('student_package_change_status');
    
     Route::get('/attendence_change_status/{id}',  [Attendence_statusController::class, 'attendence_change_status'])->name('attendence_change_status');
     Route::get('/currency_change_status/{id}',  [CurrencyController::class, 'currency_change_status'])->name('currency_change_status');
     
     Route::get('/remove_logo',  [SettingController::class, 'remove_logo'])->name('remove_logo');
     
    Route::get('/remove_favi',  [SettingController::class, 'remove_favi'])->name('remove_favi');
     
    Route::post('/student_filter',  [AttendenceController::class, 'student_filter'])->name('student_filter');
    Route::post('/expense_filter',  [expensesController::class, 'expense_filter'])->name('expense_filter');
    
    
    ///////////////////////////////////////////////////////////////////////////
    
        
    Route::get('/show_calender', [roadScheduleController::class, 'show_calender'])->name('show_calender');


    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/',  [HomeController::class, 'admin_home'])->name('admin');

     Route::get('/appoinment_calender',  [appoinmentController::class, 'show_calender_appoinment'])->name('appoinment_calender');



    Route::get('/admin_profile',  [HomeController::class, 'admin_profile'])->name('admin_profile');
    Route::PUT('/admin_profile_update',  [HomeController::class, 'user_update'])->name('admin_profile.update');
    Route::get('/user_destroy/{id}',  [HomeController::class, 'user_destroy'])->name('user_destroy');
    Route::get('/user_edit/{id}',  [HomeController::class, 'user_edit'])->name('user_edit');

    Route::post('/user_add/',  [HomeController::class, 'user_add'])->name('user_add');

Route::get('/note_destroy/{id}',  [notesController::class, 'note_destroy'])->name('note_destroy');
    Route::post('/multiplenote-destroydelete/',  [notesController::class, 'multiplenote_quizdelete'])->name('multiplenote-destroydelete');




    Route::get('/admin_show_user',  [HomeController::class, 'all_users'])->name('admin_show_user');
    Route::get('/admin_show_single_user/{id}',  [HomeController::class, 'show'])->name('admin_show_single_user');





    Route::get('/license',  [HomeController::class, 'license'])->name('license');
    Route::post('/license_store',  [HomeController::class, 'license_store'])->name('license_store');



    Route::get('/datbase_form',  [HomeController::class, 'datbase_form'])->name('datbase_form');
    Route::post('/something_db',  [HomeController::class, 'something_db'])->name('something_db');
 });
});
 Route::get('/requirments',  [HomeController::class, 'requirments'])->name('requirments');
 Route::post('/permission',  [HomeController::class, 'permission'])->name('permission');
 Route::get('/database_migrate',  [HomeController::class, 'database_migrate'])->name('database_migrate');
 Route::post('/license_verify',  [HomeController::class, 'license_verify'])->name('license_verify');


