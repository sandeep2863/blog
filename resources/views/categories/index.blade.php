@extends('main')
@section('title',' |All Categories')
    @section('content')

        <div class="row">
            <div class="col-md-8">
                <h1>Categories</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $c)
                        <tr>
                            <th>{{$c->id}}</th>
                            <td>{{ $c->name }}</td>
                            <td>
                                <a href="{{route('categories.edit',$c->id)}}" class="btn btn-xs btn-default ">Edit</a>

                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="col-md-3">
                <div class="well">

                    {{ Form::open(['route'=>'categories.store']) }}
                        <h2>New Category</h2>
                    {{Form::label('name','Name:')}}
                    {{Form::text('name',null,['class'=>'form-control'])}}
                    {{Form::submit('Create New Category',['class'=>'btn btn-primary btn-block btn-h1-spacing'])}}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @endsection