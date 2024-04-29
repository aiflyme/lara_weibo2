<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        //1.check email
        $request->validate(['email'=> 'required|email'] );
        $email = $request->email;

        //2.get user from db
        $user = User::where('email', $email)->first();

        //3.if not exist
        if(is_null($user)){
            session()->flash('danger', 'Email is not registration');
            return redirect()->back()->withInput();
        }

        //4.generate token
        $token = hash_hmac('sha256', Str::random(40), config('app.key'));

        //store token to db
        DB::table('password_reset_tokens')->updateOrInsert(['email' => $email],[
            'email' => $email,
            'token' => Hash::make($token),
            'created_at' => new Carbon,
        ]);

        //6.send email

        $view = 'emails.reset_link';
        $date = compact('token');
        $to = $email;
        $subject = 'Thank you register Weibo.com! please confirm you email address!.';

        Mail::send($view, $date, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });

        session()->flash('success', 'Email send success, please check you mailbox!');
            return redirect()->back();
    }
    public function showResetForm()
    {

    }

    public function reset()
    {

    }

}
