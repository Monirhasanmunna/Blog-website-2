<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add($post)
    {
        $user = Auth::user();
        $isFavorite = $user->favorite_to_post()->where('post_id',$post)->count();

        if($isFavorite == 0)
        {
            $user->favorite_to_post()->attach($post);
            return redirect()->back();
        }else{

            $user->favorite_to_post()->detach($post);
            return redirect()->back();
        }
    }
}
