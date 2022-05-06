<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Tag;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i=1;
        $posts = Post::latest()->get();
        return view('admin.post.index',compact('posts','i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts',
            'image' => 'required|mimes:jpeg,png,jpg',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);


        $image = $request->file('image');

        $slug = Str::slug($request->title);

        if(isset($image))
        {
            //make unique name for image
            $currentdate= Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        }else{

            $imageName = 'default.png';
        }


        $post = New Post;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->image = $imageName;
        $post->slug = $slug;
        $post->body = $request->body;

        if(isset($request->status))
        {
            $post->status = true;
        }else{
            $post->status = false;
        }

        $post->is_approved = true;
        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        Session::flash('success','Post Added Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       return view('admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit',compact('categories','tags','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'sometimes|mimes:jpeg,png,jpg',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);


        $image = $request->file('image');

        $slug = Str::slug($request->title);

        if(isset($image))
        {
            //make unique name for image
            $currentdate= Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            //delete old pic
            if(Storage::disk('public')->exists('post/'.$post->image))
            {
                Storage::disk('public')->delete('post/'.$post->image);
            }

            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        }else{

            $imageName = $post->image;
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->image = $imageName;
        $post->slug = $slug;
        $post->body = $request->body;

        if(isset($request->status))
        {
            $post->status = true;
        }else{
            $post->status = false;
        }

        $post->is_approved = true;
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Session::flash('success','Post Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists('post/'.$post->image))
            {
                Storage::disk('public')->delete('post/'.$post->image);
            }

        $post->delete();
        Session::flash('success','Post Deleted Successfully');
        return redirect()->back();
    }
}
