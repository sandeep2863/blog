@extends('main')
@section('title',"| $post->title")
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{$post->title }}</h1>
            <p>{!! $post->body !!}</p>
        </div>
    </div><hr>
    <div class="row">
        <div class="col-md-12">
            <p class="text-center"><strong>Posted In:</strong>{{ $post->category->name }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 class="comment-title"><span class="glyphicon glyphicon-comment"></span> {{$post->comments()->count()}} Comments</h3>
            @foreach($post->comments as $c)
                <div class="comment">
                   <div class="author-info">
                       <img src="{{"https://www.gravatar.com/avatar/HASH" .md5(strtolower(trim($c->email))) }}" class="author-image img img-circle">

                       <div class="author-name">
                           <h4>{{$c->name}}</h4>
                           <p class="author-time">{{date('F nS,Y -g:iA',strtotime($c->created_at))}}</p>
                       </div>

                   </div>
                    <div class="comment-content">
                    {{$c->comment}}
                    </div>
                </div>
                @endforeach
        </div>
    </div>
    <div class="row">
        <div id="comment_form" class="col-md-8 col-md-offset-2" style="margin-top: 50px">
            {!! Form::open(['route'=>['comments.store',$post->id]]) !!}

            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('name ','Name:') }}
                    {{ Form::text('name',null,array('class'=>'form-control')) }}

                </div>


                <div class="col-md-6">
                    {{ Form::label('email','Email:') }}
                    {{ Form::text('email',null,array('class'=>'form-control')) }}

                </div>
            </div>
            <div class="row">
            <div class="col-md-12" style="margin-top: 10px">
                {{ Form::label('comment','Comment:') }}
                {{ Form::textarea('comment',null,array('class'=>'form-control','rows'=>'5')) }}
            </div>
            </div>


            {{ Form::submit('Add Comment',array('class'=>'btn btn-success btn-block','style'=>'margin-top:10px;')) }}

            {!! Form::close() !!}
        </div>
    </div>
    @endsection