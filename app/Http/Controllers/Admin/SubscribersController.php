<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscriber;
use Illuminate\Support\Facades\Session;

class SubscribersController extends Controller
{
    public function index()
    {
        $i=1;
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscribe',compact('subscribers','i'));
    }

    public function delete($id)
    {
        Subscriber::findorFail($id)->delete();

        Session::flash('success','Subscriber Deleted Successfully');
        return redirect()->back();

    }
}
