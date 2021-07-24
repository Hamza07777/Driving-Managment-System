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
      {{--  <button class="btn btn-primary btn-icon " data-toggle="modal" data-target="#addnote"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Add Branch</button>  --}}
      <!--<a href="{{ route('expenses.create') }}"  class="btn btn-primary pull-right "><i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Expense') }}</a>-->
      <button type="button" class="btn btn-primary btn-demo pull-right button_slide slide_right" data-toggle="modal" data-target="#myModal2" style="width: 140px;">
      <i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Expense')}}
      </button>
      <h5>{{ __('trans.All_Expense') }}</h5>
   </div>
   <!-- /.box-header -->
     <form method="POST" action="{{ route('expense_filter') }}" enctype="multipart/form-data" >
         
         
                  @csrf
                  
        <div class="row m-0 p-0" >
            <div class="col-md-2">
                      <div class="form-group">
                         <select class="form-control" id="branch_id" name="branch_id">
                         </select>
                    </div> 
            </div>
            <div class="col-md-3">
                <div class="form-group">

                  <input id="datepicker2" type="text" class="form-control @error('expense_day') is-invalid @enderror" name="expense_day" value="{{ old('expense_day') }}" required autocomplete="expense_day" placeholder="{{$todayDate }}">
                  @error('expense_day')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>
             <div class="col-md-3">
                    <div class="form-group">

                  <input id="datepicker" type="text" class="form-control @error('end_day') is-invalid @enderror" name="end_day" value="{{ old('end_day') }}" required autocomplete="end_day" placeholder="{{$todayDate }}">
                  @error('end_day')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>
            <div class="col-md-1">
                    <button class="btn btn-primary">Filter</button>
            </div>
             <div class="col-md-3">
                 <h4>  Total Expense: {{ App\Models\setting::compnay_currency()." ".$sum }} </h4>
            </div>
            
            
        </div>              
       
        
                  
    </form>              
   
   <div class="table-responsive">
      <table id="advance-1" class="display">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col" style="width: 44%;">{{ __('trans.Detail') }}</th>
               <th scope="col">{{ __('trans.Amount') }}</th>
               <th scope="col">{{ __('trans.Expense_Category') }}</th>
               <th scope="col">{{ __('trans.Branch_Name') }}</th>
               <th scope="col">{{ __('trans.Status') }}</th>
               <th scope="col">{{ __('trans.Action') }}</th>
            </tr>
         </thead>
         <tbody>
            @foreach( $expense as $key => $expense )
            <tr>
               <td scope="row">{{$key+1}}</td>
               <td scope="row">{{$expense->detail}}</td>
               <td scope="row">{{App\Models\setting::compnay_currency()." ".$expense->amount }}</td>
               <td scope="row">{{$expense->expense_category}}</td>
               <td scope="row">{{!empty($expense->expense_branch->name) ?  $expense->expense_branch->name:''}} </td>
               <td scope="row">
                  <label class="switch">
                  <input type="checkbox" onclick="checkFluency({{ $expense->id }})"  id="{{ $expense->id  }}"
                  @if($expense->status=="active")         
                  checked
                  @endif
                  >
                  <span class="slider round"></span>
                  </label>
               </td>
               <td scope="row" >
                  <!--<a href="{{url('expenses/'.$expense->id.'/edit')}}" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></a>-->
                  {{--  <a href="" style=""><i class="fa fa-eye" style="font-size: 16px; margin-left: 10%;"></i></a>  --}}
                  <button class="btn" style="background: transparent;"  onclick="edit_expense({{$expense->id}})" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></button>
                  <form action="{{url('expenses',$expense->id)}}" method="POST" style="float: right ;margin-right: 6%;margin-top: 7%;">
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
               <th scope="col" style="width: 44%;">{{ __('trans.Detail') }}</th>
               <th scope="col">{{ __('trans.Amount') }}</th>
               <th scope="col">{{ __('trans.Expense_Category') }}</th>
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
               <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Add_Expense') }}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" action="{{ route('expenses.store') }}" enctype="multipart/form-data" >
                  @csrf
                  <div class="form-group">
                     <label for="branch_id" class="col-form-label text-md-right">{{ __('trans.Brach_Name') }}</label>
                     <select class="form-control" id="branch_id" name="branch_id">
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="class_name" class="col-form-label text-md-right">{{ __('trans.Expense_Category') }}</label>
                     <select class="form-control" id="sel1" name="expense_category">
                        <option value="staff">{{ __('trans.staff') }}</option>
                        <option value="office">{{ __('trans.office') }}</option>
                        <option value="general">{{ __('trans.general') }}</option>
                        <option value="Entertainment">{{ __('trans.Entertainment') }}</option>
                        <option value="vehical">{{ __('trans.Vehical_expenses') }}</option>
                        <option value="others">{{ __('trans.others') }}</option>
                     </select>
                     @error('model_year')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="class_name" class="col-form-label text-md-right">{{ __('trans.Amount') }}</label>
                     <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount">
                     @error('amount')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="class_name" class="col-form-label text-md-right">{{ __('trans.Detail') }}</label>
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
            <h5 class="modal-title" id="exampleModalLabel">{{ __('Update Expense') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="/expenses/" enctype="multipart/form-data" id="branchform">
               @csrf
               {{ method_field('PUT') }}
               <div class="form-group">
                  <label for="branch_id" class="col-form-label text-md-right">{{ __('trans.Brach_Name') }}</label>
                  <select class="form-control" id="branch_id" name="branch_id">
                  </select>
               </div>
               <div class="form-group">
                  <label for="class_name" class="col-form-label text-md-right">{{ __('trans.Expense_Category') }}</label>
                  <select class="form-control" id="expense_category" name="expense_category">
                     <option value="staff">{{ __('trans.staff') }}</option>
                     <option value="office">{{ __('trans.office') }}</option>
                     <option value="general">{{ __('trans.general') }}</option>
                     <option value="Entertainment">{{ __('trans.Entertainment') }}</option>
                     <option value="others">{{ __('trans.others') }}</option>
                  </select>
                  @error('model_year')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="class_name" class="col-form-label text-md-right">{{ __('trans.Amount') }}</label>
                  <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount">
                  @error('amount')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="form-group">
                  <label for="class_name" class="col-form-label text-md-right">{{ __('trans.Detail') }}</label>
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
      
      //  document.onsubmit=function(){
      //           return confirm('Are Your Sure to Delete Expense, Data Related To This Expense Will Also  Delete. Data Will Not Recoverd ?');
      //       }
             
             
                       $('.formId').click(function(event) {
          event.preventDefault();
          var form = $(this).parent();
      
            $.confirm({
            columnClass: 'col-md-4 col-md-offset-4',
            theme: 'dark',
            title: 'Delete',
            content: 'Are Your Sure To Delete Expense, Data Related To This Expense Will Also  Delete. Data Will Not Recoverd ?',
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
      
      
      function edit_expense(id){
          
      
         // var token = $("meta[name='csrf-token']").attr("content");
         $("#myModal3").modal('show');
       <?php 
         $branch = DB::table('branches')->get(); 
         
            ?>
             
      
       
          $.ajax(
          {
              
              url: "expenses/"+id+"/edit",
              type: 'GET',
               dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                  $('#branchform #branch_id').empty();
                  $('#branchform #expense_category').empty();
                    console.log(response['data']);
              //   for(var i=0; i<1; i++){
                      // var id = response['data'].id;
                       var detail = response['data'].detail;
                      var amount = response['data'].amount;
                           var branch_id = response['data'].branch_id;
                      var branch_name = response['data'].name;
             var expense_category = response['data'].expense_category;
                     
              //   }
                  
              $("#branchform").attr('action',$("#branchform").attr('action')+id);
              $('#branchform #detail').val(detail);
              $('#branchform #amount').val(amount);
      var tr_str3 = '<option value="'+ expense_category +'"  >'+expense_category+'</option><option value="office"  >Office</option><option value="general"  >General</option><option value="Entertainment"  >Entertainment</option><option value="vehical"  >Vehicle expenses</option><option value="others"  >Others</option>'
                          $("#branchform #expense_category").append(tr_str3);
            
              
              var tr_str = '<option value="'+branch_id+'" selected>'+branch_name+'</option><?php   foreach ($branch as $branch){?> <option value="<?php echo $branch->id ?>" ><?php echo $branch->name ?></option><?php } ?>'
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
              url: "expense_change_status/"+id,
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
