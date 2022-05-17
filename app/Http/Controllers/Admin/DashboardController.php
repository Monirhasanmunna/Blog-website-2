<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(){

      $post = Post::publish()->get();
      $user = User::where('roles_id',2)->get();
      $comment = Comment::all();
      $pendingPost = Post::where('is_approved',0)->get();
      return view('admin.dashboard',compact('post','user','comment','pendingPost'));
    
   }
}
