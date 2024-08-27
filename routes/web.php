<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\NoteController;

// Route::get('/', function () {
//     return view('welcome');
// });

// routes/web.php

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('verify-email/{token}', [RegisterController::class, 'verifyEmail'])->name('verify-email');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('forget-password', [AuthController::class, 'forgetpasswordLoad']);
Route::post('forget-password', [AuthController::class, 'forgetpassword'])->name('forget.password');
Route::get('reset-password/{token}', [AuthController::class, 'resetpasswordLoad']);
Route::post('reset-password/{token}', [AuthController::class, 'resetpassword'])->name('reset.password');

Route::post('change-password', [AuthController::class, 'changePassword'])->name('change-password');
Route::get('change-password', [AuthController::class, 'showChangePasswordForm'])->name('change-password.form');

// Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Route::get('forget-password', [ForgotPasswordController::class, 'forgetpasswordLoad']);
// Route::post('forget-password', [ForgotPasswordController::class, 'forgetpassword'])->name('forget.password');
// Route::get('reset-password', [ResetPasswordController::class, 'resetpasswordLoad']);
// Route::post('reset-password', [ResetPasswordController::class, 'resetpassword'])->name('reset.password');




// Route::middleware('auth')->group(function () {
    Route::get('/notes', [NoteController::class, 'index'])->name('notes');
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/notes/{id}', [NoteController::class, 'show']);
    Route::get('/notes/{id}/edit', [NoteController::class, 'edit']);
    Route::post('/notes/{id}/update', [NoteController::class, 'update']);
    Route::get('/notes/{id}/delete', [NoteController::class, 'destroy']);
// });