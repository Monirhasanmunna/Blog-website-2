<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class SettingsController extends Controller
{
    public function index()
    {
        $user = User::FindorFail(Auth::id());
        return view('admin.settings.index',compact('user'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([

            'fullname' => 'sometimes',
            'username' => 'sometimes',
            'email'    => 'sometimes|email',
            'image'    => 'sometimes|image|mimes:jpg,png,jpeg,gif,svg|max:2048'

        ]);

        $user = User::FindorFail($id);

        $image = $request->file('image');

        $slug = Str::slug($request->username);

        if(isset($image))
        {
            //make unique name for image
            $currentdate= Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('user'))
            {
                Storage::disk('public')->makeDirectory('user');
            }

            $postImage = Image::make($image)->resize(360,360)->stream();
            Storage::disk('public')->put('user/'.$imageName,$postImage);
        }else{

            $imageName = 'default.png';
        }

        $user->name = $request->fullname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();

        Session::flash('success','User Information Updated Succesfully');
        return redirect()->back();

    }
}
