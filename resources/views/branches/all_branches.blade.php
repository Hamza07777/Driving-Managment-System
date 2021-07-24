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
   <button type="button" class="btn btn-primary btn-demo pull-right button_slide slide_right" data-toggle="modal" data-target="#myModal2" style="width: 141px;">
   <i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Branch')}}
   </button>
   <h5>{{ __('trans.All_Branches')}}</h5>
</div>
<div class="table-responsive">
   <table id="advance-1" class="display">
      <thead>
         <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('trans.Name')}}</th>
            <th scope="col">{{ __('trans.Email')}}</th>
            <th scope="col">{{ __('trans.Location')}}</th>
            <th scope="col">{{ __('trans.Status')}}</th>
            <th scope="col">{{ __('trans.Phone_Number')}}</th>
            <th scope="col" style="width: 62.1562px;">{{ __('trans.Action') }}</th>
         </tr>
      </thead>
      <tbody>
         @foreach( $branch as $key => $branch )
         <tr>
            <td scope="row"> {{$key+1}}</td>
            <td scope="row">{{$branch->name}}</td>
            <td scope="row">{{$branch->email}}</td>
            <td scope="row">{{$branch->location}}</td>
            <td scope="row">
               <label class="switch">
               <input type="checkbox" onclick="checkFluency({{ $branch->id }})"  id="{{ $branch->id  }}"
               @if($branch->status=="active")         
               checked
               @endif
               >
               <span class="slider round"></span>
               </label>
            </td>
            <td scope="row">{{$branch->phone_number}}</td>
            <td scope="row" >
               <button class="btn" style="background: transparent;"  onclick="edit_branch({{$branch->id}})" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></button>
               <form action="{{url('branch/'.$branch->id)}}" method="POST" style="float: right ;margin-right: 24%;margin-top: 6%;">
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
            <th scope="col">{{ __('trans.Email')}}</th>
            <th scope="col">{{ __('trans.Location')}}</th>
            <th scope="col">{{ __('trans.Status')}}</th>
            <th scope="col">{{ __('trans.Phone_Number')}}</th>
            <th scope="col">{{ __('trans.Action') }}</th>
         </tr>
      </tfoot>
   </table>
</div>
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Register_Branch')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('branch.store')  }}" enctype="multipart/form-data" >
               @csrf
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('trans.Brach_Name')}}</label>
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                  <span class="invalid-feedback" role="alert-danger">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('trans.Email')}}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                  @error('email')
                  <span class="invalid-feedback" role="alert-danger">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('trans.Location')}}</label>
                  <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location" >
                  @error('location')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('trans.Phone_Number')}}</label>
                  <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">
                  @error('phone_number')
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
            <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Update_Branch') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="/branch/" enctype="multipart/form-data" id="branchform">
               @csrf
               {{ method_field('PUT') }}
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('trans.Brach_Name')}}</label>
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                  <span class="invalid-feedback" role="alert-danger">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('trans.Email')}}</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                  @error('email')
                  <span class="invalid-feedback" role="alert-danger">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('trans.Location')}}</label>
                  <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location" >
                  @error('location')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('trans.Phone_Number')}}</label>
                  <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">
                  @error('phone_number')
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
            content: 'Are Your Sure To Delete Branch, Data Related To This Branch Will Also  Delete. Data Will Not Recoverd  ?',
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
              url: "branch/"+id+"/edit",
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
                       var name = response['data'].name;
                      var email = response['data'].email;
             
                      var location = response['data'].location;
                       var phone_number = response['data'].phone_number;
                        var status = response['data'].status;
              //   }
              $("#branchform").attr('action',$("#branchform").attr('action')+id);
              $('#branchform #name').val(name);
              $('#branchform #email').val(email);
              $('#branchform #location').val(location);
              $('#branchform #phone_number').val(phone_number);
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
   </script>
</div>
@endsection
