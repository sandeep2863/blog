@extends('main')
@section('title',' | viewAll')
    @section('content')

        <div class="row">
            <div class="col-md-10">
                <h1>All Posts</h1>
            </div>
            <div class="col-md-2">
                <a href="{{route('posts.create')}}" class="btn btn-primary btn-block btn-h1-spacing">Create new Post</a>
                {{--{{ Html::linkroute('posts.create','Create New Post',array(),array('class'=>'btn btn-primary btn-block btn-h1-spacing')) }}--}}
            </div>


        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Created At</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($post as $p)
                            <tr>
                                <th>{{$p->id}}</th>
                                <td>{{$p->title}}</td>
                                <td>{{substr(strip_tags($p->body),0,50)}} {{ strlen(strip_tags($p->body))>50 ? "..." : "" }}</td>
                                <td>{{date( 'M j,Y h:ia',strtotime($p->updated_at))}}</td>
                                <td>
                                    <a href="{{ route('posts.show',$p->id) }}" class="btn btn-default">View</a>
                                    {{--{!! Html::linkroute('posts.show','View',array($p->id),array('class'=>'btn btn-default ')) !!}--}}
                                    {!! Html::linkroute('posts.edit','Edit',array($p->id),array('class'=>'btn btn-default ')) !!}
                                </td>


                            </tr>
                            @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $post->links() }}
                </div>
            </div>
        </div>
        @endsection