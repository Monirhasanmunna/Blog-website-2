<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;

class Subscribers extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'email|unique:subscribers'
        ]);

        $subscribe = new Subscriber;
        $subscribe->email = $request->email;
        $subscribe->save();

        return redirect()->back()->with('success','Thanks to your Subscription');

    }
}
