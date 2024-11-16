<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác minh OTP</title>
</head>

<body>
    <h1>Xác minh OTP</h1>
    <form method="POST" action="{{ route('verify.store') }}">
        @csrf
        <label for="otp">Nhập mã OTP:</label>
        <input type="text" name="otp" id="otp" required>
        <button type="submit">Xác minh</button>
    </form>

    @if ($errors->has('otp'))
        <p style="color: red;">{{ $errors->first('otp') }}</p>
    @endif
</body>

</html>
