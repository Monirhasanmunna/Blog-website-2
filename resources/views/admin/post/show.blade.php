@extends('layouts.backend.app')


@section('content')
<div class="container-fluid">
    <a class="btn btn-danger" href="{{route('admin.post.index')}}">Back</a>

    @if ($post->is_approved == true)
    <button type="button" class="btn btn-primary pull-right" disabled>Approved</button>
    @else
        <button type="button" class="btn btn-info pull-right">Approve</button>
    @endif
    <br>
    <br>
    <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{$post->title}}
                            <small>Posted By <strong>{{$post->user->name}}</strong> on {{date_format($post->created_at,'M d Y')}}</small>
                        </h2>
                    </div>
                    <div class="body">
                        {!! $post->body !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>
                            Categoryies
                        </h2>
                    </div>
                    <div class="body">
                        
                        @foreach ($post->categories as $category)
                            <span class="label bg-cyan">{{$category->name}}</span>
                        @endforeach

                    </div>
                </div>

                <div class="card">
                    <div class="header bg-green">
                        <h2>
                            Tags
                        </h2>
                    </div>
                    <div class="body">
                        
                        @foreach ($post->tags as $tag)
                            <span class="label bg-green">{{$tag->name}}</span>
                        @endforeach

                    </div>
                </div>

                <div class="card">
                    <div class="header bg-amber">
                        <h2>
                            Featured Image
                        </h2>
                    </div>
                    <div class="body">
                        <img class="img-responsive img-tumbnail" src="{{ url('storage/post/'.$post->image) }}" alt="">
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection