<?php

namespace App\Http\Controllers;
use App\Models\District;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function userProfile()
    {
        $user = auth()->user()->get();
        $districts = District::all();
        //$practices = auth()->user()->practices()->get();
        return view('user.profile.show',compact('user','districts'));
    }
    public function adminProfile()
    {
        $user = auth()->user()->get();
        return view('admin.profile.show',compact('user'));
    }

    public function evaluatorProfile()
    {
        $user = auth()->user()->get();
        return view('evaluator.profile.show',compact('user'));
    }

    
}
