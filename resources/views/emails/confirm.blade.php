<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm Mail</title>
</head>
<body>
    <h1>Thank you register in Weibo App!</h1>

    <p>
        Please click the register link below:
        <a href="{{ route('confirm_email', $user->activation_token) }}">
            Click Me!
        </a>
    </p>

    <p>
        f this email does not concern you, please disregard it.
    </p>
</body>
</html>
