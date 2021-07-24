@extends('../layouts.admin_app')
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body no-padding">
          <div id="calendar"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
$(document).ready(function() {
  $('#calendar').fullCalendar({
    header: {
      left  : 'prev,next today',
      center: 'title',
      right : 'month,agendaWeek,agendaDay'
      },
    buttonText: {
      today: 'today',
      month: 'month',
      week : 'week',
      day  : 'day'
        },
    events : [
      @foreach($appointment as $appointment)
        {
          title :  'your Appoinment will start at {{$appointment->appoinment_start}} and end at {{$appointment->appoinment_end}} ',
          start : '{{ $appointment->appoinment_day }}',
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

