@extends('main')
@section('title',' | Blog')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Blog</h1>
        </div>
    </div>
    @foreach($post as $p)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>{{$p->title}}</h2>
            <h4><strong>Published: </strong>{{date('M j, Y',strtotime($p->created_at))}}</h4>
            <p>{{ substr(strip_tags($p->body),0,250) }} {{strlen(strip_tags($p->body))>250 ? "..." : ""}}</p>
            <a href="{{route('blog.single',$p->slug) }}" class="btn btn-primary btn-sm">Read More</a>
        </div>
    </div>
        <hr>
    @endforeach
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                {{$post->links()}}
            </div>
        </div>
    </div>
@endsection