<?php

namespace App\Http\Controllers;

use App\Category;
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
        $categories = Category::all();

        $postKey = 'Post'.$post->id;
        if(!Session::has($postKey))
        {
            $post->increment('view_count');
            Session::put($postKey,1);
        }

        return view('post',compact('post','randomPost','categories'));
    }
}
