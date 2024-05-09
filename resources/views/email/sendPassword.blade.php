<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="{{asset('css/sendPassword.css')}}">
</head>

<body>
    <div class="container">

        <div class="message">
            <p>Dear {{ $mailData['name'] }},</p>
            <p>I am From Bulletin Board</p>
            <hr>
            <p>Your new password is - {{ $mailData['newPassword'] }}</p>
            <hr>
            <p>Please login and change password!</p>
        </div>

    </div>
</body>

</html>
