<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;


class AuthController extends Controller
{
    public function forgetpasswordLoad(){

         return view('auth.forgotPassword');
    }

    public function forgetpassword(Request $request)
    {
      $request->validate(['email' => 'required|email']);

      $user = User::where('email', $request->email)->first();

    if ($user) {
        $token = Str::random(40);
        
        // Check if a password reset record already exists for this email
        $passwordReset = PasswordReset::where('email', $user->email)->first();
        
        if ($passwordReset) {
            // Update the existing record
            $passwordReset->token = $token;
            $passwordReset->created_at = Carbon::now()->format('y-m-d H:i:s');
            $passwordReset->save();
        } else {
            // Create a new record
            $passwordReset = new PasswordReset;
            $passwordReset->email = $user->email;
            $passwordReset->token = $token;
            $passwordReset->created_at = Carbon::now()->format('y-m-d H:i:s');
            $passwordReset->save();
        }
        
        Mail::to($user->email)->send(new PasswordResetMail($token));
        return redirect()->back()->with('success', 'Password reset link has been sent to your email');
    } else {
        return redirect()->back()->with('error', 'Email is Not Exists');
    }
    }

    public function resetpasswordLoad($token)
    {
      $user = PasswordReset::where('token', $token)->first();
    if (!$user) {
        return redirect()->back()->with('error', 'Invalid token');
    }
    return view('auth.reset-password', ['token' => $token, 'email' => $user->email]);
        // $user = PasswordReset::where('token', $token)->first();
        // if (!$user) {
        //     return redirect()->back()->with('error', 'Invalid token');
        // }
        // return view('auth.reset-password', ['token' => $token]);
    }

    public function resetpassword(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('password_reset_token', $token)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Invalid token');
        }

        $user->password = Hash::make($request->input('password'));
        $user->password_reset_token = null;
        $user->save();
        return redirect()->back()->with('success', 'Password reset successfully');
    }
}
