<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <form action="{{ route('reset.password', $token) }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $user->email }}">
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit">Reset Password</button>
    </form>
    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif
    @if (session('sucess'))
        <p>{{ session('sucess') }}</p>
    @endif
</body>
</html>
