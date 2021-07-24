@extends('../layouts.admin_app')
@section('content')
<div class="box">
<style>
   /*  div.dataTables_wrapper div.dataTables_filter {*/
   /*    text-align: right;*/
   /*    display: none;*/
   /*}*/
</style>
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
   <!--<a href="{{ route('branch.create') }}"  class="btn btn-primary pull-right"><i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Branch')}}</a>-->
   <button type="button" class="btn btn-primary btn-demo pull-right button_slide slide_right" data-toggle="modal" data-target="#myModal2" style="width: 202px;">
   <i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Attendence_Status')}}
   </button>
   <h5>{{ __('trans.Attendence_Status')}}</h5>
   <!--               <div class="form-group" style="width: 24%;">-->
   <!-- <input type="text" name="search" id="search" class="form-control" placeholder="Search Branch Data" />-->
   <!--</div>-->
</div>
<!-- /.box-header -->
<div class="table-responsive">
   <table id="advance-1" class="display">
      <thead>
         <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('trans.Name')}}</th>
            <th scope="col">{{ __('trans.Status')}}</th>
            <th scope="col" style="width: 62.1562px;">{{ __('trans.Action') }}</th>
         </tr>
      </thead>
      <tbody>
         @foreach( $branch as $key => $branch )
         <tr>
            <td scope="row"> {{$key+1}}</td>
            <td scope="row">{{$branch->status}}</td>
            <td scope="row">
               <label class="switch">
               <input type="checkbox" onclick="checkFluency({{ $branch->id }})"  id="{{ $branch->id  }}"
               @if($branch->att_status=="active")         
               checked
               @endif
               >
               <span class="slider round"></span>
               </label>
            </td>
            <td scope="row" >
               <button class="btn" style="background: transparent;"  onclick="edit_branch({{$branch->id}})" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></button>
               {{--  <a href="" style=""><i class="fa fa-eye" style="font-size: 16px; margin-left: 10%;"></i></a>  --}}
               <!--<a href="{{url('branch/'.$branch->id)}}" class="btn btn-danger btn-sm"-->
               <!--                   data-tr="$branch->id"-->
               <!--                   data-toggle="confirmation"-->
               <!--                   data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"-->
               <!--                   data-btn-ok-class="btn btn-sm btn-danger"-->
               <!--                   data-btn-cancel-label="Cancel"-->
               <!--                   data-btn-cancel-icon="fa fa-chevron-circle-left"-->
               <!--                   data-btn-cancel-class="btn btn-sm btn-default"-->
               <!--                   data-title="Are you sure you want to delete ?"-->
               <!--                   data-placement="left" data-singleton="true">-->
               <!--                    Delete-->
               <!--                </a>-->
               <form action="{{url('attendence_status/'.$branch->id)}}" method="POST" style="float: right ;margin-right: 24%;margin-top: 6%;">
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
            <th scope="col">{{ __('trans.Name')}}</th>
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
            <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Add_Attendence_Status')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('attendence_status.store')  }}" enctype="multipart/form-data" >
               @csrf
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('trans.Attendence_Status')}}</label>
                  <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>
                  @error('status')
                  <span class="invalid-feedback" role="alert-danger">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary button_slide slide_right">  {{ __('trans.Add_Attendence_Status')}}</button>
         </div>
         </form>
      </div>
   </div>
</div>
<div class="modal right fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Update_Attendence_Status') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="/attendence_status/" enctype="multipart/form-data" id="branchform">
               @csrf
               {{ method_field('PUT') }}
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('trans.Attendence_Status')}}</label>
                  <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>
                  @error('status')
                  <span class="invalid-feedback" role="alert-danger">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary button_slide slide_right">  {{ __('trans.Update_Attendence_Status') }}</button>
         </div>
         </form>
      </div>
   </div>
   <script type='text/javascript'>
      $(document).ready(function(){
          
          
          
         
          // Fetch all records
        $.ajaxSetup({
                  headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
              });
                 
            
      });
      
      //  document.onsubmit=function(){
      //           return confirm('Are Your Sure to Delete Branch, Data Related To This Branch Will Also  Delete. Data Will Not Recoverd  ?');
      //       }
             
             
             
             
                          $('.formId').click(function(event) {
          event.preventDefault();
          var form = $(this).parent();
      
            $.confirm({
            columnClass: 'col-md-4 col-md-offset-4',
            theme: 'dark',
            title: 'Delete',
            content: 'Are Your Sure To Delete Attendance Status, Data Related To This Attendance Status Will Also  Delete. Data Will Not Recoverd  ?',
          buttons: {
              Delete: function () {
                  form.submit();
              },
              cancel: function () {
               
              },
          }
          });
        });
      function edit_branch(id){
          
      
         // var token = $("meta[name='csrf-token']").attr("content");
         $("#myModal3").modal('show');
         
       
          $.ajax(
          {
              url: "attendence_status/"+id+"/edit",
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
                       var status = response['data'].status;
              //   }
              $("#branchform").attr('action',$("#branchform").attr('action')+id);
              $('#branchform #status').val(status);
               // console.log(name);
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
          });
          // fetchRecords();
         
      }
      function Delete_branch(id){
        //  var id = $(this).data("id");
        //  alert(id);
          var token = $("meta[name='csrf-token']").attr("content");
          if(!confirm("Do you really want to do this?")) {
             return false;
           }
      
          e.preventDefault();
          $.ajax(
          {
              url: "branch/"+id,
              type: 'DELETE',
              data: {
                  "id": id,
                  "_token": token,
              },
              success: function (){
                 
                  console.log("it Works");
              }
              
          });
           fetchRecords();
         
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
              url: "branch_change_status/"+id,
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
      
      
        $(function(){
      
              // add multiple select / deselect functionality
              $("#checkAll").click(function (e) {
              //    e.preventDefault();
                  $('.chk-ani').attr('checked', this.checked);
                  $('#deleteRecordId').css({ "display": "block"});
                  if($(".chk-ani:checked").length == 0){
                      $('#deleteRecordId').css({ "display": "none"})
                  }
                
              });
      
              // if all checkbox are selected, check the selectall checkbox
              // and viceversa
              $(".chk-ani").click(function(){
      
                  if($(".chk-ani").length == $(".chk-ani:checked").length) {
                      $("#checkAll").attr("checked", "checked");
                      
                  } else {
                      
                      $("#checkAll").removeAttr("checked");
                      
                  }
      
              });
              });
              
              
      function checkFluency(id){
          // var checkbox = document.getElementById(id);
          // if (checkbox.checked != false) {
      	   // alert("Checkbox checked"+ id)
          // }else{
      	   // alert("Not Checked"+ id)
          // }
          
          
          
          
          
          $.ajax(
          {
              url: "attendence_change_status/"+id,
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
