<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'class' => 'required'
        ]);

        \App\User::whereId(Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'class' => $request->class
        ]);

        Session::flash('message', 'Profile updated');
        return redirect(route('plans.index'));
    }
}
