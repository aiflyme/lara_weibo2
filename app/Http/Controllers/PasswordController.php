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
    public function __construct()
    {
        //Access limit  2 times 1 minute
        $this->middleware('throttle:20,1',[
           'only' => ['showLinkRequestForm']
        ]);

        $this->middleware('throttle:30,10',[
           'only' => ['sendResetLinkEmail'],
        ]);
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        //1.check email
        $request->validate(['email'=> 'required|email']);
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
    public function showResetForm($token )
    {
        //$token = $request->
        return view('auth.passwords.reset', compact('token'));
    }

    public function reset(Request $request)
    {
        //1.check email
        $request->validate([
            'token' => 'required',
            'email'=> 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $email = $request->email;
        $token = $request->token;

        $expires = 60 * 60;

//        echo $request->token;
//        echo '<br>';
//        $hashToken = hash::make($request->token);
//
//        echo $hashToken;
//        echo '<br>';
//        echo Hash::check($request->token, $hashToken);
        //2. get user from db
//        $user = User::where([
//            'email'=> $email,
//        ])->firstOrFail();
        $user = (array)DB::table('users as u')
            ->leftJoin('password_reset_tokens as prt', 'u.email', '=', 'prt.email')
            ->select('u.email', 'prt.token','prt.created_at')
            ->where('u.email','=', $email)
            ->first();

        //3.if not exist
        if(is_null($user)){
            session()->flash('danger', 'User is not exist');
            return redirect()->back()->withInput();
        }

        //4.read the password_resets data
        //$record = (array)DB::table('password_reset_tokens')->where('email', $email)->first();

        //find the data
        if($user){
            //5.1 expire
            if(Carbon::parse($user['created_at'])->addSecond($expires)->isPast()){
                session()->flash('danger', '链接已过期，请重新尝试');
                return redirect()->back();
            }

            //5.2.token is right
            if(!Hash::check($token, $user['token'])){
                session()->flash('danger', '令牌错误');
                return redirect()->back();
            }
            //5.3 update password
            User::where('email',$email)->update([
                'password' => bcrypt($request->password),
            ]);
//            DB::table('users')
//                ->where('email',$email)
//                ->update(['password' => bcrypt($request->password)]);


            // 5.4. 提示用户更新成功
            session()->flash('success', '密码重置成功，请使用新密码登录');
            return redirect()->route('login');
        }


        // 6. 记录不存在
        session()->flash('danger', '未找到重置记录');
        return redirect()->back();
    }

}
