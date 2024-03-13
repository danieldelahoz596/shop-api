<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify your email</title>
</head>

<body>
    hi {{ $name }} , you are successfully registered. Verifying your email <a
        href="{{ env('APP_URL').'/verify/'.$token }}">here</a>
</body>

</html>