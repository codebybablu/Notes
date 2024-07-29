<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{

    // ResetPasswordController.php
  public function resetpasswordLoad(Request $request)
    {
        return view('auth.reset-password', ['token' => $request->token]);
    }

    public function resetpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ]);

        $passwordReset = DB::table('password_resets')
            ->where([
              'email' => $request->email, 
              'token' => $request->token
            ])
            ->first();

        if (!$passwordReset) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }
    
    // public function resetpasswordLoad()
    // {
    //   $user = Auth::user();
    //   return view('auth.ResettPassword', compact('user'));
    // }

    // public function resetpassword(Request $request)
    // {
    //     try{
    //         $user = User::where('email', $request->email)->get();

    //         if(count($user) > 0){

    //           $token = Str::random(40);
    //           $domain = URL::to('/');
    //           $url = $domain.'/reset-password?token='.$token;

    //           $data['url'] = $url;
    //           $data['email'] = $request->email;
    //           $data['title'] = 'Password Reset';
    //           $data['body'] = 'Please click on below link to reset your password.';

    //           Mail::send('auth.resetPasswordMail', ['data'=>$data],function($message) use($data){
    //               $message->to($data['email'])->subject($data['title']);
    //           });

    //         $dateTime = Carbon::now()->format('y-m-d H:i:s');
              
    //           PasswordReset::updateOrCreate(
    //               ['email'=>$request->email],
    //               [
    //                   'email' => $request->email,
    //                   'token' => $token,
    //                   'created_at' => $dateTime
    //               ]
                     
    //           );
    //           return back()->with('success', 'Please Check Your Email to reset your password.'); 

    //         }
    //         else{
    //           return back()->with('error', 'Email is Not Exists');
    //         }

    //       }catch(\Exception $e){
    //           return back()->with('error', $e->getMessage());
    //       }
    // }

    // public function updatepassword(Request $request)
    //     {
    //         $request->validate([
    //             'password' => 'required|string|min:3|confirmed'
    //         ]);

    //        $user = User::find($request)->first();
    //        $user->password = Hash::make($request->password);
    //        $user->save();
        
    //        PasswordReset::where('email', $user->email)->delete();

    //        return "<h2>Your Password has been reset successfully.</h2>";
    //     }
}