@extends('main')
@section('title',' |Edit Post')
@section('stylesheets')
    {{Html::style('css/select2.min.css')}}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
        tinymce.init({ selector:'textarea' });
    </script>
@endsection
    @section('content')
        <div class="row">
            {{ Form::model($post,['route'=>['posts.update',$post->id],'method'=>'PUT'])  }}
            <div class="col-md-8">
                {{ Form::label('titel','Title:') }}
                {{ Form::text('title',null,['class'=>'form-control'])  }}
                <br>
                {{ Form::label('slug','Slug:') }}
                {{ Form::text('slug',null,['class'=>'form-control'])  }}
                <br>

                {{ Form::label('category_id','Category:') }}
                <select class="form-control" name="category_id">
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
                <br><br>
                {{ Form::label('body','Message:') }}
                {{ Form::textarea('body',null,['class'=>'form-control'])  }}

            </div>
            <div class="col-md-4">
                <div class="well y-well">
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
                            {!! Html::linkroute('posts.show','Cancel',array($post->id),array('class'=>'btn btn-danger btn-block')) !!}

                            {{--<a href="#" class="btn btn-primary btn-block">Edit</a>--}}
                        </div>
                        <div class="col-md-6">
                            {{ Form::submit('Save',array('class'=>'btn btn-success btn-block')) }}
                        </div>

                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        @endsection
@section('scripts')


    <script type="text/javascript">
        $(".select-2-multi").select2();
        $(".select-2-multi").select2().val({{ json_encode($post->tags->pluck('id') ) }}).trigger('change');
    </script>

@endsection