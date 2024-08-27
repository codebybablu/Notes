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
use Illuminate\Support\Facades\Auth;

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
            // $passwordReset->expires_at = Carbon::now()->addMinutes(1)->format('y-m-d H:i:s');
            $passwordReset->save();
        } else {
            // Create a new record
            $passwordReset = new PasswordReset;
            $passwordReset->email = $user->email;
            $passwordReset->token = $token;
            $passwordReset->created_at = Carbon::now()->format('y-m-d H:i:s');
            // $passwordReset->expires_at = Carbon::now()->addMinutes(1)->format('y-m-d H:i:s');
            $passwordReset->save();
        }
        
        Mail::to($user->email)->send(new PasswordResetMail($token));
        return redirect()->back()->with('success', 'Password reset link has been sent to your email');
    } else {
        return redirect()->back()->with('error', 'Email is Not Exists');
    }
    }

    public function resetpasswordLoad(Request $request)
    {
      $token = $request->token;
    $user = PasswordReset::where('token', $token)->first();

    if ($user) {
        $email = $user->email;
        $user = User::where('email', $email)->first();

        return view('auth.reset-password', compact('user', 'token'));
    } else {
        return view('auth.404');
    }


    // -- one minutes validation token --
    // $token = $request->token;
    // $passwordReset = PasswordReset::where('token', $token)->first();

    // if (!$passwordReset) {
    //     return redirect()->back()->with('error', 'Invalid token');
    // }

    // if ($passwordReset->expires_at < Carbon::now()) {
    //     return redirect()->back()->with('error', 'Token has expired. Please request a new password reset link.');

    //

    // -- old
      // if (!$user) {
    //     return redirect()->back()->with('error', 'Invalid token');
    // }
   // return view('auth.reset-password', ['token' => $token]);
        // $user = PasswordReset::where('token', $token)->first();
        // if (!$user) {
        //     return redirect()->back()->with('error', 'Invalid token');
        // }
        // return view('auth.reset-password', ['token' => $token]);
    }

    public function resetpassword(Request $request)
    {
      $request->validate([
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
    ]);

    $passwordReset = PasswordReset::where('token', $request->token)->first();
    if (!$passwordReset) {
        return redirect()->back()->with('error', 'Invalid token');
    }

    $user = User::where('email', $passwordReset->email)->first();
    $user->password = bcrypt($request->password);
    $user->save();

    // Delete the password reset token
    $passwordReset->delete();

    return redirect()->route('login')->with('success', 'Password has been reset successfully');
    }

    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('old_password', 'The old password is incorrect.');
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password changed successfully!');
    }
}
