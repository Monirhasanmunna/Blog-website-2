<?php

namespace App\Http\Controllers\Author;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        $user = Auth::user();
        $post = Post::publish()->get();
        $userPost = $user->posts()->publish()->get();
        $comments = $user->posts()->first();
        $pendingPost = $user->posts()->where('is_approved', 0)->get();
        return view('author.dashboard',compact('post','userPost','comments','pendingPost'));
        
       }
}
