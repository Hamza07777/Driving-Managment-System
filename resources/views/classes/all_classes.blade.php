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
      <!--<a href="{{ route('classes.create') }}"  class="btn btn-primary pull-right "><i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Class') }}</a>-->
      <button type="button" class="btn btn-primary btn-demo pull-right button_slide slide_right" data-toggle="modal" data-target="#myModal2" style="width: 131px;">
      <i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Class')}}
      </button>
      <h5>{{ __('trans.All_classes') }}</h5>
   </div>
   <!-- /.box-header -->
   <div class="table-responsive">
      <table id="advance-1" class="display">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col">{{ __('trans.Class_Name') }}</th>
               <th scope="col">{{ __('trans.Class_Duration') }}</th>
               <th scope="col">{{ __('trans.No_of_Theoratical') }}</th>
               <th scope="col">{{ __('trans.No_of_Practical') }}</th>
               <th scope="col">{{ __('trans.Branch_Name') }}</th>
               <th scope="col">{{ __('trans.Status') }}</th>
               <th scope="col">{{ __('trans.Action') }}</th>
            </tr>
         </thead>
         <tbody>
            @foreach( $classes as $key => $classes )
            <tr>
               <td scope="row">{{$key+1}}</td>
               <td scope="row">{{$classes->class_name}}</td>
               <td scope="row">{{$classes->class_duration}}</td>
               <td scope="row">{{$classes->no_of_theoratical}}</td>
               <td scope="row">{{$classes->no_of_practical}}</td>
               @if(!empty($classes->class_branch->name))         
               <td scope="row">{{$classes->class_branch->name}}</td>
               @else
               <td>  </td>
               @endif
               <td scope="row">
                  <label class="switch">
                  <input type="checkbox" onclick="checkFluency({{ $classes->id }})"  id="{{ $classes->id  }}"
                  @if($classes->status=="active")         
                  checked
                  @endif
                  >
                  <span class="slider round"></span>
                  </label>
               </td>
               <td scope="row" >
                  <!--<a href="{{url('classes/'.$classes->id.'/edit')}}" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></a>-->
                  <!--{{--  <a href="" style=""><i class="fa fa-eye" style="font-size: 16px; margin-left: 10%;"></i></a>  --}}-->
                  <button class="btn" style="background: transparent;"  onclick="edit_branch({{$classes->id}})" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></button>
                  <form action="{{url('classes',$classes->id)}}" method="POST" style="float: right ;margin-right: 15%;margin-top: 6%;">
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
               <th scope="col">{{ __('trans.Class_Name') }}</th>
               <th scope="col">{{ __('trans.Class_Duration') }}</th>
               <th scope="col">{{ __('trans.No_of_Theoratical') }}</th>
               <th scope="col">{{ __('trans.No_of_Practical') }}</th>
               <th scope="col">{{ __('trans.Branch_Name') }}</th>
               <th scope="col">{{ __('trans.Status') }}</th>
               <th scope="col">{{ __('trans.Action') }}</th>
            </tr>
         </tfoot>
      </table>
   </div>
   <!-- /.box-body -->
