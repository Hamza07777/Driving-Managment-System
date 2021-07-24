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
   <!--<a href="{{ route('roadschedule.create') }}"  class="btn btn-primary pull-right "><i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Schedule') }}</a>-->
   <button type="button" class="btn btn-primary btn-demo pull-right button_slide slide_right" data-toggle="modal" data-target="#myModal2" style="width: 181px;">
   <i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Schedule')}}
   </button>
   <h5>{{ __('trans.All_Schedule') }}</h5>
</div>
<!-- /.box-header -->
<div class="table-responsive">
   <table id="advance-1" class="display">
      <thead>
         <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('trans.Class_Start') }}</th>
            <th scope="col">{{ __('trans.Class_End') }}</th>
            <th scope="col">{{ __('trans.Class_Date') }}</th>
            <th scope="col">{{ __('trans.student_Name') }}</th>
            <th scope="col">{{ __('trans.Instructor_Name') }}</th>
            <th scope="col">{{ __('trans.Course_Name') }}</th>
            <th scope="col">{{ __('trans.Branch_Name') }}</th>
            <th scope="col">{{ __('trans.Vehical_Name') }}</th>
            <th scope="col">{{ __('trans.Course_Type') }}</th>
            <th scope="col">{{ __('trans.Status') }}</th>
            <th scope="col">{{ __('trans.Action') }}</th>
         </tr>
      </thead>
      <tbody>
         @foreach( $roadschedule as $key => $roadschedule )
         <tr>
            <td scope="row">{{$key+1}}</td>
            <td scope="row">{{$roadschedule->class_start}}</td>
            <td scope="row">{{$roadschedule->class_end}}</td>
            <td scope="row">  {{  \App\models\setting::date_farmate($roadschedule->class_day)     }}   </td>
            @if(!empty($roadschedule->road_schedule_student->first_name) && !empty($roadschedule->road_schedule_student->last_name))         
            <td scope="row">{{$roadschedule->road_schedule_student->first_name}} {{$roadschedule->road_schedule_student->last_name}}</td>
            @else
            <td>  </td>
            @endif
            @if(!empty($roadschedule->road_schedule_instructor->first_name) && !empty($roadschedule->road_schedule_instructor->last_name))         
            <td scope="row">{{$roadschedule->road_schedule_instructor->first_name}} {{$roadschedule->road_schedule_instructor->last_name}}</td>
            @else
            <td>  </td>
            @endif
            <td scope="row">{{ !empty($roadschedule->road_schedule_coursess->course_name) ? $roadschedule->road_schedule_coursess->course_name:'' }}</td>
            {{--  
            <td scope="row">{{ $roadschedule->road_schedule_coursess->id }}</td>
            --}}
            <td scope="row">{{ !empty($roadschedule->road_schedule_branch->name) ? $roadschedule->road_schedule_branch->name:'' }} </td>
            @if(!empty($roadschedule->road_schedule_vehical->car_name) && !empty($roadschedule->road_schedule_vehical->car_no))         
            <td scope="row">{{$roadschedule->road_schedule_vehical->car_name}} {{$roadschedule->road_schedule_vehical->car_no}}</td>
            @else
            <td>  </td>
            @endif
            <td scope="row">{{$roadschedule->course_type}}</td>
            <td scope="row">
               <label class="switch">
               <input type="checkbox" onclick="checkFluency({{ $roadschedule->id }})"  id="{{ $roadschedule->id  }}"
               @if($roadschedule->status=="active")         
               checked
               @endif
               >
               <span class="slider round"></span>
               </label>
            </td>
            <td scope="row" >
               <button class="btn" style="    margin-left: 11px;background: transparent;"  onclick="edit_roadschedule({{$roadschedule->id}})" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></button>
               <!--                                    <a href="{{url('roadschedule/'.$roadschedule->id.'/edit')}}" style="float: left;-->
               <!--}"><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></a>-->
               {{--  <a href="" style=""><i class="fa fa-eye" style="font-size: 16px; margin-left: 10%;"></i></a>  --}}
               <form action="{{url('roadschedule',$roadschedule->id)}}" method="POST" style="float: right ;margin-right: 38%;">
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
            <th scope="col">{{ __('trans.Class_Start') }}</th>
            <th scope="col">{{ __('trans.Class_End') }}</th>
            <th scope="col">{{ __('trans.Class_Date') }}</th>
            <th scope="col">{{ __('trans.student_Name') }}</th>
            <th scope="col">{{ __('trans.Instructor_Name') }}</th>
            <th scope="col">{{ __('trans.Course_Name') }}</th>
            <th scope="col">{{ __('trans.Branch_Name') }}</th>
            <th scope="col">{{ __('trans.Vehical_Name') }}</th>
            <th scope="col">{{ __('trans.Course_Type') }}</th>
            <th scope="col">{{ __('trans.Status') }}</th>
            <th scope="col">{{ __('trans.Action') }}</th>
         </tr>
      </tfoot>
   </table>
