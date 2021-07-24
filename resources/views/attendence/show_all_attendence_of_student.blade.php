@extends('../layouts.admin_app')
@section('content')
<div class="box-body">
   <div class="row">
      <h2>{{$user->first_name}} {{$user->last_name}}</h2>
      <!-- /.col -->
      <div class="col-md-4">
         <p class="text-center">
            <strong>{{ __('trans.Attendence')}}</strong>
         </p>
         <div class="progress-group">
            <span class="progress-text">{{ __('trans.Present')}}</span>
            <span class="progress-number"><b>160</b>/200</span>
            <div class="progress sm">
               <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
            </div>
         </div>
         <!-- /.progress-group -->
         <div class="progress-group">
            <span class="progress-text">{{ __('trans.Absent')}}</span>
            <span class="progress-number"><b>310</b>/400</span>
            <div class="progress sm">
               <div class="progress-bar progress-bar-red" style="width: 80%"></div>
            </div>
         </div>
         <!-- /.progress-group -->
         <div class="progress-group">
            <span class="progress-text">{{ __('trans.Late')}}</span>
            <span class="progress-number"><b>480</b>/800</span>
            <div class="progress sm">
               <div class="progress-bar progress-bar-green" style="width: 80%"></div>
            </div>
         </div>
         <!-- /.progress-group -->
         <div class="progress-group">
            <span class="progress-text">{{ __('trans.Leave')}}</span>
            <span class="progress-number"><b>250</b>/500</span>
            <div class="progress sm">
               <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
            </div>
         </div>
         <!-- /.progress-group -->
      </div>
      <!-- /.col -->
   </div>
   <!-- /.row -->
</div>
<div class="box">
   <div class="box-header">
      {{--  <button class="btn btn-primary btn-icon " data-toggle="modal" data-target="#addnote"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Add Branch</button>  --}}
      {{-- <a href="{{ route('classes.create') }}"  class="btn btn-primary pull-right "><i class="fa fa-plus-circle" style="margin-right: 8%;"></i>Add Class</a> --}}
      <h5>{{ __('trans.All_Attendence')}}</h5>
   </div>
   <!-- /.box-header -->
   <div class="table-responsive">
      <table id="advance-1" class="display">
         <thead>
            <tr>
               {{-- 
               <th scope="col">Name</th>
               --}}
               <th scope="col">{{ __('trans.Status')}}</th>
               <th scope="col">{{ __('trans.Date')}}</th>
            </tr>
         </thead>
         <tbody>
            {{-- 
            <td scope="row">{{$user->first_name}} {{$user->last_name}}</td>
            --}}
            @foreach( $attendence as  $attendence ) 
            <tr>
               <td scope="row">
                  {{  $attendence->attendence_status->status }}
               </td>
               <td scope="row">
                  {{  \App\models\setting::date_farmate($attendence->attendance_date)     }}
               </td>
            </tr>
            @endforeach
            {{-- @foreach( $attendence as  $attendence ) --}}
            {{-- @for ($j =1 ; $j <=31 ; $j++)
            {{-- {{ dd($attendence[$i]->created_at->format('d') )}} --}}
            {{-- {{ dd(isset($attendence[$j-1]->status)) }} --}}
            {{-- @if(isset($attendence[$j]->status)) --}}
            {{-- {{ $int = (int)$attendence[$j]->created_at->format('d')}} --}}
            {{-- {{ $j }} --}}
            {{-- @if($int==$j) --}}
            {{-- 
            <td scope="row"> --}}
               {{-- @if($attendence[$j]->status=='1') --}}
               {{-- p --}}
               {{-- @else --}}
               {{-- A --}}
               {{-- @endif --}}
               {{-- 
            </td>
            --}}
            {{-- @endif --}}
            {{-- / @else --}}
            {{-- 
            <td scope="row"> --}}
               {{-- {{ $j }} --}}
               {{-- / 
            </td>
            --}}
            {{-- @endif --}}
            {{-- @endfor --}} 
            {{-- @endforeach --}}
         </tbody>
         <tfoot>
            <tr>
               {{-- 
               <th scope="col">Name</th>
               --}}
               <th scope="col">{{ __('trans.Status')}}</th>
               <th scope="col">{{ __('trans.Date')}}</th>
            </tr>
         </tfoot>
      </table>
   </div>
   <!-- /.box-body -->
</div>
@endsection
