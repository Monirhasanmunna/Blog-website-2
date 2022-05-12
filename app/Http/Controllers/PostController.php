<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    public function index($slug)
    {

        $post = Post::where('slug',$slug)->first();
        $randomPost = Post::inRandomOrder()->limit(3)->get();
        $categories = Category::all();
        return view('post',compact('post','randomPost','categories'));
    }
}