</div>
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Add_Schedule') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('roadschedule.store')  }}" enctype="multipart/form-data" >
               @csrf
               <div class="form-group bootstrap-timepicker">
                  <label for="class_start" class="col-form-label text-md-right">{{ __('trans.Class_Start') }}</label>
                  <input id="class_start" type="text" class="form-control timepicker @error('class_start') is-invalid @enderror" name="class_start" value="{{ old('class_start') }}" required autocomplete="class_start" autofocus>
                  @error('class_start')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group bootstrap-timepicker">
                  <label for="class_end" class="col-form-label text-md-right">{{ __('trans.Class_End') }}</label>
                  <input id="class_end" type="text" class="form-control timepicker @error('class_end') is-invalid @enderror" name="class_end" value="{{ old('class_end') }}" required autocomplete="class_end" autofocus>
                  @error('class_end')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="class_dayy" class=" col-form-label text-md-right">{{ __('trans.Class_Date') }}</label>
                  <input id="datepicker2" type="text" class="form-control @error('class_dayy') is-invalid @enderror" name="class_dayy"  required  autofocus placeholder="{{ $todayDate }}">
                  @error('class_dayy')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="course_type" class=" col-form-label text-md-right">{{ __('trans.Schedule_Type') }}</label>
                  <select class="form-control" id="sel1" name="course_type">
                     <option value='theoratical'>{{ __('trans.Theoratical') }}</option>
                     <option value='practical'>{{ __('trans.Practical') }}</option>
                  </select>
                  @error('model_year')
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
                  <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Course_Name') }}</label>
                  <select class="form-control" id="course_id" name="course_id">
                  </select>
               </div>
               <div class="form-group">
                  <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.student_Name') }}</label>
                  <select class="form-control" id="student_id" name="student_id">
                  </select>
               </div>
               <div class="form-group">
                  <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Vehical_Name') }}</label>
                  <select class="form-control" id="vehical_id" name="vehical_id">
                  </select>
               </div>
               <div class="form-group">
                  <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Instructor_Name') }}</label>
                  <select class="form-control" id="instructor_id" name="instructor_id">
                  </select>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary button_slide slide_right">  {{ __('trans.Register')}}</button>
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
         <h5 class="modal-title" id="exampleModalLabel">{{ __('Update ') }}</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
         <form method="POST" action="/roadschedule/" enctype="multipart/form-data" id="branchform">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group bootstrap-timepicker">
               <label for="class_start" class=" col-form-label text-md-right">{{ __('trans.Class_Start') }}</label>
               <input id="class_start" type="text" class="form-control timepicker @error('class_start') is-invalid @enderror" name="class_start" value="{{ old('class_start') }}" required autocomplete="class_start" autofocus>
               @error('class_start')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <div class="form-group bootstrap-timepicker">
               <label for="class_end" class="col-form-label text-md-right">{{ __('trans.Class_End') }}</label>
               <input id="class_end" type="text" class="form-control timepicker @error('class_end') is-invalid @enderror" name="class_end" value="{{ old('class_end') }}" required autocomplete="class_end" autofocus>
               @error('class_end')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <div class="form-group">
               <label for="class_dayy" class=" col-form-label text-md-right">{{ __('trans.Class_Date') }}</label>
               <input id="datepicker" type="text" class="form-control @error('class_day') is-invalid @enderror" name="class_day"  required autocomplete="class_day" autofocus placeholder="{{ $todayDate }}">
               @error('class_day')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <div class="form-group">
               <label for="course_type" class=" col-form-label text-md-right">{{ __('trans.Schedule_Type') }}</label>
               <select class="form-control" id="course_type" name="course_type">
                  <option value='theoratical'>{{ __('trans.Theoratical') }}</option>
                  <option value='practical'>{{ __('trans.Practical') }}</option>
               </select>
               @error('model_year')
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
               <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Course_Name') }}</label>
               <select class="form-control" id="course_id" name="course_id">
               </select>
            </div>
            <div class="form-group">
               <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.student_Name') }}</label>
               <select class="form-control" id="student_id" name="student_id">
               </select>
            </div>
            <div class="form-group">
               <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Vehical_Name') }}</label>
               <select class="form-control" id="vehical_id" name="vehical_id">
               </select>
            </div>
            <div class="form-group">
               <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Instructor_Name') }}</label>
               <select class="form-control" id="instructor_id" name="instructor_id">
               </select>
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
      
      //  document.onsubmit=function(){
      //           return confirm('Are Your Sure to Delete Road Schedule, Data Related To This Road Schedule Will Also  Delete. Data Will Not Recoverd ?');
      //       }
             
             
                               $('.formId').click(function(event) {
          event.preventDefault();
          var form = $(this).parent();
      
            $.confirm({
            columnClass: 'col-md-4 col-md-offset-4',
            theme: 'dark',
            title: 'Delete',
            content: 'Are Your Sure To Delete Road Schedule, Data Related To This Road Schedule Will Also Delete. Data Will Not Recoverd ?',
           buttons: {
              Delete: function () {
                  form.submit();
              },
              cancel: function () {
               
              },
           }
          });
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
      
      function all_instructor(id){
      
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
                 $('#instructor_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var first_name = response['data'][i].first_name;
                          var last_name = response['data'][i].last_name;
                           var tr_str = '<option value="' +id+ '">' + first_name +' '+ last_name + '</option>'
                          $("#instructor_id").append(tr_str);
                         
                      }
                 }
                 
                
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
              
          });
         
      }
      
      
      
      function all_instructor_branch(id){
      
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
                 $('#branchform #instructor_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var first_name = response['data'][i].first_name;
                          var last_name = response['data'][i].last_name;
                           var tr_str = '<option value="' +id+ '">' + first_name +' '+ last_name + '</option>'
                          $("#branchform #instructor_id").append(tr_str);
                         
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
      
      
      function all_vehical(id){
      
          $.ajax(
          {
              url: "{{URL::to('vehical_all_data')}}",
              type: 'GET',
              dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 $('#vehical_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var name = response['data'][i].car_name;
                          var number = response['data'][i].number_plate;
                           var tr_str = '<option value="' +id+ '">' + name +' '+ number + '</option>'
                          $("#vehical_id").append(tr_str);
                      }
                 }
                 
                
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
              
          });
         
      }
      
      
      
      function all_vehical_branch(id){
      
          $.ajax(
          {
              url: "{{URL::to('vehical_all_data')}}",
              type: 'GET',
              dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 $('#branchform #vehical_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var name = response['data'][i].car_name;
                          var number = response['data'][i].number_plate;
                           var tr_str = '<option value="' +id+ '">' + name +' '+ number + '</option>'
                          $("#branchform #vehical_id").append(tr_str);
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
      
      
      function edit_roadschedule(id){
          
      
         // var token = $("meta[name='csrf-token']").attr("content");
         $("#myModal3").modal('show');
         
        <?php 
         $branch = DB::table('branches')->get(); 
         
            ?>
          $.ajax(
          {
              url: "roadschedule/"+id+"/edit",
              type: 'GET',
               dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 //    console.log(response['data'])
              //   for(var i=0; i<1; i++){
                      // var id = response['data'].id;
                                  $('#branchform #branch_idd').empty();
                  $('#branchform #instructor_id').empty();
                  $('#branchform #course_id').empty();
                  $('#branchform #student_id').empty();
                  $('#branchform #vehical_id').empty();
                  $('#branchform #course_type').empty();
      
                       var class_start = response['data'].class_start;
                      var class_end = response['data'].class_end;
             
                      var class_dayy = response['data'].class_day;
                      var course_type = response['data'].course_type;
                      
                      
                      var branch_idd = response['data'].branch_id;
                      var branch_name = response['data'].branch_name;
                      
                      var course_id = response['data'].course_id;
                      var course_name = response['data'].course_name;
                      
                      var vehical_id = response['data'].vehical_id;
                      var car_name = response['data'].car_name;
                      var number_plate = response['data'].number_plate;
                      
                       var instructor_id = response['data'].instructor_id;
                      var instructor_first_name = response['data'].first_name;
                      var instructor_last_name = response['data'].last_name;
                      
                       var student_id = response['data'].student_id;
                      var student_first_name = response['data'].student_first_name;
                      var student_last_name = response['data'].student_last_name;
                            
                      var model_year = response['data'].model_year;
              //   }
              $("#branchform").attr('action',$("#branchform").attr('action')+id);
              $('#branchform #class_start').val(class_start);
              $('#branchform #class_end').val(class_end);
              $('#branchform #datepicker').val(class_dayy);
            //  $('#branchform #car_name').val(car_name);
             // $('#branchform #model_year').val(model_year);
      
      
      var tr_str4 = '<option value="'+course_type+'" >'+ course_type+'</option><option value="theoratical" >Theoratical</option><option value="practical">Practical</option>'
                          $("#branchform #course_type").append(tr_str3);
               
              var tr_str2 = '<option value="'+course_id+'" selected>'+course_name+'</option>';
              var tr_str3 = '<option value="'+vehical_id+'" selected>'+car_name+' '+number_plate + '</option>';
      
              var tr_str = '<option value="'+branch_idd+'" selected>'+branch_name+'</option><?php   foreach ($branch as $branch){  echo $branch->id  ?> <option value="<?php echo $branch->id ?>"  ><?php echo $branch->name ?></option><?php } ?>';
              var tr_str1 = '<option value="'+instructor_id+'" selected>'+instructor_first_name+' '+ instructor_last_name +'</option>';
              var tr_str5 = '<option value="'+student_id+'" selected>'+student_first_name+' '+ student_last_name +'</option>';
               
                       
                          $("#branchform #branch_idd").append(tr_str);
                           $("#branchform #instructor_id").append(tr_str1);
                           $("#branchform #course_id").append(tr_str2);
                           $("#branchform #student_id").append(tr_str5);
                           $("#branchform #vehical_id").append(tr_str3);
                           $("#branchform #course_type").append(tr_str4);
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
              url: "scehdule_change_status/"+id,
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
           all_instructor(star);
           all_student(star);
            all_course(star);
            all_vehical(star);
      
          }
           function showData() {
          //document.getElementById("branch_select").removeAttribute("selected");
         var firstP = document.getElementById('branch_idd');
         
         var star=firstP.value;
        // alert(star);
         all_instructor_branch(star);
           all_student_branch(star);
            all_course_branch(star);
            all_vehical_branch(star);
      
          }
   </script>           
</div>
@endsection
