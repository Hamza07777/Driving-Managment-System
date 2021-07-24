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
      {{--  <button class="btn btn-primary btn-icon " data-toggle="modal" data-target="#addnote"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Add Branch</button>  --}}
      <!--<a href="{{ route('course.create') }}"  class="btn btn-primary pull-right "><i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Course') }}</a>-->
      <button type="button" class="btn btn-primary btn-demo pull-right button_slide slide_right" data-toggle="modal" data-target="#myModal2">
      <i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Course')}}
      </button>
      <h5>{{ __('trans.All_Courses') }}</h5>
   </div>
   <!-- /.box-header -->
   <div class="table-responsive">
      <table id="advance-1" class="display">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col">{{ __('trans.Course_Name') }}</th>
               <th scope="col">{{ __('trans.Price') }}</th>
               <th scope="col">{{ __('trans.Time_Period') }}</th>
               <th scope="col">{{ __('trans.Course_Type') }}</th>
               <th scope="col">{{ __('trans.Instructor_Name') }}</th>
               <th scope="col">{{ __('trans.Class_Name') }}</th>
               <th scope="col">{{ __('trans.Status') }}</th>
               <th scope="col">{{ __('trans.Action') }}</th>
            </tr>
         </thead>
         <tbody>
            @foreach( $course as $key => $course )
            <tr>
               <td scope="row">{{$key+1}}</td>
               <td scope="row">{{$course->course_name}}</td>
               <td scope="row">{{$course->price}}{{App\Models\setting::compnay_currency()}}</td>
               <td scope="row">{{$course->time_period}}</td>
               <td scope="row">{{$course->course_type}}</td>
               <td scope="row">{{ !empty($course->course_user->first_name) ? $course->course_user->first_name:'' }}</td>
               <td scope="row">{{!empty($course->course_class->class_name) ?  $course->course_class->class_name:''}}</td>
               <td scope="row">
                  <label class="switch">
                  <input type="checkbox" onclick="checkFluency({{ $course->id }})"  id="{{ $course->id  }}"
                  @if($course->status=="active")         
                  checked
                  @endif
                  >
                  <span class="slider round"></span>
                  </label>
               </td>
               <td scope="row" >
                  <button class="btn" style="background: transparent;"  onclick="edit_course({{$course->id}})" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></button>
                  <!--<a href="{{url('course/'.$course->id.'/edit')}}" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></a>-->
                  {{--  <a href="" style=""><i class="fa fa-eye" style="font-size: 16px; margin-left: 10%;"></i></a>  --}}
                  <form action="{{url('course',$course->id)}}" method="POST" style="float: right ;margin-right: 6%;    margin-top: 7%;">
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
               <th scope="col">{{ __('trans.Course_Name') }}</th>
               <th scope="col">{{ __('trans.Price') }}</th>
               <th scope="col">{{ __('trans.Time_Period') }}</th>
               <th scope="col">{{ __('trans.Course_Type') }}</th>
               <th scope="col">{{ __('trans.Instructor_Name') }}</th>
               <th scope="col">{{ __('trans.Class_Name') }}</th>
               <th scope="col">{{ __('trans.Status') }}</th>
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
               <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Add_Course') }}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" action="{{ route('course.store') }}" enctype="multipart/form-data" >
                  @csrf
                  <div class="form-group">
                     <label for="Course_Name" class="col-form-label text-md-right">{{ __('trans.Course_Name') }}</label>
                     <input id="course_name" type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name" value="{{ old('course_name') }}" required autocomplete="course_name" autofocus>
                     @error('course_name')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="price" class="col-form-label text-md-right">{{ __('trans.Price') }}</label>
                     <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">
                     @error('price')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="time_period" class=" col-form-label text-md-right">{{ __('trans.Time_Period') }}</label>
                     <input id="time_period" type="text" class="form-control @error('time_period') is-invalid @enderror" name="time_period" value="{{ old('time_period') }}" required autocomplete="time_period" >
                     @error('time_period')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="Course_Type" class="col-form-label text-md-right">{{ __('trans.Course_Type') }}</label>
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
                     <label for="Instructor_id" class=" col-form-label text-md-right">{{ __('trans.Instructor_Name') }}</label>
                     <select class="form-control" id="Instructor_id" name="instructor_id">
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="class_id" class="col-form-label text-md-right">{{ __('trans.Class_Name') }}</label>
                     <select class="form-control" id="class_id" name="class_id">
                     </select>
                  </div>
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
            <h5 class="modal-title" id="exampleModalLabel">{{ __('Update Course') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="/course/" enctype="multipart/form-data" id="branchform">
               @csrf
               {{ method_field('PUT') }}
               <div class="form-group">
                  <label for="Course_Name" class="col-form-label text-md-right">{{ __('trans.Course_Name') }}</label>
                  <input id="course_name" type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name" value="{{ old('course_name') }}" required autocomplete="course_name" autofocus>
                  @error('course_name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="price" class="col-form-label text-md-right">{{ __('trans.Price') }}</label>
                  <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">
                  @error('price')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="time_period" class=" col-form-label text-md-right">{{ __('trans.Time_Period') }}</label>
                  <input id="time_period" type="text" class="form-control @error('time_period') is-invalid @enderror" name="time_period" value="{{ old('time_period') }}" required autocomplete="time_period" >
                  @error('time_period')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="Course_Type" class="col-form-label text-md-right">{{ __('trans.Course_Type') }}</label>
                  <select class="form-control" id="course_type" name="course_type">
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
                  <label for="Instructor_id" class=" col-form-label text-md-right">{{ __('trans.Instructor_Name') }}</label>
                  <select class="form-control" id="Instructor_id" name="instructor_id">
                  </select>
               </div>
               <div class="form-group">
                  <label for="class_id" class="col-form-label text-md-right">{{ __('trans.Class_Name') }}</label>
                  <select class="form-control" id="class_id" name="class_id">
                  </select>
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
      
       
      //  document.onsubmit=function(){
      //           return confirm('Are Your Sure to Delete Course, Data Related To This Course Will Also  Delete. Data Will Not Recoverd ?');
      //       }
      
      
                   $('.formId').click(function(event) {
          event.preventDefault();
          var form = $(this).parent();
      
            $.confirm({
            columnClass: 'col-md-4 col-md-offset-4',
            theme: 'dark',
            title: 'Delete',
            content: 'Are Your Sure To Delete Course, Data Related To This Course Will Also Delete. Data Will Not Recoverd ?',
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
        
      
      function all_class(id){
      
          $.ajax(
          {
              url: "{{URL::to('all_class_data')}}",
              type: 'GET',
              dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 // alert('heloo');
                 $('#class_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 ;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var name = response['data'][i].class_name;
                           var tr_str = '<option value="' +id+ '">' + name + '</option>'
                          $("#class_id").append(tr_str);
                      }
                 }
                 
                
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
              
          });
         
      }
      
      
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
      
      
      function all_class_branch(id){
      
          $.ajax(
          {
              url: "{{URL::to('all_class_data')}}",
              type: 'GET',
              dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 // alert('heloo');
                 $('#branchform #class_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 ;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var name = response['data'][i].class_name;
                           var tr_str = '<option value="' +id+ '">' + name + '</option>'
                          $("#branchform #class_id").append(tr_str);
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
      
      
      
      
      
      function edit_course(id){
          
      
         // var token = $("meta[name='csrf-token']").attr("content");
         $("#myModal3").modal('show');
       <?php 
         $branch = DB::table('branches')->get(); 
         
            ?>
             
      
       
          $.ajax(
          {
              
              url: "course/"+id+"/edit",
              type: 'GET',
               dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                  $('#branchform #Instructor_id').empty();
                  $('#branchform #class_id').empty();
                    $('#branchform #branch_idd').empty();
                     $('#branchform #course_type').empty();
                    //console.log(response['data']);
              //   for(var i=0; i<1; i++){
                      // var id = response['data'].id;
                       var course_name = response['data'].course_name;
                      var price = response['data'].price;
             
                      var time_period = response['data'].time_period;
                       var course_type = response['data'].course_type;
                         var class_id = response['data'].class_id;
                           var class_name = response['data'].class_name;
                           
                           
                            var instructor_id = response['data'].instructor_id;
                      var instructor_first_name = response['data'].first_name;
                      var instructor_last_name = response['data'].last_name;
              //   }
      
              $("#branchform").attr('action',$("#branchform").attr('action')+id);
              $('#branchform #course_name').val(course_name);
              $('#branchform #price').val(price);
              $('#branchform #time_period').val(time_period);
              $('#branchform #course_type').val(course_type);
              
      
      var tr_str3 = '<option value="'+course_type+'" >'+course_type+'</option><option value="theoratical" >Theoratical</option><option value="practical">Practical</option>'
                          $("#branchform #course_type").append(tr_str3);
                          
              var tr_str = '<option value="'+class_id+'" selected>'+class_name+'</option>'
                          $("#branchform #class_id").append(tr_str);
                          
              var tr_str1 = '<option value="'+instructor_id+'" selected>'+instructor_first_name+' '+ instructor_last_name +'</option>';
                          $("#branchform #Instructor_id").append(tr_str1);
                var tr_str4 = '<?php   foreach ($branch as $branch){  echo $branch->id  ?> <option value="<?php echo $branch->id ?>"  ><?php echo $branch->name ?></option><?php } ?>';                    
                          
                           $("#branchform #branch_idd").append(tr_str4);
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
              url: "course_change_status/"+id,
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
            all_class(star);
            all_user(star);
      
          }
           function showData() {
          //document.getElementById("branch_select").removeAttribute("selected");
         var firstP = document.getElementById('branch_idd');
         
         var star=firstP.value;
        // alert(star);
          all_class_branch(star);
            all_user_branch(star);
      
          }
   </script>             
</div>
@endsection
