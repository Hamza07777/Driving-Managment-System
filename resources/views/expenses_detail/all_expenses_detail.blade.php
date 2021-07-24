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
      <!--<a href="{{ route('expense_detail.create') }}"  class="btn btn-primary pull-right "><i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Vehical_Expense') }}</a>-->
      <button type="button" class="btn btn-primary btn-demo pull-right button_slide slide_right" data-toggle="modal" data-target="#myModal2" style="width: 191px;">
      <i class="fa fa-plus-circle" style="margin-right: 8%;"></i>{{ __('trans.Add_Vehical_Expense')}}
      </button>
      <h5>{{ __('trans.All_Vehical_Expense') }}</h5>
   </div>
   <!-- /.box-header -->
   <div class="table-responsive">
      <table id="advance-1" class="display">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col" style="width:52%;">{{ __('trans.Expense_Name') }}</th>
               <th scope="col">{{ __('trans.Expense_Amount') }}</th>
               <th scope="col">{{ __('trans.Vehical_Name') }}</th>
               <th scope="col">{{ __('trans.Vehical_Number_Plate') }}</th>
               <th scope="col">{{ __('trans.Action') }}</th>
            </tr>
         </thead>
         <tbody>
            @foreach( $expense_details as $key => $expense_details )
            <tr>
               <td scope="row">{{$key+1}}</td>
               <td scope="row">{{!empty($expense_details->expense_detail_expense->detail) ?  $expense_details->expense_detail_expense->detail:''}}   </td>
               <td scope="row" >{{App\Models\setting::compnay_currency()." ". $expense_details->expense_detail_expense->amount }} </td>
               <td scope="row">{{!empty($expense_details->expense_detail_vehical->car_name) ?  $expense_details->expense_detail_vehical->car_name:''}} </td>
               <td scope="row">{{!empty($expense_details->expense_detail_vehical->car_no) ?  $expense_details->expense_detail_vehical->car_no:''}}</td>
               <td scope="row" >
                  <!--<a href="{{url('expense_detail/'.$expense_details->id.'/edit')}}" style="float:left"><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></a>-->
                  <!--{{--  <a href="" style=""><i class="fa fa-eye" style="font-size: 16px; margin-left: 10%;"></i></a>  --}}-->
                  <button class="btn" style="background: transparent;"  onclick="edit_expense_detail({{$expense_details->id}})" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></button>
                  <form action="{{url('expense_detail',$expense_details->id)}}" method="POST" style="float: right ;margin-right: 6%;margin-top: 7%;">
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
               <th scope="col" style="width:52%;">{{ __('trans.Expense_Name') }}</th>
               <th scope="col">{{ __('trans.Expense_Amount') }}</th>
               <th scope="col">{{ __('trans.Vehical_Name') }}</th>
               <th scope="col">{{ __('trans.Vehical_Number_Plate') }}</th>
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
               <h5 class="modal-title" id="exampleModalLabel">{{ __('trans.Add_Vehical_Expense') }}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" action="{{ route('expense_detail.store') }}" enctype="multipart/form-data" >
                  @csrf
                  <div class="form-group">
                     <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Brach_Name') }}</label>
                     <select class="form-control" id="branch_id" name="branch_id" onchange="showData_create()">
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Vehical_Name') }}</label>
                     <select class="form-control" id="vehical_id" name="vehical_id">
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="branch_id" class="col-form-label text-md-right">{{ __('trans.Expense_Name') }}</label>
                     <select class="form-control" id="expense_id" name="expense_id">
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
            <h5 class="modal-title" id="exampleModalLabel">      {{ __('trans.Update_Vehical_Expense') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="/expense_detail/" enctype="multipart/form-data" id="branchform">
               @csrf
               {{ method_field('PUT') }}
               <div class="form-group">
                  <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Brach_Name') }}</label>
                  <select class="form-control" id="branch_idd" name="branch_id" onchange="showData()">
                  </select>
               </div>
               <div class="form-group">
                  <label for="branch_id" class=" col-form-label text-md-right">{{ __('trans.Vehical_Name') }}</label>
                  <select class="form-control" id="vehical_id" name="vehical_id">
                  </select>
               </div>
               <div class="form-group">
                  <label for="branch_id" class="col-form-label text-md-right">{{ __('trans.Expense_Name') }}</label>
                  <select class="form-control" id="expense_id" name="expense_id">
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
      //           return confirm('Are Your Sure to Delete Expense Detail, Data Related To This Expense Detail Will Also  Delete. Data Will Not Recoverd ?');
      //       }
             
             
      $('.formId').click(function(event) {
          event.preventDefault();
         var form = $(this).parent();
      
            $.confirm({
            columnClass: 'col-md-4 col-md-offset-4',
            theme: 'dark',
            title: 'Delete',
            content: 'Are Your Sure To Delete Expense Detail, Data Related To This Expense Detail Will Also Delete. Data Will Not Recoverd ?',
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
      
      
      function all_expenses(id){
      
          $.ajax(
          {
              url: "{{URL::to('expenses_all_data')}}",
              type: 'GET',
              dataType: 'json',
                data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 $('#expense_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var name = response['data'][i].detail;
                           var tr_str = '<option value="' +id+ '">' + name + '</option>'
                          $("#expense_id").append(tr_str);
                      }
                 }
                 
                
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
              
          });
         
      }
      
      function all_vehical(id){
      
          $.ajax(
          {
              url: "{{URL::to('vehical_all_data')}}",
              type: 'GET',
              dataType: 'json',
                data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 $('#vehical_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var name = response['data'][i].car_name;
                          var number = response['data'][i].number_plate;
                           var tr_str = '<option value="' +id+ '">' + name +' '+ number + '</option>'
                          $("#vehical_id").append(tr_str);
                      }
                 }
                 
                
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
              
          });
         
      }
      
      function all_expenses_branch(id){
      
          $.ajax(
          {
              url: "{{URL::to('expenses_all_data')}}",
              type: 'GET',
              dataType: 'json',
                data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 $('#branchform #expense_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var name = response['data'][i].detail;
                           var tr_str = '<option value="' +id+ '">' + name + '</option>'
                          $("#branchform #expense_id").append(tr_str);
                      }
                 }
                 
                
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
              
          });
         
      }
      
      function all_vehical_branch(id){
      
          $.ajax(
          {
              url: "{{URL::to('vehical_all_data')}}",
              type: 'GET',
              dataType: 'json',
                data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                 $('#branchform #vehical_id').empty();
                 var len = 0;
                 len = response['data'].length;
                 if(len > 0){
                      for(var i=0; i<len; i++){
                          var id = response['data'][i].id;
                          var name = response['data'][i].car_name;
                          var number = response['data'][i].number_plate;
                           var tr_str = '<option value="' +id+ '">' + name +' '+ number + '</option>'
                          $("#branchform #vehical_id").append(tr_str);
                      }
                 }
                 
                
              },
                error: function (xhr, b, c) {
                      console.log("xhr=" + xhr + " b=" + b + " c=" + c);
                  }
              
          });
         
      }
      
      
      
      function edit_expense_detail(id){
          
      
         // var token = $("meta[name='csrf-token']").attr("content");
         $("#myModal3").modal('show');
       <?php 
         $branch = DB::table('branches')->get(); 
         ?>
             
      
       
          $.ajax(
          {
              
              url: "expense_detail/"+id+"/edit",
              type: 'GET',
               dataType: 'json',
              data: {
                  "id": id,
                 // "_token": token,
              },
              success: function (response){
                  $('#branchform #branch_idd').empty();
                  $('#branchform #vehical_id').empty();
                  $('#branchform #expense_id').empty();
                       var vehical_id = response['data'].vehical_id;
                      var car_name = response['data'].car_name;
                      var number_plate = response['data'].number_plate;
                      
                      var expense_id = response['data'].expense_id;
                      var detail = response['data'].detail;
                    //console.log(response['data']);
              //   for(var i=0; i<1; i++){
                      // var id = response['data'].id;
                      //  var class_name = response['data'].class_name;
                      // var class_duration = response['data'].class_duration;
             
                      // var no_of_theoratical = response['data'].no_of_theoratical;
                      //  var no_of_practical = response['data'].no_of_practical;
                      //   var branch_id = response['data'].branch_id;
                      //      var name = response['data'].name;
                      //       document.cookie = "branch_id =branch_id";
              //   }
      
               $("#branchform").attr('action',$("#branchform").attr('action')+id);
              // $('#branchform #class_name').val(class_name);
              // $('#branchform #class_duration').val(class_duration);
              // $('#branchform #no_of_theoratical').val(no_of_theoratical);
              // $('#branchform #no_of_practical').val(no_of_practical);
              var tr_str = '<option value="'+expense_id+'" selected>'+detail+'</option>';
              var tr_str1 = '<option value="'+vehical_id+'" selected>'+car_name+' '+number_plate + '</option>';
              
              var tr_str2 = '<?php   foreach ($branch as $branch){  echo $branch->id  ?> <option value="<?php echo $branch->id ?>"  ><?php echo $branch->name ?></option><?php } ?>';
                          $("#branchform #branch_idd").append(tr_str2);
                          $("#branchform #expense_id").append(tr_str);
                           $("#branchform #vehical_id").append(tr_str1);        
                          
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
      
      
      
       function showData_create() {
          //document.getElementById("branch_select").removeAttribute("selected");
         var firstP = document.getElementById('branch_id');
         
         var star=firstP.value;
        // alert(star);
        
            all_expenses(star);
            all_vehical(star);
      
          }
           function showData() {
          //document.getElementById("branch_select").removeAttribute("selected");
         var firstP = document.getElementById('branch_idd');
         
         var star=firstP.value;
        // alert(star);
         
            all_expenses_branch(star);
            all_vehical_branch(star);
      
          }
   </script>
</div>
@endsection
