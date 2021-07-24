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
      <!--<a href="{{ route('package.create') }}"  class="btn btn-primary pull-right "><i class="fa fa-plus-circle " style="margin-right: 8%;"></i>     {{ __('trans.Add_Package') }}  </a>-->
      <button type="button" class="btn btn-primary btn-demo pull-right button_slide slide_right" data-toggle="modal" data-target="#myModal2" style="width: 135px;">
      <i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Package')}}
      </button>
      <h5> {{ __('trans.All_Packages') }}</h5>
   </div>
   <!-- /.box-header -->
   <div class="table-responsive">
      <table id="advance-1" class="display">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col">{{ __('trans.Package_Name') }}</th>
               <th scope="col"> {{ __('trans.Theoratical_houres') }}</th>
               <th scope="col">{{ __('trans.Practical_houres') }}</th>
               <th scope="col">{{ __('trans.Class_Duration') }}</th>
               <th scope="col">{{ __('trans.Exam_Attempts') }}</th>
               <th scope="col">{{ __('trans.Price') }}</th>
               <th scope="col">{{ __('trans.Branch_Name') }}</th>
               <th scope="col">{{ __('trans.Status') }}</th>
               <th scope="col">{{ __('trans.Action') }}</th>
            </tr>
         </thead>
         <tbody>
            @foreach( $package as $key => $package )
            <tr>
               <td scope="row">{{$key+1}}</td>
               <td scope="row">{{$package->detail}}</td>
               <td scope="row">{{$package->theory_hours}}</td>
               <td scope="row">{{$package->practical_hours}}</td>
               <td scope="row">{{$package->duration}}</td>
               <td scope="row">{{$package->exam_attempt}}</td>
               <td scope="row">{{ App\Models\setting::compnay_currency()." ".$package->price}}</td>
               <td scope="row">{{!empty($package->package_branch->name) ?  $package->package_branch->name:''}}</td>
               <td scope="row">
                  <label class="switch">
                  <input type="checkbox" onclick="checkFluency({{ $package->id }})"  id="{{ $package->id  }}"
                  @if($package->status=="active")         
                  checked
                  @endif
                  >
                  <span class="slider round"></span>
                  </label>
               </td>
               <td scope="row" >
                  <button class="btn" style="background: transparent;"  onclick="edit_package({{$package->id}})" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></button>
                  <!--<a href="{{url('package/'.$package->id.'/edit')}}" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></a>-->
                  {{--  <a href="" style=""><i class="fa fa-eye" style="font-size: 16px; margin-left: 10%;"></i></a>  --}}
                  <form  action="{{url('package',$package->id)}}" method="POST" style="float: right ;margin-right: 6%;margin-top: 7%;">
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
               <th scope="col">{{ __('trans.Package_Name') }}</th>
               <th scope="col"> {{ __('trans.Theoratical_houres') }}</th>
               <th scope="col">{{ __('trans.Practical_houres') }}</th>
               <th scope="col">{{ __('trans.Class_Duration') }}</th>
               <th scope="col">{{ __('trans.Exam_Attempts') }}</th>
               <th scope="col">{{ __('trans.Price') }}</th>
               <th scope="col">{{ __('trans.Branch_Name') }}</th>
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
               <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Add_Package') }}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" action="{{ route('package.store') }}" enctype="multipart/form-data" >
                  @csrf
                  <div class="form-group">
                     <label for="class_name" class="col-form-label text-md-right">{{ __('trans.Package_Name') }}</label>
                     <input id="detail" type="text" class="form-control @error('detail') is-invalid @enderror" name="detail" value="{{ old('detail') }}" required autocomplete="detail" autofocus>
                     @error('detail')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="class_duration" class="col-form-label text-md-right">{{ __('Package Duration') }}</label>
                     <input id="duration" type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" required autocomplete="duration">
                     @error('duration')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="no_of_theoratical" class=" col-form-label text-md-right">{{ __('trans.Theoratical_houres') }}</label>
                     <input id="theory_hours" type="Number" class="form-control @error('theory_hours') is-invalid @enderror" name="theory_hours" value="{{ old('theory_hours') }}" required autocomplete="theory_hours" >
                     @error('theory_hours')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="no_of_practical" class="col-form-label text-md-right">{{ __('trans.Practical_houres') }}</label>
                     <input id="practical_hours" type="Number" class="form-control" name="practical_hours" value="{{ old('practical_hours') }}" required autocomplete="practical_hours">
                     @error('practical_hours')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="no_of_practical" class="col-form-label text-md-right">{{ __('trans.Exam_Attempts') }}</label>
                     <input id="exam_attempt" type="Number" class="form-control" name="exam_attempt" value="{{ old('exam_attempt') }}" required autocomplete="exam_attempt">
                     @error('exam_attempt')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="no_of_practical" class="col-form-label text-md-right">{{ __('trans.Price') }}</label>
                     <input id="price" type="Number" class="form-control" name="price" value="{{ old('price') }}" required autocomplete="price">
                     @error('price')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="branch_id" class="col-md-4 col-form-label text-md-right">{{ __('trans.Brach_Name') }}</label>
                     <select class="form-control" id="branch_id" name="branch_id">
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
            <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Update_package') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="/package/" enctype="multipart/form-data" id="branchform">
               @csrf
               {{ method_field('PUT') }}
               <div class="form-group">
                  <label for="class_name" class="col-form-label text-md-right">{{ __('trans.Package_Name') }}</label>
                  <input id="detail" type="text" class="form-control @error('detail') is-invalid @enderror" name="detail" value="{{ old('detail') }}" required autocomplete="detail" autofocus>
                  @error('detail')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="class_duration" class="col-form-label text-md-right">{{ __('Package Duration') }}</label>
                  <input id="duration" type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" required autocomplete="duration">
                  @error('duration')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="no_of_theoratical" class=" col-form-label text-md-right">{{ __('trans.Theoratical_houres') }}</label>
                  <input id="theory_hours" type="Number" class="form-control @error('theory_hours') is-invalid @enderror" name="theory_hours" value="{{ old('theory_hours') }}" required autocomplete="theory_hours" >
                  @error('theory_hours')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="no_of_practical" class="col-form-label text-md-right">{{ __('trans.Practical_houres') }}</label>
                  <input id="practical_hours" type="Number" class="form-control" name="practical_hours" value="{{ old('practical_hours') }}" required autocomplete="practical_hours">
                  @error('practical_hours')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="no_of_practical" class="col-form-label text-md-right">{{ __('trans.Exam_Attempts') }}</label>
                  <input id="exam_attempt" type="Number" class="form-control" name="exam_attempt" value="{{ old('exam_attempt') }}" required autocomplete="exam_attempt">
                  @error('exam_attempt')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="no_of_practical" class="col-form-label text-md-right">{{ __('trans.Price') }}</label>
                  <input id="price" type="Number" class="form-control" name="price" value="{{ old('price') }}" required autocomplete="price">
                  @error('price')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="branch_id" class="col-md-4 col-form-label text-md-right">{{ __('trans.Brach_Name') }}</label>
                  <select class="form-control" id="branch_id" name="branch_id">
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
      
       
                $('.formId').click(function(event) {
          event.preventDefault();
          var form = $(this).parent();
      
            $.confirm({
            columnClass: 'col-md-4 col-md-offset-4',
            theme: 'dark',
            title: 'Delete',
            content: 'Are Your Sure To Delete Package Data Related To This Package Will Also Delete. Data Will Not Recoverd ?',
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
      
      
      function edit_package(id){
          
      
         // var token = $("meta[name='csrf-token']").attr("content");
         $("#myModal3").modal('show');
       <?php 
         $branch = DB::table('branches')->get(); 
         
            ?>
             
      
       
          $.ajax(
          {
              
              url: "package/"+id+"/edit",
              type: 'GET',
               dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                  $('#branchform #branch_id').empty();
                    //console.log(response['data']);
              //   for(var i=0; i<1; i++){
                      // var id = response['data'].id;
                       var detail = response['data'].detail;
                      var duration = response['data'].duration;
             
                      var theory_hours = response['data'].theory_hours;
                       var practical_hours = response['data'].practical_hours;
                         var exam_attempt = response['data'].exam_attempt;
                           var price = response['data'].price;
                           var branch_id = response['data'].branch_id;
                           var name = response['data'].name;
                           
              //   }
                   
      
              $("#branchform").attr('action',$("#branchform").attr('action')+id);
              $('#branchform #detail').val(detail);
              $('#branchform #duration').val(duration);
              $('#branchform #theory_hours').val(theory_hours);
              $('#branchform #practical_hours').val(practical_hours);
              $('#branchform #exam_attempt').val(exam_attempt);
              $('#branchform #price').val(price);
                               
                  
              var tr_str = '<option value="'+branch_id+'" selected>'+name+'</option><?php   foreach ($branch as $branch){?> <option value="<?php echo $branch->id ?>" ><?php echo $branch->name ?></option><?php } ?>'
                          $("#branchform #branch_id").append(tr_str);
                          
                          
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
              url: "package_change_status/"+id,
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
   </script>        
</div>
@endsection
