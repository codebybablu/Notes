<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body>
    {{-- ResettPassword.blade.php --}}
    <h3> Reset Password  </h3>

    @if (session('success'))
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
    @endif

    {{-- @if($errors->any())
        @foreach ($errors->all() as $error)
        <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif --}}

    <form action="{{ route('reset.password') }}" method="POST">
        @csrf

        {{-- <input type="hidden" name="id" value="{{ $user->id }}">  --}}
        <input type="hidden" name="id" value="{{ $user[0]['id'] }}">
        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter Password" ><br><br>
        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" placeholder="Enter Confirm Password" ><br><br>
        <button type="submit">Reset Password</button>
    </form><br>

    <a href="{{ route('login') }}" > Login </a>

</body>
</html>