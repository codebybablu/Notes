<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\SendPasswordEmail;
use App\Mail\VerifyEmail;
use App\Mail\SendPasswordEmail as MailSendPasswordEmail;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = null; // Set email_verified_at to null to indicate that the email is not verified
        $user->save();

        // Generate a verification token
        $token = Str::random(40);
        $user->verification_token = $token;
        $user->save();

        // Send a verification email to the user
        Mail::to($user->email)->send(new VerifyEmail($user, $token));

        return redirect()->route('login')->with('success', 'Registration Successfully. Please verify your email address.');
    }

    public function verifyEmail(Request $request)
    {
    $user = User::where('verification_token', $request->token)->first();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Invalid verification token');
    }

    $user->email_verified_at = now();
    $user->verification_token = null;
    $user->is_active = 1; // Activate the user
    $user->save();

    Auth::login($user);

    return redirect()->route('login')->with('success', 'Email verified successfully. You are now logged in.');
    }

    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    
    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);
    //     $user->save();
     
    //     return redirect()->route('login')->with('success', 'Registration Successfully');
    // }
}