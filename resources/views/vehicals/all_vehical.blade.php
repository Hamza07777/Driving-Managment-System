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
   <!--<a href="{{ route('vehical.create') }}"  class="btn btn-primary pull-right "><i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Vehical')}}</a>-->
   <button type="button" class="btn btn-primary btn-demo pull-right button_slide slide_right" data-toggle="modal" data-target="#myModal2" style="width: 141px;">
   <i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Vehical')}}
   </button>
   <h5>{{ __('trans.All_Vehical')}}</h5>
</div>
<!-- /.box-header -->
<div class="table-responsive">
   <table id="advance-1" class="display">
      <thead>
         <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('trans.Car_No')}}</th>
            <th scope="col">{{ __('trans.Number_Plate')}}</th>
            <th scope="col">{{ __('trans.Manufacturing_Company')}}</th>
            <th scope="col">{{ __('trans.Vehical_Name')}}</th>
            <th scope="col">{{ __('trans.Model_Year')}}</th>
            <th scope="col">{{ __('trans.Branch_Name')}}</th>
            <th scope="col">{{ __('trans.Instructor_Name')}}</th>
            <th scope="col">{{ __('trans.Image')}}</th>
            <th scope="col">{{ __('trans.Status')}}</th>
            <th scope="col">{{ __('trans.Action') }}</th>
         </tr>
      </thead>
      <tbody>
         @foreach( $vehical as $key => $vehical )
         <tr>
            <td scope="row">{{$key+1}}</td>
            <td scope="row">{{$vehical->car_no}}</td>
            <td scope="row">{{$vehical->number_plate}}</td>
            <td scope="row">{{$vehical->manufacturing_company}}</td>
            <td scope="row">{{$vehical->car_name}}</td>
            <td scope="row">{{$vehical->model_year}}</td>
            <td scope="row">{{$vehical->vehical_branch->name}}</td>
            <td scope="row">{{$vehical->vehical_instructor->first_name}}</td>
            <td scope="row">
               <img src="{{ asset('/public/vehicalimage/'.$vehical->image )}}" class="table-avatar communication-avatar" style="width: 32px">
            </td>
            <td scope="row">
               <label class="switch">
               <input type="checkbox" onclick="checkFluency({{ $vehical->id }})"  id="{{ $vehical->id  }}"
               @if($vehical->status=="active")         
               checked
               @endif
               >
               <span class="slider round"></span>
               </label>
            </td>
            <td scope="row" >
               <button class="btn" style="background: transparent;"  onclick="edit_vehical({{$vehical->id}})" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></button>
               <!--<a href="{{url('vehical/'.$vehical->id.'/edit')}}" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></a>-->
               <!--{{--  <a href="" style=""><i class="fa fa-eye" style="font-size: 16px; margin-left: 10%;"></i></a>  --}}-->
               <form action="{{url('vehical',$vehical->id)}}" method="POST" style="float: right ;margin-right: 6%;margin-top: 7%;">
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
            <th scope="col">{{ __('trans.Car_No')}}</th>
            <th scope="col">{{ __('trans.Number_Plate')}}</th>
            <th scope="col">{{ __('trans.Manufacturing_Company')}}</th>
            <th scope="col">{{ __('trans.Vehical_Name')}}</th>
            <th scope="col">{{ __('trans.Model_Year')}}</th>
            <th scope="col">{{ __('trans.Branch_Name')}}</th>
            <th scope="col">{{ __('trans.Instructor_Name')}}</th>
            <th scope="col">{{ __('trans.Image')}}</th>
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
            <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Add_Vehical')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('vehical.store')  }}" enctype="multipart/form-data" >
               @csrf
               <div class="form-group">
                  <label for="car_no" class=" col-form-label text-md-right">{{ __('trans.Car_No') }}</label>
                  <input id="car_no" type="text" class="form-control @error('car_no') is-invalid @enderror" name="car_no" value="{{ old('car_no') }}" required autocomplete="car_no" autofocus>
                  @error('car_no')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="number_plate" class=" col-form-label text-md-right">{{ __('trans.Number_Plate') }}</label>
                  <input id="number_plate" type="number_plate" class="form-control @error('number_plate') is-invalid @enderror" name="number_plate" value="{{ old('number_plate') }}" required autocomplete="number_plate">
                  @error('number_plate')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="manufacturing_company" class=" col-form-label text-md-right">{{ __('trans.Manufacturing_Company') }}</label>
                  <input id="manufacturing_company" type="text" class="form-control @error('manufacturing_company') is-invalid @enderror" name="manufacturing_company" value="{{ old('manufacturing_company') }}" required autocomplete="manufacturing_company" >
                  @error('manufacturing_company')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="car_name" class=" col-form-label text-md-right">{{ __('trans.Vehical_Name') }}</label>
                  <input id="car_name" type="text" class="form-control" name="car_name" value="{{ old('car_name') }}" required autocomplete="car_name">
                  @error('car_name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="model_year" class=" col-form-label text-md-right">{{ __('trans.Model_Year') }}</label>
                  <input id="model_year" type="text" class="form-control" name="model_year" value="{{ old('model_year') }}" required autocomplete="model_year">
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
                  <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Instructor_Name') }}</label>
                  <select class="form-control" id="instructor_id" name="instructor_id">
                  </select>
               </div>
               <div class="form-group">
                  <label for="image" class=" col-form-label text-md-right">{{ __('trans.Image') }}</label>
                  <input id="image" class="p-0 form-control @error('image') is-invalid @enderror" required name="image" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('image') }}" required style="height: 48px;background: transparent;border: none;"/>
                  @error('image')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
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
<div class="modal right fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">{{ __('trans.Update_Vehical') }}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="/vehical/" enctype="multipart/form-data" id="branchform">
               @csrf
               {{ method_field('PUT') }}
               <div class="form-group">
                  <label for="car_no" class=" col-form-label text-md-right">{{ __('trans.Car_No') }}</label>
                  <input id="car_no" type="text" class="form-control @error('car_no') is-invalid @enderror" name="car_no" value="{{ old('car_no') }}" required autocomplete="car_no" autofocus>
                  @error('car_no')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="number_plate" class=" col-form-label text-md-right">{{ __('trans.Number_Plate') }}</label>
                  <input id="number_plate" type="number_plate" class="form-control @error('number_plate') is-invalid @enderror" name="number_plate" value="{{ old('number_plate') }}" required autocomplete="number_plate">
                  @error('number_plate')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="manufacturing_company" class=" col-form-label text-md-right">{{ __('trans.Manufacturing_Company') }}</label>
                  <input id="manufacturing_company" type="text" class="form-control @error('manufacturing_company') is-invalid @enderror" name="manufacturing_company" value="{{ old('manufacturing_company') }}" required autocomplete="manufacturing_company" >
                  @error('manufacturing_company')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="car_name" class=" col-form-label text-md-right">{{ __('trans.Vehical_Name') }}</label>
                  <input id="car_name" type="text" class="form-control" name="car_name" value="{{ old('car_name') }}" required autocomplete="car_name">
                  @error('car_name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="model_year" class=" col-form-label text-md-right">{{ __('trans.Model_Year') }}</label>
                  <input id="model_year" type="text" class="form-control" name="model_year" value="{{ old('model_year') }}" required autocomplete="model_year">
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
                  <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Instructor_Name') }}</label>
                  <select class="form-control" id="instructor_id" name="instructor_id">
                  </select>
               </div>
               <div class="form-group">
                  <label for="image" class=" col-form-label text-md-right">{{ __('trans.Image') }}</label>
                  <input id="image" class="p-0 form-control @error('image') is-invalid @enderror" name="image" type="file" accept="image/jpeg, image/png, application/pdf" value="{{ old('image') }}"  style="height: 48px;background: transparent;border: none;"/>
                  @error('image')
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
      
      //  document.onsubmit=function(){
      //           return confirm('Are Your Sure to Delete Vehical, Data Related To This Vehical Will Also  Delete. Data Will Not Recoverd ?');
      //       }
             
             
                          $('.formId').click(function(event) {
          event.preventDefault();
          var form = $(this).parent();
      
            $.confirm({
            columnClass: 'col-md-4 col-md-offset-4',
            theme: 'dark',
            title: 'Delete',
            content: 'Are Your Sure To Delete Vehical, Data Related To This Vehical Will Also Delete. Data Will Not Recoverd ?',
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
                 console.log(response);
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
                 console.log(response);
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
      
      function edit_vehical(id){
          
      
         // var token = $("meta[name='csrf-token']").attr("content");
         $("#myModal3").modal('show');
         
        <?php 
         $branch = DB::table('branches')->get(); 
         
            ?>
          $.ajax(
          {
              url: "vehical/"+id+"/edit",
              type: 'GET',
               dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                   //  console.log(response['data'])
              //   for(var i=0; i<1; i++){
                      // var id = response['data'].id;
                       var car_no = response['data'].car_no;
                      var number_plate = response['data'].number_plate;
             
                      var manufacturing_company = response['data'].manufacturing_company;
                       var car_name = response['data'].car_name;
                         var branch_id = response['data'].branch_id;
                           var instructor_id = response['data'].instructor_id;
                             var branch_name = response['data'].branch_name;
                           var instructor_first_name = response['data'].first_name;
                            var instructor_last_name = response['data'].last_name;
                           var model_year = response['data'].model_year;
              //   }
              $("#branchform").attr('action',$("#branchform").attr('action')+id);
              $('#branchform #car_no').val(car_no);
              $('#branchform #number_plate').val(number_plate);
              $('#branchform #manufacturing_company').val(manufacturing_company);
              $('#branchform #car_name').val(car_name);
              $('#branchform #model_year').val(model_year);
      
              var tr_str = '<option id="branch_select" value="'+branch_id+'" selected>'+branch_name+'</option><?php   foreach ($branch as $branch){  echo $branch->id  ?> <option value="<?php echo $branch->id ?>" ><?php echo $branch->name ?></option><?php } ?>';
              var tr_str1 = '<option value="'+instructor_id+'" selected>'+instructor_first_name+' '+ instructor_last_name +'</option>'
                          $("#branchform #branch_idd").append(tr_str);
                           $("#branchform #instructor_id").append(tr_str1);
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
              url: "vehical_change_status/"+id,
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
      
          }
           function showData() {
          //document.getElementById("branch_select").removeAttribute("selected");
         var firstP = document.getElementById('branch_idd');
         
         var star=firstP.value;
        // alert(star);
         all_instructor_branch(star); 
      
          }
   </script>           
</div>
@endsection
