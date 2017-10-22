@extends('main')
@section('title',' | Create new Post')
@section('stylesheets')
    {{Html::style('css/select2.min.css')}}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
        tinymce.init({ selector:'textarea' });
    </script>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Create New Post</h1>
                <br>
                {!! Form::open(['route' => 'posts.store','files'=>true]) !!}
                    {{ Form::label('title','Title:') }}
                    {{ Form::text('title',null,array('class'=>'form-control')) }}

                <br>
                {{ Form::label('slug','Slug:') }}
                {{ Form::text('slug',null,array('class'=>'form-control')) }}
                <br>

                {{ Form::label('category_id','Category:') }}
                <select class="form-control" name="category_id">
                    <option>Select Category</option>
                    <option  class="divider"></option>
                    @foreach($categories as $c)
                    <option value="{{$c->id}}">
                        {{$c->name}}

                    </option>
                        @endforeach
                </select>
                <br>
                {{ Form::label('tags','Tags:') }}
                <select class="form-control select-2-multi" name="tags[]" multiple="multiple">

                    @foreach($tags as $c)
                        <option value="{{$c->id}}">
                            {{$c->name}}

                        </option>
                    @endforeach
                </select>

                <br>
                {{Form::label('image','upload Image:')}}
                {{Form::file('image',['class'=>'form-control'])}}
                    <br><br>
                    {{ Form::label('body','Message:') }}
                    {{ Form::textarea('body',null,array('class'=>'form-control')) }}
                <br>
                    {{ Form::submit('Create New Post',array('class'=>'btn btn-success btn-block')) }}
                {!! Form::close() !!}
            </div>
        </div>

    @endsection
@section('scripts')


        <script type="text/javascript">
            $(".select-2-multi").select2();
    </script>

@endsection
