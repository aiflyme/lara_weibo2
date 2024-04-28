<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
           'only' => ['create']
        ]);
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request,[
            'email' => 'required|email|max:50',
            'password' => 'required'
        ]);


//        $credentials = $request->only('email', 'password');
        //if(Auth::attempt(['email'=>$email, 'password'=>$password])){
        if(Auth::attempt($credentials, $request->has('remember'))){

            session()->flash('success', 'Welcome back '. Auth::user()->name . ' !');
            $fallback = route('users.show', Auth::user());
            return redirect()->intended($fallback);
            //return redirect()->route('users.show', [Auth::user()]);
        }else{
            session()->flash('danger', 'Sorry, you email or password is not right');
            return redirect()->back()->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', 'You have logout!');
        return redirect('/');
    }
}
