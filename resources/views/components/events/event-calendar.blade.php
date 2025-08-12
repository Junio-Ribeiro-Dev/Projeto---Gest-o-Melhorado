<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<div id='full_calendar_events'></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<!-- Incluindo o idioma português -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/pt.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function () {

        var SITEURL = "{{ url('/') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#full_calendar_events').fullCalendar({
            locale: 'pt',  // Calendário em português
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            height: {{($editable == 'true')?500:"parent"}},
            groupByResource: true,
            defaultView: 'month',
            editable: {{$editable}},
            eventLimit: true,
            events: SITEURL + '/calendar-event',
            displayEventTime: true,
            selectable: {{$selectable}},
            selectHelper: {{$selectable}},
            select: function (event_start, event_end) {
                var event_name = prompt("Nome do Evento:");
                if (event_name) {
                    // Força duração de 40 minutos
                    var startMoment = moment(event_start);
                    var endMoment = moment(startMoment).add(40, 'minutes');

                    var event_start_formatted = startMoment.format("YYYY-MM-DD HH:mm:ss");
                    var event_end_formatted = endMoment.format("YYYY-MM-DD HH:mm:ss");

                    $.ajax({
                        url: SITEURL + "/calendar-crud-ajax",
                        data: {
                            title: event_name,
                            start: event_start_formatted,
                            end: event_end_formatted,
                            type: 'create'
                        },
                        type: "POST",
                        success: function (data) {
                            displayMessage("Evento criado.");

                            calendar.fullCalendar('renderEvent', {
                                id: data.id,
                                title: event_name,
                                start: event_start_formatted,
                                end: event_end_formatted
                            }, true);
                            calendar.fullCalendar('unselect');
                        }
                    });
                }
            },
            eventResize: function (event, delta) {
                var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                $.ajax({
                    url: SITEURL + '/calendar-crud-ajax',
                    data: {
                        title: event.title,
                        start: event_start,
                        end: event_end,
                        id: event.id,
                        type: 'edit'
                    },
                    type: "POST",
                    success: function (response) {
                        displayMessage("Evento atualizado");
                    }
                });
            },
            eventClick: function (event) {
                if({{$selectable}}){
                    var eventDelete = confirm("Tem certeza que deseja deletar?");
                    if (eventDelete) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/calendar-crud-ajax',
                            data: {
                                id: event.id,
                                type: 'delete'
                            },
                            success: function (response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                displayMessage("Evento removido");
                            }
                        });
                    }
                }
            }
        });
    });

    function displayMessage(message) {
        toastr.success(message, 'Evento');            
    }
</script>
