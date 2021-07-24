@extends('../layouts.admin_app')
@section('content')
<div class="box">
<div class="box-header">
   {{--  <button class="btn btn-primary btn-icon " data-toggle="modal" data-target="#addnote"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Add Branch</button>  --}}
   <form action="{{ route('student_filter') }}" method="post">
      @csrf
      <div class="row">
         <h2 style="margin: 14px;"> Filter Students</h2>
         <div class="col-lg-3">
            <div class="form-group">
               <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Brach_Name') }}</label>
               <select class="form-control" id="branch_id" name="branch_id" onchange="showData()" required>
               </select>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="form-group">
               <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Course_Name') }}</label>
               <select class="form-control" id="course_id" name="course_id" required>
               </select>
            </div>
         </div>
         <div class="col-lg-3">
            <button type="submit" style="margin-top: 29px;" class="btn btn-primary" >{{ __('trans.filter')}}</button>
         </div>
   </form>
   </div>
   <hr>
   <!-- /.box-header -->
   <form action="{{ route('attendence.store') }}" method="post">
      @csrf
      <div class="box-body">
         <div class="row">
            <h2 style="margin: 14px;"> {{ __('trans.Mark_Attendence')}}</h2>
            <div class="col-lg-3">
               <label for="branch_id" class=" col-form-label text-md-right">Attendance Status</label>
               <select class="form-control" id="sel1" name="attendence_status">
                  @foreach ($attendence_status as $attendence_status)
                  <option value="{{ $attendence_status->id }}">{{ $attendence_status->status }}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-lg-3">
               <label for="branch_id" class=" col-form-label text-md-right">Attendance Date</label>
               <div class="form-group">
                  <?php $todayDate = date('Y/m/d'); ?>
                  <input id="datepicker" type="text" class="form-control @error('attendance_date') is-invalid @enderror" name="attendance_date"  required autocomplete="attendance_date"  placeholder="{{ $todayDate }}">
                  @error('attendance_date')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>
         </div>
         </br>
         <div id="actors" class="table-responsive">
            <table id="advance-1" class="display">
               <thead>
                  <tr>
                     <th scope="col">
                        <p><input onClick="setAllCheckboxes('actors',this);" type="checkbox" style="margin-right: 8px;"/>{{ __('trans.All_of_them')}}</p>
                     </th>
                     <th scope="col">#</th>
                     <th scope="col">Image</th>
                     <th scope="col">Name</th>
                     <th scope="col">Email</th>
                     <th scope="col">Phone Number</th>
                     <th scope="col">Address</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach( $user as $key => $user )
                  <tr>
                     <td scope="row">
                        <p><input type="checkbox" name="student_id[{{$key+1}}]" value="{{ $user->id }}"/></p>
                     </td>
                     <td scope="row">{{$key+1}}</td>
                     <td scope="row">
                        <?php $image= $user->image;?>
                        @if ($image ==Null)
                        <img src="{{ asset('/public/userImages/avatar-5.jpg')}}" class="table-avatar communication-avatar" alt="User Image" style="width:21%;">
                        @else
                        <img class="table-avatar communication-avatar" src="{{ asset('/public/userImages/'.$user->image )}}" alt="User Avatar" style="width:21%;">
                        @endif
                     </td>
                     <td scope="row">{{ $user->first_name }} {{ $user->last_name }}</td>
                     <td scope="row">{{ $user->email }}</td>
                     <td scope="row">{{ $user->phone_number }}</td>
                     <td scope="row">{{ $user->address }}</td>
                  </tr>
                  @endforeach
               </tbody>
               <tr>
                  <th scope="col">
                     <p><input onClick="setAllCheckboxes('actors',this);" type="checkbox" style="margin-right: 8px;"/>{{ __('trans.All_of_them')}}</p>
                  </th>
                  <th scope="col">#</th>
                  <th scope="col">Image</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone Number</th>
                  <th scope="col">Address</th>
               </tr>
               <tr>
                  <th><button type="submit" class="btn btn-primary" >{{ __('trans.Mark_Attendence')}}</button></th>
               </tr>
               </tfoot>
            </table>
         </div>
   </form>
   </div>
   <!-- /.box-body -->
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
   
     function showData() {
     //document.getElementById("branch_select").removeAttribute("selected");
    var firstP = document.getElementById('branch_id');
    
    var star=firstP.value;
       all_course_branch(star);
   
   
     }
   
     function setAllCheckboxes(divId, sourceCheckbox,) {
   
   
             divElement = document.getElementById(divId);
         inputElements = divElement.getElementsByTagName('input');
         for (i = 0; i < inputElements.length; i++) {
             if (inputElements[i].type != 'checkbox')
                 continue;
             inputElements[i].checked = sourceCheckbox.checked;
         }
   
   }
</script>
@endsection