</div>
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Add_Class') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('classes.store') }}" enctype="multipart/form-data" >
               @csrf
               <div class="form-group">
                  <label for="class_name" class="col-form-label text-md-right">{{ __('trans.Class_Name') }}</label>
                  <input id="class_name" type="text" class="form-control @error('class_name') is-invalid @enderror" name="class_name" value="{{ old('class_name') }}" required autocomplete="class_name" autofocus>
                  @error('class_name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="class_duration" class="col-form-label text-md-right">{{ __('trans.Class_Duration') }}</label>
                  <input id="class_duration" type="text" class="form-control @error('class_duration') is-invalid @enderror" name="class_duration" value="{{ old('class_duration') }}" required autocomplete="class_duration">
                  @error('class_duration')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="no_of_theoratical" class=" col-form-label text-md-right">{{ __('trans.No_of_Theoratical') }}</label>
                  <input id="no_of_theoratical" type="text" class="form-control @error('no_of_theoratical') is-invalid @enderror" name="no_of_theoratical" value="{{ old('no_of_theoratical') }}" required autocomplete="no_of_theoratical" >
                  @error('no_of_theoratical')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="no_of_practical" class="col-form-label text-md-right">{{ __('trans.No_of_Practical') }}</label>
                  <input id="no_of_practical" type="text" class="form-control" name="no_of_practical" value="{{ old('no_of_practical') }}" required autocomplete="no_of_practical">
                  @error('no_of_practical')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="branch_id" class="col-form-label text-md-right">{{ __('trans.Brach_Name') }}</label>
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
          <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Update_Class') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
       </div>
       <div class="modal-body">
          <form method="POST" action="/classes/" enctype="multipart/form-data" id="branchform">
             @csrf
             {{ method_field('PUT') }}
             <input id="branch_idd" type="hidden"  name="branch_idd" value="" >
             <div class="form-group">
                <label for="class_name" class="col-form-label text-md-right">{{ __('trans.Class_Name') }}</label>
                <input id="class_name" type="text" class="form-control @error('class_name') is-invalid @enderror" name="class_name" value="{{ old('class_name') }}" required autocomplete="class_name" autofocus>
                @error('class_name')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
             </div>
             <div class="form-group">
                <label for="class_duration" class="col-form-label text-md-right">{{ __('trans.Class_Duration') }}</label>
                <input id="class_duration" type="text" class="form-control @error('class_duration') is-invalid @enderror" name="class_duration" value="{{ old('class_duration') }}" required autocomplete="class_duration">
                @error('class_duration')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
             </div>
             <div class="form-group">
                <label for="no_of_theoratical" class=" col-form-label text-md-right">{{ __('trans.No_of_Theoratical') }}</label>
                <input id="no_of_theoratical" type="text" class="form-control @error('no_of_theoratical') is-invalid @enderror" name="no_of_theoratical" value="{{ old('no_of_theoratical') }}" required autocomplete="no_of_theoratical" >
                @error('no_of_theoratical')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
             </div>
             <div class="form-group">
                <label for="no_of_practical" class="col-form-label text-md-right">{{ __('trans.No_of_Practical') }}</label>
                <input id="no_of_practical" type="text" class="form-control" name="no_of_practical" value="{{ old('no_of_practical') }}" required autocomplete="no_of_practical">
                @error('no_of_practical')
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

//  document.onsubmit=function(){
//           return confirm('Are Your Sure to Delete Class Data Related To This Class Will Also  Delete. Data Will Not Recoverd ?');
//       }
       
       
             $('.formId').click(function(event) {
    event.preventDefault();
    var form = $(this).parent();

      $.confirm({
      columnClass: 'col-md-4 col-md-offset-4',
      theme: 'dark',
      title: 'Delete',
      content: 'Are Your Sure To Delete Class Data Related To This Class Will Also Delete. Data Will Not Recoverd ?',
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


function edit_branch(id){
    

   // var token = $("meta[name='csrf-token']").attr("content");
   $("#myModal3").modal('show');
 <?php 
   
      $branch = DB::table('branches')->get(); 
  
         ?>

    $.ajax(
    {
        
        url: "classes/"+id+"/edit",
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
                 var class_name = response['data'].class_name;
                var class_duration = response['data'].class_duration;
       
                var no_of_theoratical = response['data'].no_of_theoratical;
                 var no_of_practical = response['data'].no_of_practical;
                   var branch_id = response['data'].branch_id;
                     var name = response['data'].name;
                      document.cookie = "branch_id =branch_id";
        //   }
             

        $("#branchform").attr('action',$("#branchform").attr('action')+id);
        $('#branchform #class_name').val(class_name);
        $('#branchform #class_duration').val(class_duration);
        $('#branchform #no_of_theoratical').val(no_of_theoratical);
        $('#branchform #no_of_practical').val(no_of_practical);
                         
         
     
        var tr_str = '<option value="'+branch_id+'" selected>'+name+'</option><?php   foreach ($branch as $branch){?> <option value="<?php echo $branch->id ?>"  ><?php echo $branch->name ?></option><?php } ?>'
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
        url: "class_change_status/"+id,
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

