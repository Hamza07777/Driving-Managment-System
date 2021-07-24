@extends('../layouts.admin_app')
@section('content')
{{--  {{ dd($schedules) }}  --}}
{{--  @foreach ($schedules as $schedules)
{{  dd($schedules->class_start) }}
@endforeach  --}}
<!-- Main content -->
<section class="content">
   <div class="row">
      <!-- /.col -->
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
   <!-- /.row -->
</section>
<!-- /.content -->
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
