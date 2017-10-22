@extends('main')
@section('title','| homePage')
@section('content')
    <div class="row">
        <div class="com-md-12">
            <div class="jumbotron">
                <h1>Welcome to My Blog</h1>
                <p class="lead"></p>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-8">
            @foreach($post as $p)
            <div class="post">
                <h3>{{$p->title}}</h3>
                <p>{{substr($p->body,0,200)}} {{ strlen($p->body)>200 ? "..." : "" }}</p>
                <a href="{{ route('blog.single',$p->slug) }}" class="btn btn-primary">Read More</a>
            </div>
            @endforeach
        </div>

        <div class="col-md-3 col-md-offset-1">
            <h2>Sidebar</h2>
        </div>
    </div>
@endsection