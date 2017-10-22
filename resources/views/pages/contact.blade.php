@extends('main')
@section('title','| Contact')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Contact Me</h1>
            <hr>
            {!! Form::open(['url'=>'contact']) !!}

            {{ Form::label('email ','Email:') }}
            {{ Form::text('email',null,array('class'=>'form-control')) }}

            <br>

            {{ Form::label('subject ','Subject:') }}
            {{ Form::text('subject',null,array('class'=>'form-control')) }}

            <br>

            {{ Form::label('message','Message:') }}
            {{ Form::textarea('message',null,array('class'=>'form-control')) }}
            <br>
            {{ Form::submit('submit',array('class'=>'btn btn-success btn-block')) }}

            {!! Form::close() !!}

            {{--<form>--}}
                {{--<div class="form-group">--}}
                   {{--<label name="email">Email:</label>--}}
                    {{--<input class="form-control" id="email" name="email">--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}
                    {{--<label name="subject">Subject</label>--}}
                    {{--<input class="form-control" id="subject" name="subject">--}}
                {{--</div>--}}


                {{--<div class="form-group">--}}
                    {{--<label name="msg">Message:</label>--}}
                    {{--<textarea class="form-control" id="message" name="message" placeholder="Type Your message here"></textarea>--}}
                {{--</div>--}}

                {{--<input type="submit" name="sendMsg" value="Send Message" class="btn btn-primary">--}}
            {{--</form>--}}
        </div>
    </div>
@endsection