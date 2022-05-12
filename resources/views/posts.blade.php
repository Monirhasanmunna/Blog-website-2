@extends('layouts.frontend.app')

@section('content')
<div class="slider"></div><!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="{{asset('storage/post/'.$post->image)}}" alt="Blog Image"></div>

                        <a class="avatar" href="#"><img src="{{asset('storage/user/'.$post->user->image)}}" alt="Profile Image"></a>

                        <div class="blog-info">

                            <h4 class="title"><a href="#"><b>{{$post->title}}</b></a></h4>

                            <ul class="post-footer">
                                <li>
                                    @guest
                                    
                                        <a href="javascript:void(0);" onclick="toastr['info']('To Add Favorite Post You need to login first !')"><i class="ion-heart"></i>{{$post->favorite_to_user()->count()}}</a>
                                     @else
                                        <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{$post->id}}').submit();"
                                            
                                            class="{{Auth::user()->favorite_to_post()->where('post_id',$post->id)->count() != 0 ? 'favorite_post' : '' }}"

                                            ><i class="ion-heart"></i>{{$post->favorite_to_user()->count()}}</a>
                                        <form id="favorite-form-{{$post->id}}" action="{{route('favorite.post',[$post->id])}}" method="post" style="display: none;">
                                            @csrf
                                        </form>

                                    @endguest
                                </li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->
            @endforeach
        </div><!-- row -->

        {{-- pagination --}}
        <div>
            <span class="m-auto">
                {{$posts->links()}}
            </span>
        </div>

    </div><!-- container -->
</section><!-- section -->
@endsection