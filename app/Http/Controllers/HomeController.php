<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::latest()->publish()->status()->take(6)->get();
        $categories = Category::all();
        return view('welcome',compact('categories','posts'));
    }
}
