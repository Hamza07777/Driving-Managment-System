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
   {{--  <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a><i  class="fa fa-plus-circle" aria-hidden="true" style="margin-right: 8%;"></i> Add Note</button>  --}}
   <h5>{{ __('trans.Notes') }}</h5>
</div>
<!-- /.box-header -->
<div class="table-responsive">
   <!--<form method="post" action="{{url('multiplenote-destroydelete')}}">-->
   <!--   {{ csrf_field() }}-->
   <table id="advance-1" class="display mt-5">
      <thead>
         <tr>
            <!--<th scope="col" style="width: 116.2344px;"><input type="checkbox" id="checkAll" style="margin-top: -17%;"> <span style="padding-left: 13%;">Select All</span> </th>-->
            <th scope="col">#</th>
            <th scope="col" style="width: 20%;">{{ __('trans.Note_to') }}</th>
            <th scope="col">{{ __('trans.Message') }}</th>
            <th scope="col">{{ __('trans.Status') }}</th>
            <th scope="col" style="width: 20%;">{{ __('trans.Action') }}</th>
         </tr>
      </thead>
      <tbody>
         @foreach( $note as $key => $note )
         <tr>
            <td scope="row"> {{$key+1}}</td>
            @if(!empty($note->note_user->first_name) && !empty($note->note_user->last_name))         
            <td scope="row"  >
               @if (!empty($note->note_user->image))
               <img src="{{ asset('/public/userImages/'.$note->note_user->image )}}" class="table-avatar communication-avatar" style="width: 32px">
               @else
               <img src="{{ asset('/public/userImages/avatar-5.jpg')}}" class="table-avatar communication-avatar" alt="User Image" style="width: 32px">
               @endif
               <a href="#"><strong>{{$note->note_user->first_name." "}} {{$note->note_user->last_name}}</br></strong></a>
               {{--  <span class="communication-contact " style="margin-left:60px ;margin-top:20px">{{ date("Y-m-d", strtotime($note->created_at))}}</span>  --}}
            </td>
            @else
            <td>  </td>
            @endif
            <td scope="row">{{$note->note}}</td>
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
               <!--<a href="{{url('note/'.$note->id.'/edit')}}" style=""><i class="fa fa-edit" style="font-size: 25px; margin-left: 10%;"></i></a>-->
               <button class="btn" style="background: transparent;"  onclick="edit_note({{$note->id}})" style=""><i class="fa fa-edit" style="font-size: 25px; margin-left: 10%;"></i></button>
               <a href="{{url('note/'.$note->note_user->id)}}" style=""><i class="fa fa-eye" style="font-size: 25px; margin-left: 10%;    margin-top: 3%;"></i></a>
               <!--<a href="{{url('note_destroy/'.$note->id)}}"  style="border: none;color: red; background-color: transparent;float: right ;margin-right: 17%;    margin-top: 3%;"><i class="fa fa-trash formId" style="font-size: 25px;"></i></a>-->
               <form action="{{url('note',$note->id)}}" method="POST" style="float: right ;margin-right: 17%;    margin-top: 3%;">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="formId"  style="border: none;color: red; background-color: transparent;"><i class="fa fa-trash " style="font-size: 25px;"></i></button>
               </form>
            </td>
         </tr>
         @endforeach
      </tbody>
      <tfoot>
         <tr>
            <th scope="col">#</th>
            <th scope="col" style="width: 20%;">{{ __('trans.Note_to') }}</th>
            <th scope="col">{{ __('trans.Message') }}</th>
            <th scope="col">{{ __('trans.Status') }}</th>
            <th scope="col">{{ __('trans.Action') }}</th>
         </tr>
      </tfoot>
   </table>
   <!--<button style="display: none;margin-left: 11px;margin-bottom: 12px;" class="btn btn-danger formId ml-5"   type="" id="deleteRecordId">Delete All Record</button>-->
   <!--</form>-->
</div>
<!-- /.box-body -->
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
            <form method="POST" action="/note/" enctype="multipart/form-data" id="branchform">
               @csrf
               {{ method_field('PUT') }}
               <div class="form-group">
                  <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('trans.Notes') }}</label>
                  <input id="note" type="text" class="form-control @error('note') is-invalid @enderror" name="note" value=" {{ !empty($note->note) ? $note->note:'' }}" required autocomplete="note" autofocus>
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
   <script type='text/javascript'>
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
         
       
          $.ajax(
          {
              url: "note/"+id+"/edit",
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
              url: "note_change_status/"+id,
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
