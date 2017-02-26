@extends('layouts.master')


@section('css')
    <script src="{{ url('js') }}/moment.min.js"></script>
    <script src="{{ url('js') }}/jquery.min.js"></script>
    <script src="{{ url('js') }}/fullcalendar.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            var base_url = '{{ url('/') }}';
            $('#calendar').fullCalendar({
                weekends: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                events: {
                    url: base_url + '/api',
                    error: function() {
                        alert("cannot load json");
                    }
                }
            });
        });
    </script>
@endsection

@section('content')

    <div class="row">
        <div clss="col-md-12">
            <ol class="breadcrumb">
                <li class="active">You are here: Home</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div id='calendar'></div>
        </div>
    </div>
@endsection

