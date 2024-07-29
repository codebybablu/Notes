<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $data['title'] }}</title>
</head>
<body>
    {{-- resetPasswordMail.blade.php --}}
    <p>{{ $data['body'] }}</p>
    <a href="{{ $data['url'] }}">Click here to reset your password</a>
    <p>Thank you!</p>
</body>
</html>