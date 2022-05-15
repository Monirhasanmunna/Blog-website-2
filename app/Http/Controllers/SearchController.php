<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $categories = Category::all();
        $search = $request->input('search');
        $posts = Post::where('title','LIKE',"%{$search}%")->orWhere('body', 'LIKE', "%{$search}%")->get();
        return view('search',compact('posts','categories','search'));

    }

}
