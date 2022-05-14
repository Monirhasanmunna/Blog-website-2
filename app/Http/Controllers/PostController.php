<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index($slug)
    {

        $post = Post::where('slug',$slug)->publish()->status()->first();
        $randomPost = Post::inRandomOrder()->publish()->status()->limit(3)->get();
        $comments = $post->comments()->get();
        $postKey = 'Post'.$post->id;
        if(!Session::has($postKey))
        {
            $post->increment('view_count');
            Session::put($postKey,1);
        }

        return view('post',compact('post','randomPost','comments'));
    }

    public function allPost()
    {
        $categories = Category::all();
        $posts = Post::latest()->publish()->status()->paginate(10);
        return view('posts',compact('posts','categories'));

    }

    public function PostByCategory($slug)
    {
        $categories = Category::all();
        $posts = Category::where('slug',$slug)->publish()->status()->first();
        return view('categoryPost',compact('posts','categories'));
    }

    public function PostByTag($slug)
    {
        $categories = Category::all();
        $posts = Tag::where('slug',$slug)->publish()->status()->first();
        return view('tagPost',compact('posts','categories'));
    }
}
