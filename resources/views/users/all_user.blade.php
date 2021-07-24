@extends('../layouts.admin_app')
@section('content')
<style>
   .justify-between > span{
   font-size: 19px;
   margin-right: 5%;
   }
   .justify-between > a{
   font-size: 19px;
   margin-right: 5%;
   }
   #review_form{
   display:none;
   }
</style>
<div class="box-header">
   <div class="col-md-12" style="margin-bottom: 1%;">
      <button type="button" class="btn btn-primary btn-demo pull-right" data-toggle="modal" data-target="#myModal2">
      <i class="fa fa-plus-circle" style="margin-right: 8%;"></i>Add User
      </button>
   </div>
</div>
<div class="row">
@foreach ($users as $user)
<a href="/admin_show_single_user/{{ $user->id  }}">
   <div class="col-md-4">
      <div class="box box-widget widget-user-2">
         <div class="widget-user-header bg-blue">
            <div class="widget-user-image">
               <?php $image= $user->image;?>
               @if ($image ==Null)
               <img src="{{ asset('/public/userImages/avatar-5.jpg')}}" class="img-circle" alt="User Image">
               @else
               <img class="img-circle" src="{{ asset('/public/userImages/'.$user->image )}}" alt="User Avatar">
               @endif
            </div>
            <h3 class="widget-user-username">{{ $user->first_name }} {{ $user->last_name }}</h3>
            <h5 class="widget-user-desc">{{ $user->user_type }}</h5>
         </div>
         <div class="box-footer ">
            <ul class="nav nav-stacked">
               <li>
                  <a href="#">{{ __('trans.Email')}} <span class="pull-right ">{{ $user->email }}</span></a>
               </li>
               {{--
               <li><a href="#">{{ __('trans.Date_of_Birth')}} <span class="pull-right ">{{ $user->date_of_birth }}</span></a></li>
               <li><a href="#">Phone Number <span class="pull-right ">{{ $user->phone_number }}</span></a></li>
               <li><a href="#">Address <span class="pull-right ">{{ $user->address }}</span></a></li>
               <li><a href="#">City <span class="pull-right ">{{ $user->city }}</span></a></li>
               <li><a href="#">province <span class="pull-right ">{{ $user->province }}</span></a></li>
               <li><a href="#">Postal code <span class="pull-right ">{{ $user->postal_code }}</span></a></li>
               <li><a href="#">Gender <span class="pull-right ">{{ $user->gender }}</span></a></li>
               <li><a href="#">Status <span class="pull-right ">{{ $user->status }}</span></a></li>
               --}}
            </ul>
            @if($user->user_type=="user")
            <a href="{{ url('attendence/'.$user->id) }}" class="pl-5" style="padding: 17px;">Show Attendance</a>
            @endif
            <form action="{{ url('user_destroy/'.$user->id) }}" method="GET" style="float: right ;margin-right: 3%;">
               @csrf
               <button type="button" class="formId"  style="border: none;color: red; background-color: transparent;"><i class="fa fa-trash " style="font-size: 16px;"></i> Delete</button>
            </form>
            <a href="{{url('user_edit/'.$user->id)}}" ><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i>Edit</a>
         </div>         
       </div>
    </div>
</a>
@endforeach
<div class="d-flex justify-content-center" style="float: right;margin-right: 7%;width: 14%;">
   {{ $users->links() }}
   <!-- <span>-->
   <!--    Displaying {{$users->count()}} of {{ $users->total() }} user(s).-->
   <!--</span>-->
