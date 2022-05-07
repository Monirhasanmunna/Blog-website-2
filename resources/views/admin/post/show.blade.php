@extends('layouts.backend.app')

@section('content')
<div class="container-fluid">
    <a class="btn btn-danger waves-effect" href="{{route('admin.post.index')}}"><i class="material-icons">arrow_back</i>
    <span>Back</span>
    </a>
    <a class="btn btn-primary waves-effect" href="{{route('admin.post.edit',[$post->id])}}"><i class="material-icons">edit</i><span>Edit Post</span></a>

    @if ($post->is_approved == true)
    <button type="button" class="btn btn-primary pull-right waves-effect" disabled><i class="material-icons">done</i>
        <span>Approved</span></button>
    @else
        <form method="POST" action="{{route('admin.post.approve',[$post->id])}}" class="pull-right ">
            @csrf
           @method('PUT')
            <button type="submit" class="btn bg-green">Approve</button>
          </form>
        
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
