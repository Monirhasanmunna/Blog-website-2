<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function store(Request $request , $post)
    {
        $request->validate([

            'comment' => 'required|max:1000',

        ]);

        $user = Auth::id();

        $comment = new Comment;

        $comment->post_id = $post;
        $comment->user_id = $user;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->back()->with('success','Comment Added Successfully');
    }


}
