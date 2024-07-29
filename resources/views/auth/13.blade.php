<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password</title>
</head>
<body>

    {{-- forgotPassword.blade.php --}}
    <h3> Put Your Email ID  </h3>

    @if($errors->any())
        @foreach ($errors->all() as $error)
        <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif

    @if(Session::has('error'))
    <p style="color:red;">{{ Session::get('error') }}</p>
    @endif

    @if(Session::has('success'))
    <p style="color:green;" >{{ Session::get('success') }}</p>
    @endif

    <form action="{{ route('reset.password') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        <button type="submit">Send Password Reset Link</button>
    </form><br>

    <a href="{{ route('login') }}" > Login </a>

</body>
</html>