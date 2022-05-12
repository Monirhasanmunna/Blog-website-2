<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Post;

class FavoriteController extends Controller
{
    public function index()
    {
        $i=1;
        $posts = Auth::user()->favorite_to_post;
        return view('admin.favorite.index',compact('posts','i'));
    }

    // public function show($post)
    // {
    //     $post = Post::where('id',$post)->get();
    //     return $post;
    //     return view('admin.favorite.show',compact('post'));
    // }

    public function destroy($post)
    {
        $user = Auth::user();
        $user->favorite_to_post()->detach($post);
        Session::flash('success','Remove this favorite post succesfully');
        return redirect()->back();
    }
}
