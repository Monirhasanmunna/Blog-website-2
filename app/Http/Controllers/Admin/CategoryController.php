<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = 1;
        $categories = Category::latest()->get();
        return view('admin.categories.index',compact('categories','i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'. uniqid().'.'.$image->getClientOriginalExtension();

            // Check Category Derectory is Exist
            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }

            // resize igame for category and upload
            $category = Image::make($image)->resize(1600,479)->stream();
            Storage::disk('public')->put('category/'.$imageName,$category);

             // Check Category/slider Derectory is Exist
            if(!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            // resize igame for slider and upload
            $slider = Image::make($image)->resize(500,333)->stream();
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);
        }

        $category = New Category;

        $category->name = $request->name;
        $category->slug =  Str::slug($request->name);;
        $category->image = $imageName;

        $category->save();

        Session::flash('success','Category Added Successfully');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::find($id);
        return view('admin.categories.edit',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'sometimes|mimes:jpeg,png,jpg',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);
        $categories = Category::find($id);

        if(isset($image))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'. uniqid().'.'.$image->getClientOriginalExtension();

            // Check Category Derectory is Exist
            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }

            // delete category old image
            if(Storage::disk('public')->exists('category/'.$categories->image))
            {
                Storage::disk('public')->delete('category/'.$categories->image);
            }

            // resize igame for category and upload
            $category = Image::make($image)->resize(1600,479)->stream();
            Storage::disk('public')->put('category/'.$imageName,$category);

             // Check Category/slider Derectory is Exist
            if(!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            // delete category old image
            if(Storage::disk('public')->exists('category/slider/'.$categories->image))
            {
                Storage::disk('public')->delete('category/slider/'.$categories->image);
            }

            // resize igame for slider and upload
            $slider = Image::make($image)->resize(500,333)->stream();
            Storage::disk('public')->put('category/slider/'.$imageName,$slider);

        }else{

            $imageName = $categories->image;

        }


        $categories->name = $request->name;
        $categories->slug =  Str::slug($request->name);;
        $categories->image = $imageName;
        $categories->save();

        Session::flash('success','Category Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        // category image delete
        if(Storage::disk('public')->exists('category/'.$category->image))
        {
            Storage::disk('public')->delete('category/'.$category->image);
        }

        // category slider image delete
        if(Storage::disk('public')->exists('category/slider/'.$category->image))
        {
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }

        $category->delete();

        Session::flash('success','Category Deleted Successfully');
        return redirect()->back();
    }
}
