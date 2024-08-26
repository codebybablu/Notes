<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $credentials = $request->only(['email', 'password']);

    $user = User::where('email', $request->email)->first();

    if (!$user || !$user->email_verified_at) {
        return redirect()->back()->with('error', 'Please verify your email address before logging in.');
    }

    if (Auth::attempt($credentials)) {
        return redirect()->route('notes');
    }

    return redirect()->back()->with('error' , 'Invalid email or password');
    }

    // old code working --
    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|email',
    //         'password' => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $credentials = $request->only(['email', 'password']);

    //     if (Auth::attempt($credentials)) {
    //         return redirect()->route('notes');
    //     }

    //     return redirect()->back()->withErrors(['Invalid email or password']);
    // }

        public function logout(Request $request)
        {
            Session::flush();
            Auth::logout();

            return redirect()->route('login');
        }
}
