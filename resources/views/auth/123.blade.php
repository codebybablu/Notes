<!DOCTYPE html>
<html>
<head>
    <title>Forget Password</title>
</head>
<body>
    <form action="{{ route('forget.password') }}" method="POST">
        @csrf
        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <button type="submit">Send Password Reset Link</button>
    </form>
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif
</body>
</html>


{{-- forget-password.blade.php --}}
{{-- <!DOCTYPE html>
<html>
<head>
    <title>Forget Password</title>
</head>
<body>
    <form action="{{ route('forget.password') }}" method="POST">
        @csrf
        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <button type="submit">Send Password Reset Link</button>
    </form>
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif
</body>
</html> --}}
