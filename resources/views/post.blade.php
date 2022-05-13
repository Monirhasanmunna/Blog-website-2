@extends('layouts.frontend.app')

@section('css')
<link href="{{asset('frontend/css/post/styles.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/post/responsive.css')}}" rel="stylesheet">

<style>
    .favorite_post {
        color: blue;
    }

</style>
@endsection

@section('content')

<div class="slider" style="background-image:url({{asset('storage/post/'.$post->image)}});">
    <div class="display-table  center-text">
        <h1 class="title display-table-cell"><b>{{$post->title}}</b></h1>
    </div>
</div><!-- slider -->

<section class="post-area section">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-12 no-right-padding">

                <div class="main-post">

                    <div class="blog-post-inner">

                        <div class="post-info">

                            <div class="left-area">
                                <a class="avatar" href="#"><img src="{{asset('storage/user/'.$post->user->image)}}"
                                        alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>{{$post->user->name}}</b></a>
                                <h6 class="date">{{$post->created_at->diffForHumans()}}</h6>
                            </div>

                        </div><!-- post-info -->

                        <h3 class="title"><a href="#"><b>{{$post->title}}</b></a></h3>

                        <div class="post-image"><img src="{{asset('storage/post/'.$post->image)}}" alt="Blog Image">
                        </div>

                        <p class="para">{!! $post->body !!}</p>

                        <ul class="tags">
                            @foreach ($post->tags as $post_tag)
                            <li><a href="{{$post_tag->slug}}">{{$post_tag->name}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- blog-post-inner -->

                    <div class="post-icons-area">
                        <ul class="post-icons">
                            <li>

                                @guest

                                <a href="javascript:void(0);"
                                    onclick="toastr['info']('To Add Favorite Post You need to login first !')"><i
                                        class="ion-heart"></i>{{$post->favorite_to_user()->count()}}</a>
                                @else
                                <a href="javascript:void(0);"
                                    onclick="document.getElementById('favorite-form-{{$post->id}}').submit();"
                                    class="{{Auth::user()->favorite_to_post()->where('post_id',$post->id)->count() != 0 ? 'favorite_post' : '' }}"><i
                                        class="ion-heart"></i>{{$post->favorite_to_user()->count()}}</a>
                                <form id="favorite-form-{{$post->id}}" action="{{route('favorite.post',[$post->id])}}"
                                    method="post" style="display: none;">
                                    @csrf
                                </form>

                                @endguest

                            </li>
                            <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                            <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                        </ul>

                        <ul class="icons">
                            <li>SHARE : </li>
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                        </ul>
                    </div>

                </div><!-- main-post -->
            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12 no-left-padding">

                <div class="single-post info-area">

                    <div class="sidebar-area about-area">
                        <h4 class="title"><b>ABOUT Author</b></h4>
                        <p>{!! $post->user->about !!}
                    </div>

                    <div class="sidebar-area subscribe-area">

                        <h4 class="title"><b>SUBSCRIBE</b></h4>
                        @if ($errors->any())
                        <div class="alert text-danger" style="padding-left: 0px;margin-bottom: 0px;">

                            @foreach ($errors->all() as $error)
                            <span><strong>{{ $error }}</strong></span>
                            @endforeach

                        </div>
                        @endif
                        <div class="input-area">
                            <form method="POST" action="{{route('subscriber.email')}}">
                                @csrf
                                <input class="email-input" name="email" type="text" placeholder="Enter your email"
                                    required>
                                <button class="submit-btn" type="submit"><i
                                        class="icon ion-ios-email-outline"></i></button>
                            </form>
                        </div>

                    </div><!-- subscribe-area -->

                    <div class="tag-area">

                        <h4 class="title"><b>TAG CLOUD</b></h4>
                        <ul>
                            @foreach ($post->tags as $tag)
                            <li><a href="{{$tag->slug}}">{{$tag->name}}</a></li>
                            @endforeach

                        </ul>

                    </div><!-- subscribe-area -->

                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- post-area -->


<section class="recomended-area section">
    <div class="container">
        <div class="row">

            @foreach ($randomPost as $posts)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="{{asset('storage/post/'.$posts->image)}}" alt="Blog Image">
                        </div>

                        <a class="avatar" href="#"><img src="{{asset('storage/user/'.$posts->user->image)}}"
                                alt="Profile Image"></a>

                        <div class="blog-info">

                            <h4 class="title"><a href="{{route('post.details',[$posts->slug])}}"><b>{{$posts->title}}</b></a></h4>

                            <ul class="post-footer">
                                <li>

                                    @guest

                                    <a href="javascript:void(0);"
                                        onclick="toastr['info']('To Add Favorite Post You need to login first !')"><i
                                            class="ion-heart"></i>{{$posts->favorite_to_user()->count()}}</a>
                                    @else
                                    <a href="javascript:void(0);"
                                        onclick="document.getElementById('favorite-form-{{$posts->id}}').submit();"
                                        class="{{Auth::user()->favorite_to_post()->where('post_id',$posts->id)->count() != 0 ? 'favorite_post' : '' }}"><i
                                            class="ion-heart"></i>{{$posts->favorite_to_user()->count()}}</a>
                                    <form id="favorite-form-{{$posts->id}}"
                                        action="{{route('favorite.post',[$posts->id])}}" method="post"
                                        style="display: none;">
                                        @csrf
                                    </form>

                                    @endguest

                                </li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$posts->view_count}}</a></li>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-md-6 col-sm-12 -->

            @endforeach


        </div><!-- row -->

    </div><!-- container -->
</section>

<section class="comment-section">
    <div class="container">
        <h4><b>POST COMMENT</b></h4>
        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="comment-form">
                    @guest
                    <b>For Comment you have to <a href="{{route('login')}}">Login</a> first</b>
                    @else
                    <form method="post" action="{{route('comment.store',[$post->id])}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <textarea name="comment" rows="2" class="text-area-messge form-control"
                                    placeholder="Enter your comment" aria-required="true"
                                    aria-invalid="false"></textarea>
                            </div><!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                            </div><!-- col-sm-12 -->

                        </div><!-- row -->
                    </form>
                    @endguest

                </div><!-- comment-form -->

                <h4><b>COMMENTS({{$post->comments->count()}})</b></h4>

                <div class="commnets-area">

                    @foreach ($comments as $comment)
                    <div class="comment">

                        <div class="post-info">

                            <div class="left-area">
                                <a class="avatar" href="#"><img src="{{asset('storage/user/'.$comment->user->image)}}"
                                        alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>{{$comment->user->name}}</b></a>
                                <h6 class="date">{{$comment->created_at->diffForHumans()}}</h6>
                            </div>

                        </div><!-- post-info -->

                        <p>{{$comment->comment}}</p>

                    </div>
                    @endforeach

                </div><!-- commnets-area -->

                <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>

            </div><!-- col-lg-8 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section>

@endsection
