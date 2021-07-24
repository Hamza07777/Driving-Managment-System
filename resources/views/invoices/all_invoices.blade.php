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
      <?php $todayDate = date('Y/m/d'); ?>
      <!--<a href="{{ route('invoices.create') }}"  class="btn btn-primary pull-right "><i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Invoice') }}  </a>-->
      <button type="button" class="btn btn-primary btn-demo pull-right button_slide slide_right" data-toggle="modal" data-target="#myModal2" style="width: 120px;">
      <i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Invoice')}}
      </button>
      <h5>{{ __('trans.Invoices') }}</h5>
   </div>
   <!-- /.box-header -->
   <div class="table-responsive">
      <table id="advance-1" class="display">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col" style="width: 29%;">{{ __('trans.Detail') }}</th>
               <th scope="col">{{ __('trans.Amount_Paid') }}</th>
               <th scope="col">{{ __('trans.tax') }}</th>
               <th scope="col">{{ __('trans.Student_Name') }}</th>
               <th scope="col">{{ __('trans.Branch_Name') }}</th>
               <th scope="col">{{ __('Invoice Status')}}</th>
               <th scope="col">{{ __('Due Date') }}</th>
               <!--<th scope="col">{{ __('trans.Status')}}</th>-->
               <th scope="col" style="width: 10%;">{{ __('trans.Action') }}</th>
            </tr>
         </thead>
         <tbody>
            @foreach( $invoice as $key => $invoice )
            <tr>
               <td scope="row">{{$key+1}}</td>
               <td scope="row">{{$invoice->detail}}</td>
               <td scope="row">{{App\Models\setting::compnay_currency()." ".$invoice->amount_paid}}</td>
               <td scope="row">{{App\Models\setting::compnay_currency()." ".App\Models\setting::tax_amount($invoice->amount_paid)}}</td>
               @if(!empty($invoice->invoice_student->first_name) && !empty($invoice->invoice_student->last_name))         
               <td scope="row">{{$invoice->invoice_student->first_name}} {{$invoice->invoice_student->last_name}}</td>
               @else
               <td>  </td>
               @endif
               <td scope="row">{{!empty($invoice->invoice_branch->name) ?  $invoice->invoice_branch->name:''}} </td>
                <td scope="row">
                    @if($invoice->invoice_status=="Paid")
                         <span style="border: 1px solid #1A7741;padding: 9px 19px;"> {{$invoice->invoice_status}}</span>
                    @endif
                    
                     @if($invoice->invoice_status=="Unpaid")
                         <span style="border: 1px solid red;padding: 9px;"> {{$invoice->invoice_status}}</span>
                    @endif
                    
                     @if($invoice->invoice_status=="Cancel")
                         <span style="border: 1px solid #008FBD;padding: 9px 12px;"> {{$invoice->invoice_status}}</span>
                    @endif
                   </td>
               <!--<td scope="row">-->
               <!--   <label class="switch">-->
               <!--   <input type="checkbox" onclick="checkFluency({{ $invoice->id }})"  id="{{ $invoice->id  }}"-->
               <!--   @if($invoice->status=="active")         -->
               <!--   checked-->
               <!--   @endif-->
               <!--   >-->
               <!--   <span class="slider round"></span>-->
               <!--   </label>-->
               <!--</td>-->
               <td scope="row"> {{  \App\models\setting::date_farmate($invoice->due_date)     }} </td>
               <td scope="row" >
                  <!--<a href="{{url('invoices/'.$invoice->id.'/edit')}}" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></a>-->
                  <button class="btn" style="background: transparent; margin-left: -8%;"  onclick="edit_invoices({{$invoice->id}})" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 100%;"></i></button>
                  <form action="{{url('invoices',$invoice->id)}}" method="POST" style="float: right ;margin-right: 9%;margin-top:7%;" id="formId">
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
               <th scope="col" style="width: 29%;">{{ __('trans.Detail') }}</th>
               <th scope="col">{{ __('trans.Amount_Paid') }}</th>
               <th scope="col">{{ __('trans.tax') }}</th>
               <th scope="col">{{ __('trans.Student_Name') }}</th>
               <th scope="col">{{ __('trans.Branch_Name') }}</th>
                <th scope="col">{{ __('Invoice Status')}}</th>
               <!--<th scope="col">{{ __('trans.Status')}}</th>-->
               <th scope="col">{{ __('Due Date') }}</th>
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
               <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Add_Invoice') }}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" action="{{ route('invoices.store') }}" enctype="multipart/form-data" >
                  @csrf
                  <div class="form-group">
                     <label for="class_id" class="col-form-label text-md-right">{{ __('trans.Branch_Name') }}</label>
                     <select class="form-control" id="branch_id" name="branch_id" onchange="showData_create()">
                     </select >
                  </div>
                  <div class="form-group">
                     <label for="Instructor_id" class=" col-form-label text-md-right">{{ __('trans.Student_Name') }}</label>
                     <select class="form-control" id="Instructor_id" name="student_id">
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="price" class="col-form-label text-md-right">{{ __('trans.Amount_Paid') }}</label>
                     <input id="amount_paid" type="number" class="form-control @error('amount_paid') is-invalid @enderror" name="amount_paid" value="{{ old('amount_paid') }}" required autocomplete="amount_paid" >
                     @error('amount_paid')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="due_date" class=" col-form-label text-md-right">{{ __('Due Date') }}</label>
                     <input id="datepicker2" type="text" class="form-control @error('due_date') is-invalid @enderror" name="due_date"  required  autofocus placeholder="{{ $todayDate }}">
                     @error('due_date')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="time_period" class=" col-form-label text-md-right">{{ __('Invoice Status') }}</label>
                     <select class="form-control" id="sel1" name="invoice_status">
                        <option value='Paid'>{{ __('Paid') }}</option>
                        <option value='Unpaid'>{{ __('Unpaid') }}</option>
                        <option value='Cancel'>{{ __('Cancel') }}</option>
                     </select>
                     @error('invoice_status')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="invoices" class="col-form-label text-md-right">{{ __('trans.Detail') }}</label>
                     <textarea class="form-control" id="detail" rows="7" autocomplete="detail" required name="detail" style="height:80px !important " value="{{ old('detail') }}"></textarea>
                     @error('detail')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary button_slide slide_right">  {{ __('trans.Add_Invoice') }}</button>
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
            <h5 class="modal-title" id="exampleModalLabel">{{ __('Update Invoice') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="/invoices/" enctype="multipart/form-data" id="branchform">
               @csrf
               {{ method_field('PUT') }}
               <div class="form-group">
                  <label for="class_id" class="col-form-label text-md-right">{{ __('trans.Branch_Name') }}</label>
                  <select class="form-control" id="branch_idd" name="branch_id" onchange="showData()">
                  </select >
               </div>
               <div class="form-group">
                  <label for="Instructor_id" class=" col-form-label text-md-right">{{ __('trans.Student_Name') }}</label>
                  <select class="form-control" id="Instructor_id" name="student_id">
                  </select>
               </div>
               <div class="form-group">
                  <label for="price" class="col-form-label text-md-right">{{ __('trans.Amount_Paid') }}</label>
                  <input id="amount_paid" type="number" class="form-control @error('amount_paid') is-invalid @enderror" name="amount_paid" value="{{ old('amount_paid') }}" required autocomplete="amount_paid" >
                  @error('amount_paid')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="class_dayy" class=" col-form-label text-md-right">{{ __('Due Date') }}</label>
                  <input id="datepicker" type="text" class="form-control @error('due_date') is-invalid @enderror" name="due_date"  required autocomplete="due_date" autofocus placeholder="{{ $todayDate }}">
                  @error('due_date')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="time_period" class=" col-form-label text-md-right">{{ __('Invoice Status') }}</label>
                  <select class="form-control" id="invoice_status" name="invoice_status">
                  </select>
                  @error('invoice_status')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="invoices" class="col-form-label text-md-right">{{ __('trans.Detail') }}</label>
                  <textarea class="form-control" id="detail" rows="7" autocomplete="detail" required name="detail" style="height:80px !important " value="{{ old('detail') }}"></textarea>
                  @error('detail')
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
      
      
      //  $("#formId").onsubmit=function(){
      //           return confirm('Are Your Sure to Delete Invoice, Data Related To This Invoice Will Also  Delete. Data Will Not Recoverd ?');
      //       }
             
                           $('.formId').click(function(event) {
          event.preventDefault();
          var form = $(this).parent();
      
            $.confirm({
            columnClass: 'col-md-4 col-md-offset-4',
            theme: 'dark',
            title: 'Delete',
            content: 'Are Your Sure To Delete Invoice, Data Related To This Invoice Will Also Delete. Data Will Not Recoverd ?',
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
      
      
      function all_user(id){
      
          $.ajax(
          {
              url: "{{URL::to('student_all_data')}}",
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
      
      
      
      function all_user_branch(id){
      
          $.ajax(
          {
              url: "{{URL::to('student_all_data')}}",
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
      
      function edit_invoices(id){
          
      
         // var token = $("meta[name='csrf-token']").attr("content");
         $("#myModal3").modal('show');
       <?php 
         $branch = DB::table('branches')->get(); 
            
         
            ?>
             
      
       
          $.ajax(
          {
              
              url: "invoices/"+id+"/edit",
              type: 'GET',
               dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                  $('#branchform #branch_idd').empty();
                  $('#branchform #Instructor_id').empty();
                    //console.log(response['data']);
              //   for(var i=0; i<1; i++){
                      // var id = response['data'].id;
                       var detail = response['data'].detail;
                      var amount_paid = response['data'].amount_paid;
             
                      var invoice_status = response['data'].invoice_status;
                      var branch_id = response['data'].branch_id;
                      var branch_name = response['data'].name;
                      
                        var instructor_id = response['data'].student_id;
                      var instructor_first_name = response['data'].first_name;
                      var instructor_last_name = response['data'].last_name;
                      
                      var due_date = response['data'].due_date;
                     
              //   }
                  // $('#branchform #branch_idd').val(branch_id);
      
              $("#branchform").attr('action',$("#branchform").attr('action')+id);
              $('#branchform #detail').val(detail);
              $('#branchform #amount_paid').val(amount_paid);
              $('#branchform #datepicker').val(due_date);
      
              
           
              var tr_str = '<option value="'+branch_id+'" selected>'+branch_name+'</option><?php   foreach ($branch as $branch){?> <option value="<?php echo $branch->id ?>"  ><?php echo $branch->name ?></option><?php } ?>'
                          $("#branchform #branch_idd").append(tr_str);
              var tr_str1 = '<option value="'+instructor_id+'" selected>'+instructor_first_name+' '+ instructor_last_name +'</option>';
              
              
              var tr_str3 = '<option value="'+invoice_status +'" selected >' + invoice_status+'</option><option value="Paid"  >Paid</option><option value="Unpaid" >Unpaid</option><option value="Cancel" >Cancel</option>'
              
                          $("#branchform #invoice_status").append(tr_str3);
                          
                         
                           $("#branchform #Instructor_id").append(tr_str1);       
                          
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
              url: "invoice_change_status/"+id,
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
           all_user(star);
      
          }
           function showData() {
          //document.getElementById("branch_select").removeAttribute("selected");
         var firstP = document.getElementById('branch_idd');
         
         var star=firstP.value;
        // alert(star);
          all_user_branch(star);
      
          }
   </script>          
</div>
@endsection
