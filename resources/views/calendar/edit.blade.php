@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>You are here: <a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/calendar') }}">Events</a></li>
                <li class="active">Edit - {{ $event->title }}</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">

            @if($errors)
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            @endif

            <form action="{{ url('calendar/' . $event->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT" />
                <div class="form-group @if($errors->has('name')) has-error has-feedback @endif">
                    <label for="name">Your Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $event->name }}" placeholder="E.g. John Doe">
                    @if ($errors->has('name'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span>
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="form-group @if($errors->has('title')) has-error has-feedback @endif">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $event->title }}" placeholder="E.g. My event's title">
                    @if ($errors->has('title'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span>
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
                <div class="form-group @if($errors->has('start')) has-error @endif">
                    <label for="start">Start Time</label>
                    <div class="input-group">
                        <input type="text" id="start" class="form-control" name="start" value="{{ $event->start_time }}">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                    @if ($errors->has('start'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span>
                            {{ $errors->first('start') }}
                        </p>
                    @endif
                </div>
                <div class="form-group @if($errors->has('end')) has-error @endif">
                    <label for="end">End Time</label>
                    <div class="input-group">
                        <input type="text" id="end" class="form-control" name="end" value="{{ $event->end_time }}">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                    @if ($errors->has('end'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span>
                            {{ $errors->first('end') }}
                        </p>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
@section('jquery')
    <script src="{{ url('js') }}/jquery.min.js"></script>
@endsection
@section('js')
    <script type="text/javascript" src="{{ url('js') }}/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $('#start').datetimepicker({
            format: 'yyyy-mm-dd hh:ii:ss'
        });
        $('#end').datetimepicker({
            format: 'yyyy-mm-dd hh:ii:ss'
        });
    </script>
@endsection