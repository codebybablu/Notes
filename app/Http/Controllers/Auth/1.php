<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    // ForgotPasswordController.php
    public function forgetpasswordLoad()
    {
        return view('auth.forgotPassword');
    }

    public function forgetpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => now()
        ]);

        Mail::send('emails.forgetPassword', ['token' => $token], function($message) use($request) {
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    // public function forgetpasswordLoad()
    // {
    //     return view('auth.forgotPassword');
    // }

    // public function sendResetLinkEmail(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users',
    //     ]);

    //     $token = Str::random(64);

    //     DB::table('password_reset_tokens')->insert([
    //         'email' => $request->email,
    //         'token' => $token,
    //         'created_at' => Carbon::now()
    //     ]);
        
    //     Mail::send('email.PasswordResetEmail', ['token' => $token], function ($message) use ($request) {
    //         $message->to($request->email);
    //         $message->subject('Reset Password');
    //     });

    //     return back()->with('message', 'We have sent email for password reset link!');
    // }
}
