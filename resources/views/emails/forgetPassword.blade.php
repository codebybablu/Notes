<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Request</title>
</head>
<body>
    <h1>Password Reset Request</h1>
    <p>We received a request to reset your password. Click the button below to reset it:</p>
    <a href="{{ url('reset-password'.$token) }}" style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #fff; background-color: #007bff; text-decoration: none; border-radius: 5px;">Reset Password</a>
    <p>If you did not request this change, please ignore this email.</p>
    <p>Thank you!</p>
</body>
</html>



{{-- @if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif --}}

{{-- forgetPassword.blade.php --}}

{{-- <h1>Reset Password</h1>

<p>Click on the link below to reset your password:</p>

<a href="{{ url('reset-password') }}">Reset Password</a> --}}