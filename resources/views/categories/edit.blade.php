@extends('main')
@section('title','| Edit tag')
@section('content')
    {{Form::model($c,['route'=>['categories.update',$c->id],'method'=>'PUT'])}}
    {{Form::label('name','Name:')}}
    {{Form::text('name',null,['class'=>'form-control'])}}
    {{Form::submit('Save Changes',['class'=>'btn-h2-spacing btn btn-md btn-success'])}}
    {{Form::close()}}
@endsection