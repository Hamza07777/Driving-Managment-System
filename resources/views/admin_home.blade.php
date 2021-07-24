@extends('layouts.admin_app')
@section('content')
<section class="content">
   <div class="flash-message"></div>
   <!-- Info boxes -->
   <div class="row">
      <a href="{{ route('admin_show_user') }}">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('trans.Users')}}</span>
                  <span class="info-box-number">{{ $user_count }}</span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
      </a>
      <!-- /.col -->
      <a href="{{ route('vehical.index') }}">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-red"><i class="ion ion-ios-bus"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('trans.Vehicals')}}</span>
                  <span class="info-box-number">{{ $vehical_count }}</span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
      </a>
      <!-- /.col -->
      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>
      <a href="{{ route('roadschedule.index') }}">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-green"><i class="ion ion-ios-stopwatch-outline"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('trans.Road_Schedules')}}</span>
                  <span class="info-box-number">{{ $road_schedule }}</span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
      </a>
      <a href="#">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('trans.Phases')}}</span>
                  <span class="info-box-number">{{ $phases }}</span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
   </div>
   </a>
   <!-- /.row -->
   <!-- Info boxes -->
   <div class="row">
      <a href="{{ route('package.index') }}">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-aqua"><i class="ion ion-ios-card"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('trans.Packages')}}</span>
                  <span class="info-box-number">{{ $Packages }}</span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
      </a>
      <!-- /.col -->
      <a href="{{ route('note.index') }}">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-red"><i class="ion ion-ios-create"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('trans.Notes')}}</span>
                  <span class="info-box-number">{{ $notes }}</span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
      </a>
      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>
      <a href="{{ route('invoices.index') }}">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-green"><i class="ion ion-ios-document"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('trans.Invoices')}}</span>
                  <span class="info-box-number">{{ $invoices }}</span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
      </a>
      <a href="{{ route('expenses.index') }}">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-yellow"><i class="ion ion-ios-stats"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('trans.Expenses')}}</span>
                  <span class="info-box-number">{{ $expenses }}</span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
   </div>
   </a>
   <!-- /.row -->
   <!-- Info boxes -->
   <div class="row">
      <a href="{{ route('course.index') }}">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-aqua"><i class="ion ion-ios-journal"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('trans.Courses')}}</span>
                  <span class="info-box-number">{{ $course }}</span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
      </a>
      <a href="{{ route('classes.index') }}">
         <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-red"><i class="ion ion-ios-book-outline"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('trans.Classes')}}</span>
                  <span class="info-box-number">{{ $classes }}</span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
      </a>
      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>
      <a href="{{ route('branch.index') }}">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-green"><i class="ion ion-ios-business"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('trans.Branches')}}</span>
                  <span class="info-box-number">{{ $branch }}</span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
      </a>
      <!-- /.col -->
      <a href="{{ route('appoinment.index') }}">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
               <span class="info-box-icon bg-yellow"><i class="ion ion-ios-time-outline"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">{{ __('trans.Appoinment')}}</span>
                  <span class="info-box-number">{{ $appoinment }}</span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
      </a>
      <!-- /.col -->
   </div>
   <!-- /.row -->
   <div class="row">
      <div class="col-md-12">
         <div class="box box-primary">
            <div class="box-body no-padding">
               <!-- THE CALENDAR -->
               <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
         </div>
         <!-- /. box -->
      </div>
      <!-- /.col -->
   </div>
  
   <div class="row">
      <!-- Left col -->
      <div class="col-md-8">
        
         <div class="row">
            <div class="col-md-6">
               <!-- DIRECT CHAT -->
               <div class="box box-warning direct-chat direct-chat-warning">
                  <div class="box-header with-border">
                     <h3 class="box-title">{{ __('trans.Notes')}}</h3>
                     <div class="box-tools pull-right">
                        <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">{{ $notes }}</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <!--<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts"-->
                        <!--        data-widget="chat-pane-toggle">-->
                        <!--  <i class="fa fa-comments"></i></button>-->
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                     </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                     <!-- Conversations are loaded here -->
                     <div class="direct-chat-messages">
                        <!-- Message. Default to the left -->
                        @foreach ($all_notes as $all_notes)
                        <div class="direct-chat-msg">
                           <div class="direct-chat-info clearfix">
                              <span class="direct-chat-name pull-left">{{$all_notes->note_user->first_name." "}} {{$all_notes->note_user->last_name}}</span>
                              <span class="direct-chat-timestamp pull-right">{{ $all_notes->created_at->format('l jS \\of F Y h:i:s A') }} </span>
                           </div>
                           <!-- /.direct-chat-info -->
                           <!--<?php $image= $all_notes->note_user->image;?>-->
                           <!--@if ($image !='1.jpg')-->
                           <!--<img src="{{ asset('/userImages/'.$image )}}" class="table-avatar communication-avatar" style="width: 32px">-->
                           <!--@else-->
                           <img src="{{ asset('/public/userImages/avatar-5.jpg')}}" class="table-avatar communication-avatar" alt="User Image" style="width: 32px">
                           <!--@endif-->
                           <!-- /.direct-chat-img -->
                           <div class="direct-chat-text">
                              {{  $all_notes->note}}
                           </div>
                           <!-- /.direct-chat-text -->
                        </div>
                        @endforeach
                        <!-- /.direct-chat-msg -->
                     </div>
                     <!--/.direct-chat-messages-->
                     <!-- Contacts are loaded here -->
                     <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                           <li>
                              <a href="#">
                                 <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Image">
                                 <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                    Count Dracula
                                    <small class="contacts-list-date pull-right">2/28/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">How have you been? I was...</span>
                                 </div>
                                 <!-- /.contacts-list-info -->
                              </a>
                           </li>
                           <!-- End Contact Item -->
                           <li>
                              <a href="#">
                                 <img class="contacts-list-img" src="dist/img/user7-128x128.jpg" alt="User Image">
                                 <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                    Sarah Doe
                                    <small class="contacts-list-date pull-right">2/23/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">I will be waiting for...</span>
                                 </div>
                                 <!-- /.contacts-list-info -->
                              </a>
                           </li>
                           <!-- End Contact Item -->
                           <li>
                              <a href="#">
                                 <img class="contacts-list-img" src="dist/img/user3-128x128.jpg" alt="User Image">
                                 <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                    Nadia Jolie
                                    <small class="contacts-list-date pull-right">2/20/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">Ill call you back at...</span>
                                 </div>
                                 <!-- /.contacts-list-info -->
                              </a>
                           </li>
                           <!-- End Contact Item -->
                           <li>
                              <a href="#">
                                 <img class="contacts-list-img" src="dist/img/user5-128x128.jpg" alt="User Image">
                                 <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                    Nora S. Vans
                                    <small class="contacts-list-date pull-right">2/10/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">Where is your new...</span>
                                 </div>
                                 <!-- /.contacts-list-info -->
                              </a>
                           </li>
                           <!-- End Contact Item -->
                           <li>
                              <a href="#">
                                 <img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Image">
                                 <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                    John K.
                                    <small class="contacts-list-date pull-right">1/27/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">Can I take a look at...</span>
                                 </div>
                                 <!-- /.contacts-list-info -->
                              </a>
                           </li>
                           <!-- End Contact Item -->
                           <li>
                              <a href="#">
                                 <img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Image">
                                 <div class="contacts-list-info">
                                    <span class="contacts-list-name">
                                    Kenneth M.
                                    <small class="contacts-list-date pull-right">1/4/2015</small>
                                    </span>
                                    <span class="contacts-list-msg">Never mind I found...</span>
                                 </div>
                                 <!-- /.contacts-list-info -->
                              </a>
                           </li>
                           <!-- End Contact Item -->
                        </ul>
                        <!-- /.contatcts-list -->
                     </div>
                     <!-- /.direct-chat-pane -->
                  </div>
                 
               </div>
               <!--/.direct-chat -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
               <!-- USERS LIST -->
               <div class="box box-danger">
                  <div class="box-header with-border">
                     <h3 class="box-title">Latest Members</h3>
                     <div class="box-tools pull-right">
                        <span class="label label-danger">few New Members</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                     </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body no-padding">
                     <ul class="users-list clearfix">
                        @foreach ($user_name as $user_name)
                        <li>
                           @if ($user_name->image ==Null)
                           <img src="{{ asset('/public/userImages/avatar-5.jpg')}}" class="user-image" alt="User Image">
                           @else
                           <img src="{{ asset('/public/userImages/'.$user_name->image )}}"  alt="User Image">
                           @endif
                           <a class="users-list-name" href="#">{{ $user_name->first_name." " }} {{ $user_name->last_name }}</a>
                           <span class="users-list-date">{{ $user_name->created_at->format('jS \\of F') }}</span>
                        </li>
                        @endforeach
                     </ul>
                     <!-- /.users-list -->
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center">
                     <a href="{{ route('admin_show_user') }}" class="uppercase">View All Users</a>
                  </div>
                  <!-- /.box-footer -->
               </div>
               <!--/.box -->
            </div>
            <!-- /.col -->
         </div>
       
      </div>
      <!-- /.col -->
      <div class="col-md-4">
         <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title">Packges</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
               </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <ul class="products-list product-list-in-box">
                  @foreach ($package as $package)
                  <li class="item">
                     <div class="product-img">
                        <img src="{{ asset('/public/dist/img/default-50x50.gif')}}      " alt="Product Image">
                     </div>
                     <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">{{ $package->detail }}
                        <span class="label label-warning pull-right">${{ " ".$package->price }}</span></a>
                        <span class="product-description">
                        In this package you have {{ $package->theory_hours." " }} theory hours, {{ $package->practical_hours." " }} Practical hours ,{{ $package->exam_attempt." " }} number of exam attempt {{ $package->duration." " }} is package duration
                        </span>
                     </div>
                  </li>
                  @endforeach
                  <!-- /.item -->
               </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
               <a href="{{ route('package.index') }}" class="uppercase">View All Products</a>
            </div>
            <!-- /.box-footer -->
         </div>
         <!-- /.box -->
      </div>
      <!-- /.col -->
   </div>
   <!-- /.row -->
