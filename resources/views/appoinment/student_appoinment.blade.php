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
      {{-- <a href="{{ route('appoinment.create') }}"  class="btn btn-primary pull-right"><i class="fa fa-plus-circle mr-1"></i>Add appoinment</a> --}}
      <h5>{{ __('trans.All_Student_Appoinment') }}</h5>
   </div>
   <!-- /.box-header -->
   <div class="table-responsive">
      <table id="advance-1" class="display">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col">{{ __('trans.student_Name') }}</th>
               <th scope="col">{{ __('trans.Appoinemnt_Detail') }}</th>
               <th scope="col">{{ __('trans.Appoinment_Date') }}</th>
               <th scope="col"></th>
            </tr>
         </thead>
         <tbody>
            @foreach( $appointment_student as $key => $appointment_student )
            <tr>
               <td scope="row">{{$key+1}}</td>
               {{-- 
               <td scope="row">{{$appointment_student->id}}</td>
               --}}
               <td scope="row">{{$appointment_student->appointment_student_appoinmentss->first_name}}{{$appointment_student->appointment_student_appoinmentss->last_name}}</td>
               <td scope="row">{{$appointment_student->student_appoinment_appointment->text}}</td>
               <td scope="row">{{  \App\models\setting::date_farmate($appointment_student->student_appoinment_appointment->appoinment_day)     }}</td>
               <td scope="row">
                  {{-- <a href="{{url('appoinment/'.$appointment->id.'/edit')}}" style=""><i class="fa fa-edit" style="font-size: 16px; margin-left: 10%;"></i></a> --}}
                  {{--  <a href="" style=""><i class="fa fa-eye" style="font-size: 16px; margin-left: 10%;"></i></a>  --}}
                  <form action="{{route('student_appoinment.destroy',$appointment_student->id)}}" method="POST" style="float: right ;margin-right: 50%;">
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
               <th scope="col">{{ __('trans.student_Name') }}</th>
               <th scope="col">{{ __('trans.Appoinemnt_Detail') }}</th>
               <th scope="col">{{ __('trans.Appoinment_Date') }}</th>
               <th scope="col"></th>
            </tr>
         </tfoot>
      </table>
   </div>
   <!-- /.box-body -->
</div>
<script>
   //  document.onsubmit=function(){
   //       return confirm('Are Your Sure to Delete Appointment Of Student, Data Related To This Appointment Of Student Will Also  Delete. Data Will Not Recoverd ?');
   //   }
      
      
      
                   $('.formId').click(function(event) {
   event.preventDefault();
   var form = $(this).parent();
   
     $.confirm({
     columnClass: 'col-md-4 col-md-offset-4',
     theme: 'dark',
     title: 'Delete',
     content: 'Are Your Sure To Delete Appointment Of Student, Data Related To This Appointment Of Student Will Also  Delete. Data Will Not Recoverd ?',
   buttons: {
       Delete: function () {
           form.submit();
       },
       cancel: function () {
        
       },
   }
   });
   });
</script>
@endsection
