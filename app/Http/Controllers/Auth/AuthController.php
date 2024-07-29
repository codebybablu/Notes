<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    // public function forgetpasswordLoad(){

    //     return view('auth.forget-password');
    
    // }

    // public function forgetpassword(Request $request){

    //     // dd($request);

    //     try{
    //       $user = User::where('email', $request->email)->get();

    //       if(count($user) > 0){

    //         $token = Str::random(40);
    //         $domain = URL::to('/');
    //         $url = $domain.'/reset-password?token='.$token;

    //         $data['url'] = $url;
    //         $data['email'] = $request->email;
    //         $data['title'] = 'Password Reset';
    //         $data['body'] = 'Please click on below link to reset your password.';

    //         Mail::send('emails.forget-password', ['data'=>$data],function($message) use($data){
    //             $message->to($data['email'])->subject($data['title']);
    //         });

    //       $dateTime = Carbon::now()->format('y-m-d H:i:s');
            
    //         PasswordReset::updateOrCreate(
    //             ['email'=>$request->email],
    //             [
    //                 'email' => $request->email,
    //                 'token' => $token,
    //                 'created_at' => $dateTime
    //             ]
                   
    //         );
    //         return back()->with('success', 'Please Check Your Email to reset your password.'); 

    //       }
    //       else{
    //         return back()->with('error', 'Email is Not Exists');
    //       }

    //     }catch(\Exception $e){
    //         return back()->with('error', $e->getMessage());
    //     }

    // }

    // // old --
    // public function resetpasswordLoad(Request $request)
    // {
    //  $resetData = PasswordReset::where('token', $request->token)->get();

    //  if(isset($request->token) && count($resetData) > 0){
        
    //   $user = User::where('email',$resetData[0]['email'])->get();

    //     return view('auth.resetPassword', compact('user'));

    //  }
    //  else{
    //     return view('auth.404');
    //  }

    // }

    // // old --
    // public function resetpassword(Request $request)
    // {
    //     // dd($request->all());
    //     // dd($request);
    //     $request->validate([
    //         'password' => 'required|string|min:3|confirmed'
    //     ]);

    // //    $user = User::where('password', $request->$id)->first();
    // //    $user = User::where('password', $request->password)->first();
    // //    $user = User::where($request->id)->first();
    // //    $user = User::find($request->$id);
    //    $user = User::find($request)->first();
    // //    $user = User::find($request->$id)->first();
        
    //    // dd($user);
    // //    dd($user);
    //    $user->password = Hash::make($request->password);
    //    $user->save();
    // //    dd($user);

    //    PasswordReset::where('email', $user->email)->delete();

    //    return "<h2>Your Password has been reset successfully.</h2>";
    // }

    //old 2 code 
    // public function forgetpasswordLoad()
    // {
    //     return view('auth.forget-password');
    // }

    // public function forgetpassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //     ]);

    //     $token = Str::random(40);

    //     PasswordReset::updateOrCreate([
    //         'email' => $request->email,
    //         'token' => $token,
    //         'created_at' => now()
    //     ]);
    //     // PasswordReset::create([
    //     //     'email' => $request->email,
    //     //     'token' => $token,
    //     //     'created_at' => now()
    //     // ]);

    //     Mail::send('emails.forget-password', ['token' => $token], function($message) use($request) {
    //         $message->to($request->email);
    //         $message->subject('Reset Password Notification');
    //     });

    //     return back()->with('message', 'We have e-mailed your password reset link!');
    // }

    // public function resetpasswordLoad(Request $request)
    // {
    //     return view('auth.reset-password', ['token' => $request->token]);
    // }

    // public function resetpassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|string|min:8|confirmed',
    //         'token' => 'required'
    //     ]);

    //     $passwordReset = PasswordReset::where([
    //         ['email', $request->email],
    //         ['token', $request->token]
    //     ])->first();

    //     if (!$passwordReset) {
    //         return back()->withInput()->with('error', 'Invalid token!');
    //     }

    //     $user = User::where('email', $request->email)->first();
    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     PasswordReset::where('email', $request->email)->delete();

    //     return redirect('/login')->with('message', 'Your password has been changed!');
    // }

    // old code
    // public function forgetpasswordLoad()
    // {
    //     return view('auth.forget-password');
    // }

    // public function forgetpassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //     ]);

    //     $token = Str::random(64);
    //     // password_resets
    //     DB::table('password_reset_tokens')->insert([
    //         'email' => $request->email, 
    //         'token' => $token, 
    //         'created_at' => now()
    //     ]);

    //     Mail::send('emails.forget-password', ['token' => $token], function($message) use($request) {
    //         $message->to($request->email);
    //         $message->subject('Reset Password Notification');
    //     });

    //     return back()->with('message', 'We have e-mailed your password reset link!');
    // }

    // public function resetpasswordLoad(Request $request)
    // {
    //     return view('auth.reset-password', ['token' => $request->token]);
    // }

    // public function resetpassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|string|min:8|confirmed',
    //         'token' => 'required'
    //     ]);
    //     //password_resets
    //     $passwordReset = DB::table('password_reset_tokens')
    //         ->where([
    //           'email' => $request->email, 
    //           'token' => $request->token
    //         ])
    //         ->first();

    //     if (!$passwordReset) {
    //         return back()->withInput()->with('error', 'Invalid token!');
    //     }

    //     $user = User::where('email', $request->email)->first();
    //     $user->password = Hash::make($request->password);
    //     $user->save();
    //     // password_resets
    //     DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

    //     return redirect('/login')->with('message', 'Your password has been changed!');
    // }
}
