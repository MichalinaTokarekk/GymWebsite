<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Kalendarz zajęć</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <style>
        /* Dodaj styl dla responsywności kalendarza */
        @media (max-width: 576px) {
            #calendar {
                width: 100%;
                margin: 0 auto;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/locale-all.js') }}"></script>
</head>
<body>
  
<div class="container">
    <br />
    <div class="grid justify-items-stretch pt-2 pr-2">
        @can('create', App\Models\Event::class)
        @if(auth()->user()->hasRole('worker'))
        {{-- brak przycisku --}}
        @else
            <x-button primary
                label="{{ __('events.actions.create') }}"
                href="{{ route('events.create') }}"
                class="justify-self-end bg-blue-600"
                style="background-color: rgb(119, 57, 39)" />
        @endif
    @endcan
    
    </div>
    {{-- <h1 class="text-center text-primary"><u></u></h1> --}}
    <br />

    <div id="calendar"></div>

</div>
   
<script>		
$(document).ready(function () {

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        locale: 'pl',
        editable:false,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:'/full-calender',
        selectable:true,
        selectHelper: true,
        select:function()
        {
        },
        // editable:true,
        eventResize: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },
        eventDrop: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },

        eventClick:function(event)
        {
                location.href= 'events/'+event.id;
        }
        
    });

});
</script>
  
</body>
</html>
