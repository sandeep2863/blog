@extends('main')
@section('title',' |view post')
 @section('content')

     <div class="row">
         <div class="col-md-8">
             <h1>{{ $post->title }}</h1>
             <p class="lead">{!!  $post->body   !!} </p>
             <hr>
             <div class="tags">
                 @foreach($post->tags as $tag)
                     <span class="label label-default">{{$tag->name}}</span>
                     @endforeach
             </div>
             <div id="backend-comment" style="margin-top: 50px">
                 <h3>Comments: <small>{{$post->comments()->count()}} total</small></h3>
                 <table class="table">
                     <thead>
                        <tr>
                            <th>Name:</th>
                            <th>Email:</th>
                            <th>Comment:</th>
                            <th></th>
                        </tr>
                     </thead>
                     <tbody>
                     @foreach($post->comments as $c)
                         <tr>
                             <td>{{$c->name}}</td>
                             <td>{{$c->email}}</td>
                             <td>{{$c->comment}}</td>
                             <td>
                                 <a href="{{route('comments.edit',$c->id)}}" class="btn btn-xs btn-primary btn-block">Edit</a>

                                 {{ Form::open(['route'=>['comments.destroy',$c->id],'method'=>'DELETE']) }}
                                 {{ Form::submit('delete',['class'=>'btn btn-danger btn-xs btn-block']) }}
                                 {{ Form::close() }}
                             </td>
                         </tr>

                         @endforeach

                     </tbody>
                 </table>
             </div>
         </div>


         <div class="col-md-4">
             <div class="well">


                 <div class="dl-horizontal">
                     <label>url slug:</label>
                     <p><a href="{{ url('blog/'.$post->slug) }}"> {{ url('blog/'.$post->slug) }}</a></p>
                 </div>

                 <div class="dl-horizontal">
                     <label>Category:</label>
                     <p>{{ $post->category->name }}</p>
                 </div>


                 <div class="dl-horizontal">
                    <label>Created at:</label>
                    <p>{{ date( 'M j,Y h:ia',strtotime($post->created_at)) }}</p>
                </div>

                 <div class="dl-horizontal">
                     <label>Updated at:</label>
                     <p>{{date( 'M j,Y h:ia',strtotime($post->updated_at))}}</p>
                 </div>
                 <hr>

                 <div class="row">
                     <div class="col-md-6">
                         {!! Html::linkroute('posts.edit','Edit',array($post->id),array('class'=>'btn btn-primary btn-block')) !!}

                        {{--<a href="#" class="btn btn-primary btn-block">Edit</a>--}}
                     </div>
                     <div class="col-md-6">
                         {{ Form::open(['route'=>['posts.destroy',$post->id],'method'=>'DELETE']) }}
                         {{ Form::submit('delete',['class'=>'btn btn-danger btn-block']) }}
                         {{ Form::close() }}
                     </div>
                     <br><br><br>
                        <div class="col-md-12">
                            <a href="{{route('posts.index')}}" class="btn btn-default btn-block">See All Posts</a>
                        </div>
                 </div>
             </div>
         </div>
     </div>

     @endsection