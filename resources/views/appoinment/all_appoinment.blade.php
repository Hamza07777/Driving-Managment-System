@extends('../layouts.admin_app')
@section('content')
<div class="box">
   <div class="box-header">
      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      <?php $todayDate = date('Y/m/d'); ?>
      {{--  <button class="btn btn-primary btn-icon " data-toggle="modal" data-target="#addnote"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Add Branch</button>  --}}
      <!--<a href="{{ route('appoinment.create') }}"  class="btn btn-primary pull-right"><i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_appoinment')}}</a>-->
      <button type="button" class="btn btn-primary btn-demo pull-right button_slide slide_right" data-toggle="modal" data-target="#myModal2" style="width: 158px;">
      <i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_appoinment')}}
      </button>
      <h5>{{ __('trans.All_Appoinment')}}</h5>
   </div>
   <!-- /.box-header -->
   <div class="table-responsive">
      <table id="advance-1" class="display">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col" style="width: 26%;">{{ __('trans.Text')}}</th>
               <th scope="col">{{ __('trans.Appoinemnt_Start')}}</th>
               <th scope="col">{{ __('trans.Appoinemnt_End')}}</th>
               <th scope="col">{{ __('trans.Appoinment_Time')}}</th>
               <th scope="col">{{ __('trans.Course_Name')}}</th>
               <th scope="col">{{ __('trans.Instructor_Number')}}</th>
               <th scope="col">{{ __('trans.Status')}}</th>
               <th scope="col">{{ __('trans.Action') }}</th>
            </tr>
         </thead>
         <tbody>
            @foreach( $appointment as $key => $appointment )
            <tr>
               <td scope="row">{{$key+1}}</td>
               <td scope="row">{{$appointment->text}}</td>
               <td scope="row">{{$appointment->appoinment_start}}</td>
               <td scope="row">{{$appointment->appoinment_end}}</td>
               <td scope="row">{{  \App\models\setting::date_farmate($appointment->appoinment_day)     }}</td>
               @if(!empty($appointment->appoinment_course->course_name))         
               <td scope="row">{{$appointment->appoinment_course->course_name}}</td>
               @else
               <td>  </td>
               @endif
               @if(!empty($appointment->appoinment_user->first_name) && !empty($appointment->appoinment_user->last_name))         
               <td scope="row">{{$appointment->appoinment_user->first_name}} {{$appointment->appoinment_user->last_name}}</td>
               @else
               <td>  </td>
               @endif
               <td scope="row">
                  <label class="switch">
                  <input type="checkbox" onclick="checkFluency({{ $appointment->id }})"  id="{{ $appointment->id  }}"
                  @if($appointment->status=="active")         
                  checked
                  @endif
                  >
                  <span class="slider round"></span>
                  </label>
               </td>
               <td scope="row" >
                  <!--<a href="{{url('appoinment/'.$appointment->id.'/edit')}}" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></a>-->
                  <button class="btn" style="background: transparent;"  onclick="edit_appoinment({{$appointment->id}})" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></button>
                  {{--  <a href="" style=""><i class="fa fa-eye" style="font-size: 16px; margin-left: 10%;"></i></a>  --}}
                  <form action="{{url('appoinment/'.$appointment->id)}}" method="POST" style="float: right ;margin-right: 6%;margin-top:7%">
                     @csrf
                     @method('DELETE')
                     <button type="button" class="formId" style="border: none;color: red; background-color: transparent;"><i class="fa fa-trash " style="font-size: 16px;"></i></button>
                  </form>
               </td>
            </tr>
            @endforeach
         </tbody>
         <tfoot>
            <tr>
               <th scope="col">#</th>
               <th scope="col" style="width: 26%;">{{ __('trans.Text')}}</th>
               <th scope="col">{{ __('trans.Appoinemnt_Start')}}</th>
               <th scope="col">{{ __('trans.Appoinemnt_End')}}</th>
               <th scope="col">{{ __('trans.Appoinment_Time')}}</th>
               <th scope="col">{{ __('trans.Course_Name')}}</th>
               <th scope="col">{{ __('trans.Instructor_Number')}}</th>
               <th scope="col">{{ __('trans.Status')}}</th>
               <th scope="col">{{ __('trans.Action') }}</th>
            </tr>
         </tfoot>
      </table>
   </div>
   <!-- /.box-body -->
   <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Register_Appoinment') }}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" action="{{ route('appoinment.store') }}" enctype="multipart/form-data" >
                  @csrf
                  <div class="form-group bootstrap-timepicker">
                     <label for="price" class="col-form-label text-md-right">{{ __('trans.Appoinment_start_time') }}</label>
                     <input id="appoinment_start" type="text" class="form-control timepicker @error('appoinment_start') is-invalid @enderror" name="appoinment_start" value="{{ old('appoinment_start') }}" required autocomplete="appoinment_start" autofocus>
                     @error('appoinment_start')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group bootstrap-timepicker">
                     <label for="time_period" class=" col-form-label text-md-right">{{ __('trans.Appoinment_end_time') }}</label>
                     <input id="appoinment_end" type="text" class="form-control timepicker @error('appoinment_end') is-invalid @enderror" name="appoinment_end" value="{{ old('appoinment_end') }}" required autocomplete="appoinment_end" autofocus>
                     @error('appoinment_end')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="time_period" class=" col-form-label text-md-right">{{ __('trans.Appoinment_Date') }}</label>
                     <input id="datepicker2" type="text" class="form-control @error('appoinment_day') is-invalid @enderror" name="appoinment_day" value="{{ old('appoinment_day') }}" required autocomplete="appoinment_day" autofocus placeholder="{{ $todayDate }}">
                     @error('appoinment_day')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Brach_Name') }}</label>
                     <select class="form-control" id="branch_id" name="branch_id" onchange="showData_create()">
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="Instructor_id" class=" col-form-label text-md-right">{{ __('trans.Instructor_Name') }}</label>
                     <select class="form-control" id="Instructor_id" name="instructor_id">
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="course_id" class="col-form-label text-md-right">{{ __('trans.Course_Name') }}</label>
                     <select class="form-control" id="course_id" name="course_id">
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.student_Name') }}</label>
                     <select class="form-control" id="student_id" name="student_id">
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="Course_Name" class="col-form-label text-md-right">{{ __('trans.Description') }}</label>
                     <textarea class="form-control" id="text" rows="7" autocomplete="text" required name="text" style="height:80px !important "></textarea>
                     @error('text')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary button_slide slide_right ">  {{ __('trans.Register')}}</button>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal right fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> {{ __('trans.Update_Appoinmnet') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="/appoinment/" enctype="multipart/form-data" id="branchform">
               @csrf
               {{ method_field('PUT') }}
               <div class="form-group bootstrap-timepicker">
                  <label for="price" class="col-form-label text-md-right">{{ __('trans.Appoinment_start_time') }}</label>
                  <input id="appoinment_start" type="text" class="form-control timepicker @error('appoinment_start') is-invalid @enderror" name="appoinment_start" value="{{ old('appoinment_start') }}" required autocomplete="appoinment_start" autofocus>
                  @error('appoinment_start')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group bootstrap-timepicker">
                  <label for="time_period" class=" col-form-label text-md-right">{{ __('trans.Appoinment_end_time') }}</label>
                  <input id="appoinment_end" type="text" class="form-control timepicker @error('appoinment_end') is-invalid @enderror" name="appoinment_end" value="{{ old('appoinment_end') }}" required autocomplete="appoinment_end" autofocus>
                  @error('appoinment_end')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="time_period" class=" col-form-label text-md-right">{{ __('trans.Appoinment_Date') }}</label>
                  <input id="datepicker" type="text" class="form-control @error('appoinment_day') is-invalid @enderror" name="appoinment_day" value="{{ old('appoinment_day') }}" required autocomplete="appoinment_day" autofocus placeholder="{{ $todayDate }}">
                  @error('appoinment_day')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Brach_Name') }}</label>
                  <select class="form-control" id="branch_idd" name="branch_id" onchange="showData()">
                  </select>
               </div>
               <div class="form-group">
                  <label for="Instructor_id" class=" col-form-label text-md-right">{{ __('trans.Instructor_Name') }}</label>
                  <select class="form-control" id="Instructor_id" name="instructor_id">
                  </select>
               </div>
               <div class="form-group">
                  <label for="course_id" class="col-form-label text-md-right">{{ __('trans.Course_Name') }}</label>
                  <select class="form-control" id="course_id" name="course_id">
                  </select>
               </div>
               <div class="form-group">
                  <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.student_Name') }}</label>
                  <select class="form-control" id="student_id" name="student_id">
                  </select>
               </div>
               <div class="form-group">
                  <label for="Course_Name" class="col-form-label text-md-right">{{ __('trans.Description') }}</label>
                  <textarea class="form-control" id="text" rows="7" autocomplete="text" required name="text" style="height:80px !important "></textarea>
                  @error('text')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary button_slide slide_right">  {{ __('trans.Update') }}</button>
         </div>
         </form>
      </div>
   </div>
   <script>
      $(document).ready(function(){
          
          
          
         
          // Fetch all records
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
      function all_student(id){
      
          $.ajax(
          {
              url: "{{URL::to('student_all_data')}}",
              type: 'GET',
              dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 $('#student_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var first_name = response['data'][i].first_name;
                          var last_name = response['data'][i].last_name;
                           var tr_str = '<option value="' +id+ '">' + first_name +' '+ last_name + '</option>'
                          
                          $("#student_id").append(tr_str);
                      }
                 }
                 
                
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
              
          });
         
      }
      
      function all_student_branch(id){
      
          $.ajax(
          {
              url: "{{URL::to('student_all_data')}}",
              type: 'GET',
              dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 $('#branchform #student_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var first_name = response['data'][i].first_name;
                          var last_name = response['data'][i].last_name;
                           var tr_str = '<option value="' +id+ '">' + first_name +' '+ last_name + '</option>'
                          
                          $("#branchform #student_id").append(tr_str);
                      }
                 }
                 
                
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
              
          });
         
      }
      
      
      
      function all_course(id){
      
          $.ajax(
          {
              url: "{{URL::to('all_course_data')}}",
              type: 'GET',
              dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 // alert('heloo');
                 $('#course_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 ;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var name = response['data'][i].course_name;
                           var tr_str = '<option value="' +id+ '">' + name + '</option>'
                          $("#course_id").append(tr_str);
                      }
                 }
                 
                
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
              
          });
         
      }
      
      //  document.onsubmit=function(){
      //           return confirm('Are Your Sure to Delete Appointment Data Related To This Appointment Will Also  Delete. Data Will Not Recoverd ?');
      //       }
             
             
                   $('.formId').click(function(event) {
          event.preventDefault();
         var form = $(this).parent();
      
            $.confirm({
            columnClass: 'col-md-4 col-md-offset-4',
            theme: 'dark',
            title: 'Delete',
            content: 'Are Your Sure To Delete Appointment Data Related To This Appointment Will Also Delete. Data Will Not Recoverd ?',
           buttons: {
              Delete: function () {
                  form.submit();
              },
              cancel: function () {
               
              },
           }
          });
        });
             
             
      function all_user(id){
      
          $.ajax(
          {
              url: "{{URL::to('instructor_all_data')}}",
              type: 'GET',
              dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 $('#Instructor_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var first_name = response['data'][i].first_name;
                          var last_name = response['data'][i].last_name;
                           var tr_str = '<option value="' +id+ '">' + first_name +' '+ last_name + '</option>'
                          $("#Instructor_id").append(tr_str);
                      }
                 }
                 
                
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
              
          });
         
      }
      
      
      
      function all_user_branch(id){
      
          $.ajax(
          {
              url: "{{URL::to('instructor_all_data')}}",
              type: 'GET',
              dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 $('#branchform #Instructor_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var first_name = response['data'][i].first_name;
                          var last_name = response['data'][i].last_name;
                           var tr_str = '<option value="' +id+ '">' + first_name +' '+ last_name + '</option>'
                          $("#branchform #Instructor_id").append(tr_str);
                      }
                 }
                 
                
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
              
          });
         
      }
      
      function all_course_branch(id){
      
          $.ajax(
          {
              url: "{{URL::to('all_course_data')}}",
              type: 'GET',
              dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 // alert('heloo');
                 $('#branchform #course_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 ;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var name = response['data'][i].course_name;
                           var tr_str = '<option value="' +id+ '">' + name + '</option>'
                          $("#branchform #course_id").append(tr_str);
                      }
                 }
                 
                
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
              
          });
         
      }
      
      
      
      
      function edit_appoinment(id){
          
      
         // var token = $("meta[name='csrf-token']").attr("content");
         $("#myModal3").modal('show');
       <?php 
         $branch = DB::table('branches')->get(); 
         
         
          
               ?>
             
      
       
          $.ajax(
          {
              
              url: "appoinment/"+id+"/edit",
              type: 'GET',
               dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                  $('#branchform #branch_idd').empty();
                  $('#branchform #Instructor_id').empty();
                  $('#branchform #course_id').empty();
                    console.log(response['data']);
              //   for(var i=0; i<1; i++){
                      // var id = response['data'].id;
                       var text = response['data'].text;
                      var appoinment_start = response['data'].appoinment_start;
             
                      var appoinment_end = response['data'].appoinment_end;
                       var appoinment_day = response['data'].appoinment_day;
                      var course_id = response['data'].course_id;
                      var course_name = response['data'].course_name;
                      
                       var instructor_id = response['data'].instructor_id;
                      var instructor_first_name = response['data'].first_name;
                      var instructor_last_name = response['data'].last_name;
                      
                      var student_id = response['data'].student_id;
                      var student_first_name = response['data'].student_first_name;
                      var student_last_name = response['data'].student_last_name;
                            
              //   }
              
      
              $("#branchform").attr('action',$("#branchform").attr('action')+id);
              $('#branchform #text').val(text);
              $('#branchform #appoinment_start').val(appoinment_start);
              $('#branchform #appoinment_end').val(appoinment_end);
              $('#branchform #datepicker').val(appoinment_day);
                               
                  var tr_str2 = '<?php   foreach ($branch as $branch){  echo $branch->id  ?> <option value="<?php echo $branch->id ?>"  ><?php echo $branch->name ?></option><?php } ?>';             
              var tr_str = '<option value="'+course_id+'" selected>'+course_name+'</option>';
              var tr_str1 = '<option value="'+instructor_id+'" selected>'+instructor_first_name+' '+ instructor_last_name +'</option>';
              
              
              var tr_str5 = '<option value="'+student_id+'" selected>'+student_first_name+' '+ student_last_name +'</option>';
              
                          $("#branchform #student_id").append(tr_str5);
                          $("#branchform #branch_idd").append(tr_str2);
                          $("#branchform #course_id").append(tr_str);
                           $("#branchform #Instructor_id").append(tr_str1);        
                       
              // $('#branchform #status').val(status);
               // console.log(name);
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
          });
          // fetchRecords();
         
      }
      
      function checkFluency(id){
          // var checkbox = document.getElementById(id);
          // if (checkbox.checked != false) {
      	   // alert("Checkbox checked"+ id)
          // }else{
      	   // alert("Not Checked"+ id)
          // }
          
          
          
          
          
          $.ajax(
          {
              url: "appointment_change_status/"+id,
              type: 'GET',
               dataType: 'json',
              // data: {
              //     "id": id,
              //   // "_token": token,
              // },
              success: function (response){
                     console.log(response)
             
              //   }
          
               // console.log(name);
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
          });
      }
      
      
      
       function showData_create() {
          //document.getElementById("branch_select").removeAttribute("selected");
         var firstP = document.getElementById('branch_id');
         
         var star=firstP.value;
        // alert(star);
          all_course(star);
            all_user(star);
          all_student(star);
          }
           function showData() {
          //document.getElementById("branch_select").removeAttribute("selected");
         var firstP = document.getElementById('branch_idd');
         
         var star=firstP.value;
        // alert(star);
          all_course_branch(star);
           all_user_branch(star);
          all_student_branch(star);
          }
   </script>  
</div>
@endsection
