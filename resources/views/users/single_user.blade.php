@extends('layouts.admin_app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      User Profile
   </h1>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-md-8">
         <div class="box">
            <div class="box-header">
               <a href="#"  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary pull-right"><i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Note')}}</a>
               <h3>{{ __('trans.Notes')}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="width: 22%;">{{ __('trans.Note_to')}}</th>
                        <th scope="col" style="width: 16%;">{{ __('trans.Created_At')}}</th>
                        <th scope="col">{{ __('trans.Message')}}</th>
                        <th scope="col">{{ __('trans.Status')}}</th>
                        <th scope="col" style="width: 16%;">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach( $note as $key => $note )
                     <tr>
                        <td scope="row" class="text-center">{{$key+1}}</td>
                        @if(!empty($note->note_user->first_name) && !empty($note->note_user->last_name))         
                        <td scope="row"  >
                           <?php $image= $note->note_user->image;?>
                           @if ($image ==Null)
                           <img src="{{ asset('/public/userImages/avatar-5.jpg')}}" class="table-avatar communication-avatar" alt="User Image" style="width: 32px">
                           @else
                           <img src="{{ asset('/public/userImages/'.$note->note_user->image )}}" class="table-avatar communication-avatar" style="width: 32px">
                           @endif
                           <a href="#"><strong>{{$note->note_user->first_name." "}} {{$note->note_user->last_name}}</br></strong></a>
                           {{--  <span class="communication-contact " style="margin-left:60px ;margin-top:20px">{{ date("Y-m-d", strtotime($note->created_at))}}</span>  --}}
                        </td>
                        @else
                        <td>  </td>
                        @endif
                        <td scope="row" class="text-center">{{ date("Y-m-d", strtotime($note->created_at))}}</td>
                        <td scope="row" class="text-center">{{$note->note}}</td>
                        <td scope="row">
                           <label class="switch">
                           <input type="checkbox" onclick="checkFluency({{ $note->id }})"  id="{{ $note->id  }}"
                           @if($note->status=="active")         
                           checked
                           @endif
                           >
                           <span class="slider round"></span>
                           </label>
                        </td>
                        <td scope="row" >
                           <!--<a href="{{url('note/'.$note->id.'/edit')}}" style=""><i class="fa fa-edit" style="font-size: 25px; margin-left: 1%;"></i></a>-->
                           <button class="btn" style="background: transparent;"  onclick="edit_note({{$note->id}})" style=""><i class="fa fa-edit" style="font-size: 25px; margin-left: 1%;"></i></button>
                           <form action="{{url('note',$note->id)}}" method="POST" style="float: right ;margin-right: 3%;margin-top: 4%;">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="formId"  style="border: none;color: red; background-color: #F9F9F9;"><i class="fa fa-trash " style="font-size: 25px;"></i></button>
                           </form>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
            <!-- /.box-body -->
         </div>
      </div>
      <div class="col-md-4">
         <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-yellow">
               <div class="widget-user-image">
                  <?php $image= $user->image;?>
                  @if ($image !=NULL)
                  <img class="img-circle" src="{{ asset('/public/userImages/'.$user->image )}}" alt="User Avatar">
                  @else
                  <img src="{{ asset('/public/userImages/avatar-5.jpg')}}" class="img-circle" alt="User Image">
                  @endif
               </div>
               <h3 class="widget-user-username">{{ $user->first_name }} {{ $user->last_name }}</h3>
               <h5 class="widget-user-desc">{{ $user->user_type }}</h5>
            </div>
            <div class="box-footer no-padding">
               <ul class="nav nav-stacked">
                  <li><a href="#">{{ __('trans.Email')}} <span class="pull-right ">{{ $user->email }}</span></a></li>
                  <li><a href="#">{{ __('trans.Date_of_Birth')}} <span class="pull-right ">{{ $user->date_of_birth }}</span></a></li>
                  <li><a href="#">{{ __('trans.Phone_Number')}} <span class="pull-right ">{{ $user->phone_number }}</span></a></li>
                  <li><a href="#">{{ __('trans.Address')}} <span class="pull-right ">{{ $user->address }}</span></a></li>
                  <li><a href="#">{{ __('trans.City')}} <span class="pull-right ">{{ $user->city }}</span></a></li>
                  <li><a href="#">{{ __('trans.Province')}} <span class="pull-right ">{{ $user->province }}</span></a></li>
                  <li><a href="#">{{ __('trans.Postal_Code')}} <span class="pull-right ">{{ $user->postal_code }}</span></a></li>
                  <li><a href="#">{{ __('trans.Gender')}} <span class="pull-right ">{{ $user->gender }}</span></a></li>
                  <li><a href="#">{{ __('trans.Status')}} <span class="pull-right ">{{ $user->status }}</span></a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="modal right fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Update_Note') }}</h5>
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
               <form method="POST" action="/note/" enctype="multipart/form-data" id="branchform">
                  @csrf
                  {{ method_field('PUT') }}
                  <div class="form-group">
                     <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('trans.Notes') }}</label>
                     <input id="note" type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="" required autocomplete="note" autofocus>
                     @error('note')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">  {{ __('trans.Update') }}</button>
            </div>
            </form>
         </div>
      </div>
   </div>
   </div>
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">New Note</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" action="{{ route('note.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                     <input type="hidden" class="form-control" id="recipient-name" name="receptionist_id" value="{{ $user->id }}">
                  </div>
                  <div class="form-group">
                     <label for="message-text" class="col-form-label">{{ __('trans.Branch_Name')}}</label>
                     <select class="form-control" id="sel1" name="branch_id">
                        @foreach ($branch as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="message-text" class="col-form-label">{{ __('trans.Note')}}:</label>
                     <textarea class="form-control" id="message-text" name="note"></textarea>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('trans.Close')}}</button>
                     <button type="submit" class="btn btn-primary">{{ __('trans.Send_Note')}}</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <script type='text/javascript'>
      $('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this)
      
        })
        
                
      
      $(document).ready(function(){
      
      
      
      
      // Fetch all records
      $.ajaxSetup({
              headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
          });
        
      });
      
              $('.formId').click(function(event) {
      event.preventDefault();
      var form = $(this).parent();
      
       $.confirm({
      columnClass: 'col-md-4 col-md-offset-4',
        theme: 'dark',
        title: 'Delete',
        content: 'Are Your Sure To Delete This Note?',
      buttons: {
          Delete: function () {
              form.submit();
          },
          cancel: function () {
           
          },
         
      }
      });
      });
      
      
      
      
      
      function edit_note(id){
      
      
      // var token = $("meta[name='csrf-token']").attr("content");
      $("#myModal3").modal('show');
      var baseUrl = "{{URL::to('/')}}";
      //alert(baseUrl);
      $.ajax(
      {
          url: baseUrl+"/note/"+id+"/edit",
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
                   var note = response['data'].note;
              
          //   }
          $("#branchform").attr('action',$("#branchform").attr('action')+id);
          $('#branchform #note').val(note);
           // console.log(name);
          },
            error: function (xhr, b, c) {
                  console.log("xhr=" + xhr + " b=" + b + " c=" + c);
              }
      });
      
      
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
          url: "http://dms.jhamt.com/note_change_status/"+id,
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
</section>
@endsection
