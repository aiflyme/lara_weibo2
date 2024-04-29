<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>find password</title>
</head>
<body>
    <h1>You are trying to find out you password</h1>

    <p>
        Please click the register link below:：
        <a href="{{ route('password.reset', $token) }}">
            Click Me!
        </a>
    </p>

    <p>
        if this email does not concern you, please disregard it.
    </p>
</body>
</html>