</section>
<script>
   $(document).ready(function() {
       // page is now ready, initialize the calendar...
       $('#calendar').fullCalendar({
           header    : {
         left  : 'prev,next today',
         center: 'title',
         right : 'month,agendaWeek,agendaDay'
       },
       buttonText: {
          today: 'Today',
         month: 'Month',
         week : 'Week',
         day  : 'Day'
       },
       
           // put your options and callbacks here
           events : [
               @foreach($schedules as $scedule)
               {
                   title :  'your class will start at {{$scedule->class_start}} and end at {{$scedule->class_end}} with instructor name {{$scedule->road_schedule_instructor->first_name}} {{  $scedule->road_schedule_instructor->last_name}} with student {{  $scedule->road_schedule_instructor->first_name}} {{  $scedule->road_schedule_instructor->last_name}} of course {{  $scedule->road_schedule_coursess->course_name}} of vehical {{  $scedule->road_schedule_vehical->car_name}}  {{  $scedule->road_schedule_vehical->car_no}}',
                   start : '{{ $scedule->class_day }}',
   
               },
               @endforeach
           ],
            navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
         eventRender: function (event, element) {
            if (event.icon) {
                element.find(".fc-title").prepend("<i class='fa fa-" + event.icon + "'></i>");
            }
        },
        eventRender: function (eventObj, $el) {
            $el.popover({
                title: eventObj.title,
                content: eventObj.description,
                trigger: 'hover',
                placement: 'top',
                container: 'body'
            });
        },
      
       })
   });
</script>
@endsection
