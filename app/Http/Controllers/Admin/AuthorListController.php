<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthorListController extends Controller
{
    public function index()
    {
        $i = 1;
        $users = User::where('roles_id', 2)->get();
        return view('admin.author list.index',compact('users','i'));
    }

    public function show()
    {
        #
    }

    public function destroy()
    {
        
    }
}
