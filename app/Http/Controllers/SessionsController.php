<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Session;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
           'only' => ['create']
        ]);

        //Access limit
        $this->middleware('throttle:10,10',[
            'only' => ['store'],
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
            if(Auth::user()->activated){
                session()->flash('success', 'Welcome back '. Auth::user()->name . ' !');
                $fallback = route('users.show', Auth::user());
                return redirect()->intended($fallback);
            }

            Auth::logout();
            session()->flash('warning', 'You account does not activate, please check you email address and activate the account first');
            return redirect();
            //return redirect()->route('users.show', [Auth::user()]);
        }

        session()->flash('danger', 'Sorry, you email or password is not right');
        return redirect()->back()->withInput();
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', 'You have logout!');
        return redirect('/');
    }


}