</div>
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('Add User')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            @if ($errors->any())
            <div class="alert alert-danger">
               <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('user_add') }}" enctype="multipart/form-data">
               @csrf
               <div class="form-group ">
                  <label for="firstname" class="col-form-label text-md-right">{{ __('trans.First_Name')}}</label>
                  <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                  @error('firstname')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="lastname" class="col-form-label text-md-right">{{ __('trans.Last_Name')}}</label>
                  <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" >
                  @error('lastname')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="email" class="col-form-label text-md-right">{{ __('trans.Email')}}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group ">
                  <label for="password" class="col-form-label text-md-right">{{ __('trans.Password')}}</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group ">
                  <label for="password-confirm" class="col-form-label text-md-right">{{ __('trans.Confirm_Password')}}</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
               </div>
               <div class="form-group ">
                  <label for="phone_number" class="col-form-label text-md-right">{{ __('trans.Phone_Number')}}</label>
                  <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">
                  @error('phone_number')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="address" class="col-form-label text-md-right">{{ __('trans.Address')}}</label>
                  <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autocomplete="address">
                  @error('address')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="city" class="col-form-label text-md-right">{{ __('trans.City')}}</label>
                  <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required autocomplete="city">
                  @error('city')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="province" class="col-form-label text-md-right">{{ __('trans.Province')}}</label>
                  <input id="province" type="text" class="form-control" name="province" value="{{ old('province') }}" required autocomplete="province">
                  @error('province')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group ">
                  <label for="postal_code" class="col-form-label text-md-right">{{ __('trans.Postal_Code')}}</label>
                  <input id="postal_code" type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal_code">
                  @error('postal_code')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group ">
                  <label for="gender" class=" col-form-label text-md-right">{{ __('trans.Gender')}}</label>
                  <select class="form-control" id="gender" name="gender" required autocomplete="gender">
                     <option value="male">{{ __('trans.Male')}}</option>
                     <option value="female">{{ __('trans.Female')}}</option>
                  </select>
                  @error('gender')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group ">
                  <label for="user_type" class=" col-form-label text-md-right">{{ __('trans.user_role')}}</label>
                  <select class="form-control" id="user_type" name="user_type" required autocomplete="user_type" onchange="showData()">
                     <option value="admin">{{ __('trans.admin')}}</option>
                     <option value="user">{{ __('trans.user')}}</option>
                     <option value="instructor">{{ __('trans.instructor')}}</option>
                     <option value="receptionist">{{ __('trans.receptionist')}}</option>
                  </select>
                  @error('gender')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Brach_Name') }}</label>
                  <select class="form-control" id="branch_id" name="branch_id">
                  </select>
               </div>
               <div class="form-group">
                  <label for="inputSkills" class="control-label">{{ __('trans.Image')}}</label>
                  <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" style="height: 48px;background: transparent;border: none;" name="image"  accept="image/jpeg, image/png, application/pdf">
                  @error('image')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div id="review_form">
                  <div class="form-group ">
                     <label for="wage_per_hours" class="col-form-label text-md-right">{{ __('trans.There_wage_per_hour') }}</label>
                     <input id="wage_per_hours" type="text" class="form-control @error('time_period') is-invalid @enderror" name="wage_per_hours" value="{{ old('wage_per_hours') }}"  autocomplete="wage_per_hours" >
                     @error('wage_per_hours')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group ">
                     <label for="total_hours" class="col-form-label text-md-right">{{ __('trans.Total_hour(per_day_or_per_week_or_per_month_per_year)') }}</label>
                     <input id="total_hours" type="text" class="form-control @error('total_hours') is-invalid @enderror" name="total_hours" value="{{ old('total_hours') }}"  autocomplete="total_hours" >
                     @error('total_hours')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group ">
                     <label for="total_hours_student" class="col-form-label text-md-right">{{ __('trans.There_hour_s_with_student') }}</label>
                     <input id="total_hours_student" type="text" class="form-control @error('total_hours_student') is-invalid @enderror" name="total_hours_student" value="{{ old('total_hours_student') }}"  autocomplete="total_hours_student" >
                     @error('total_hours_student')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group ">
                     <label for="license_pic" class="col-form-label text-md-right">{{ __('trans.License_pic') }}</label>
                     <input id="license_pic" class="form-control @error('license_pic') is-invalid @enderror"  name="license_pic" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('license_pic') }}"  style="height: 48px;background: transparent;border: none;"/>
                     @error('license_pic')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group ">
                     <label for="instructor_card" class="col-form-label text-md-right">{{ __('trans.Instructor_card') }}</label>
                     <input id="instructor_card" class="form-control @error('instructor_card') is-invalid @enderror"  name="instructor_card" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('instructor_card') }}"  style="height: 48px;background: transparent;border: none;"/>
                     @error('instructor_card')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group ">
                     <label for="cv_letter" class="col-form-label text-md-right">{{ __('trans.Experience_letter_or_cv') }}</label>
                     <input id="cv_letter" class="form-control @error('cv_letter') is-invalid @enderror"  name="cv_letter" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('cv_letter') }}"  style="height: 48px;background: transparent;border: none;"/>
                     @error('cv_letter')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group ">
                     <label for="piece_of_identity" class="col-form-label text-md-right">{{ __('trans.Piece_of_identity') }}</label>
                     <input id="piece_of_identity" class="form-control @error('piece_of_identity') is-invalid @enderror"  name="piece_of_identity" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('piece_of_identity') }}"  style="height: 48px;background: transparent;border: none;"/>
                     @error('piece_of_identity')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group ">
                     <label for="medical_form" class="col-form-label text-md-right">{{ __('trans.Medical_form') }}</label>
                     <input id="medical_form" class="form-control @error('medical_form') is-invalid @enderror"  name="medical_form" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('medical_form') }}"  style="height: 48px;background: transparent;border: none;"/>
                     @error('medical_form')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">  {{ __('trans.Register')}}</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script>
   $('.formId').click(function(event) {
   event.preventDefault();
   var form = $(this).parent();
   
   $.confirm({
   columnClass: 'col-md-4 col-md-offset-4',
   theme: 'dark',
   title: 'Delete',
   content: 'Are Your Sure To Delete User, Data Related To This User Will Also Delete. Data Will Not Recoverd ?',
   buttons: {
   Delete: function () {
   form.submit();
   },
   cancel: function () {
   
   },
   }
   });
   });
   $(document).ready(function(){
   $.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
   });
   //  alert('hello');
   all_branch();
   
   });
   
   
   function all_branch(){
   
   $.ajax(
   {
   url: "{{URL::to('brach_all_data')}}",
   type: 'GET',
   dataType: 'json',
   success: function (response){
   $('#branch_id').empty();
   var len = 0;
   len = response['data'].length;
   if(len > 0){
      for(var i=0; i<len; i++){
          var id = response['data'][i].id;
          var name = response['data'][i].name;
           var tr_str = '<option value="' +id+ '">' + name + '</option>'
          $("#branch_id").append(tr_str);
      }
   }
   
   
   },
   error: function (xhr, b, c) {
      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
   }
   
   });
   
   }
   
   
   function showData() {
   var firstP = document.getElementById('user_type');
   var star=firstP.value;
   //  alert(star);
   if(star == "instructor")
   {
      
    
      document.getElementById('review_form').style.display="block";
      
      document.getElementById("wage_per_hours").setAttribute("required", "");
      document.getElementById("total_hours").setAttribute("required", "");
      document.getElementById("total_hours_student").setAttribute("required", "");
      document.getElementById("license_pic").setAttribute("required", "");
      document.getElementById("instructor_card").setAttribute("required", "");
      document.getElementById("cv_letter").setAttribute("required", "");
      document.getElementById("piece_of_identity").setAttribute("required", "");
      document.getElementById("medical_form").setAttribute("required", "");
       
   }  
   else{
   
   document.getElementById('review_form').style.display="none";
   
   document.getElementById("wage_per_hours").removeAttribute("required");
   document.getElementById("total_hours").removeAttribute("required");
   document.getElementById("total_hours_student").removeAttribute("required");
   document.getElementById("license_pic").removeAttribute("required");
   document.getElementById("instructor_card").removeAttribute("required");
   document.getElementById("cv_letter").removeAttribute("required");
   document.getElementById("piece_of_identity").removeAttribute("required");
   document.getElementById("medical_form").removeAttribute("required");
   }
   }
</script>
@endsection
