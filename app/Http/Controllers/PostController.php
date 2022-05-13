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

        $post = Post::where('slug',$slug)->first();
        $randomPost = Post::inRandomOrder()->limit(3)->get();
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
        $posts = Post::latest()->paginate(10);
        return view('posts',compact('posts','categories'));

    }

    public function PostByCategory($slug)
    {
        $categories = Category::all();
        $posts = Category::where('slug',$slug)->first();
        return view('categoryPost',compact('posts','categories'));
    }
}
