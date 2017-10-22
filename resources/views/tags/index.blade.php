@extends('main')
@section('title',' |All Categories')
@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Tags</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $c)
                    <tr>
                        <th>{{$c->id}}</th>
                        <td><a href="{{route('tags.show',$c->id)}}">{{$c->name}}</a></td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        <div class="col-md-3">
            <div class="well">

                {{ Form::open(['route'=>'tags.store']) }}
                <h2>New Tag</h2>
                {{Form::label('name','Name:')}}
                {{Form::text('name',null,['class'=>'form-control'])}}
                {{Form::submit('Create New Tag',['class'=>'btn btn-primary btn-block btn-h1-spacing'])}}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection