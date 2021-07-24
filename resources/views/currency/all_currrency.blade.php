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
   <button type="button" class="btn btn-primary btn-demo pull-right button_slide slide_right" data-toggle="modal" data-target="#myModal2" style="width: 202px;">
   <i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('Add Currency')}}
   </button>
   <h5>{{ __('All Currencies')}}</h5>

</div>
<!-- /.box-header -->
<div class="table-responsive">
   <table id="advance-1" class="display">
      <thead>
         <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('trans.Name')}}</th>
            <th scope="col">{{ __('Symbol')}}</th>
            <th scope="col">{{ __('trans.Status')}}</th>
            <th scope="col" style="width: 62.1562px;">{{ __('trans.Action') }}</th>
         </tr>
      </thead>
      <tbody>
         @foreach( $currency as $key => $currency )
         <tr>
            <td scope="row"> {{$key+1}}</td>
            <td scope="row">{{$currency->currency_name}}</td>
            <td scope="row">{{$currency->currency_symbol}}</td>
            <td scope="row">
               <label class="switch">
               <input type="checkbox" onclick="checkFluency({{ $currency->id }})"  id="{{ $currency->id  }}"
               @if($currency->status=="active")         
               checked
               @endif
               >
               <span class="slider round"></span>
               </label>
            </td>
            <td scope="row" >
               <button class="btn" style="background: transparent;"  onclick="edit_currency({{$currency->id}})" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></button>
               <form action="{{url('currency/'.$currency->id)}}" method="POST" style="float: right ;margin-right: 24%;margin-top: 6%;">
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
            <th scope="col">{{ __('Symbol')}}</th>
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
            <h5 class="modal-title" id="exampleModalLabel">{{ __('Add Currency')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('currency.store')  }}" enctype="multipart/form-data" >
               @csrf
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('Currency Name')}}</label>
                  <input id="currency_name" type="text" class="form-control @error('currency_name') is-invalid @enderror" name="currency_name" value="{{ old('currency_name') }}" required autocomplete="currency_name" autofocus>
                  @error('currency_name')
                  <span class="invalid-feedback" role="alert-danger">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('Currency Symbol')}}</label>
                  <input id="currency_symbol" type="text" class="form-control @error('currency_symbol') is-invalid @enderror" name="currency_symbol" value="{{ old('currency_symbol') }}" required autocomplete="currency_symbol" autofocus>
                  @error('currency_symbol')
                  <span class="invalid-feedback" role="alert-danger">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary button_slide slide_right">  {{ __('Add Currency')}}</button>
         </div>
         </form>
      </div>
   </div>
</div>
<div class="modal right fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('Update Currency') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="/currency/" enctype="multipart/form-data" id="branchform">
               @csrf
               {{ method_field('PUT') }}
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('Currency Name')}}</label>
                  <input id="currency_name" type="text" class="form-control @error('currency_name') is-invalid @enderror" name="currency_name" value="{{ old('currency_name') }}" required autocomplete="currency_name" autofocus>
                  @error('currency_name')
                  <span class="invalid-feedback" role="alert-danger">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">{{ __('Currency Symbol')}}</label>
                  <input id="currency_symbol" type="text" class="form-control @error('currency_symbol') is-invalid @enderror" name="currency_symbol" value="{{ old('currency_symbol') }}" required autocomplete="currency_symbol" autofocus>
                  @error('currency_symbol')
                  <span class="invalid-feedback" role="alert-danger">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary button_slide slide_right">  {{ __('Update Currency') }}</button>
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
            content: 'Are Your Sure To Delete Currency, Data Related To This Currency Will Also  Delete. Data Will Not Recoverd  ?',
          buttons: {
              Delete: function () {
                  form.submit();
              },
              cancel: function () {
               
              },
          }
          });
        });
      function edit_currency(id){
          
      
         // var token = $("meta[name='csrf-token']").attr("content");
         $("#myModal3").modal('show');
         
       
          $.ajax(
          {
              url: "currency/"+id+"/edit",
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
                       var currency_name = response['data'].currency_name;
                       var currency_symbol = response['data'].currency_symbol;
              //   }
              $("#branchform").attr('action',$("#branchform").attr('action')+id);
              $('#branchform #currency_name').val(currency_name);
              $('#branchform #currency_symbol').val(currency_symbol);
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
              url: "currency_change_status/"+id,
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
