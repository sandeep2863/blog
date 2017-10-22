@extends('main')
@section('title','| Edit tag')
@section('content')
    {{Form::model($tag,['route'=>['tags.update',$tag->id],'method'=>'PUT'])}}
            {{Form::label('name','Title:')}}
            {{Form::text('name',null,['class'=>'form-control'])}}
            {{Form::submit('Save Changes',['class'=>'btn-h2-spacing btn btn-md btn-success'])}}
    {{Form::close()}}
@endsection