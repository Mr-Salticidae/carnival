<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check in successfully</title>
</head>

<body>
    <h1>Welcome, {{ session('username') }}.</h1>
    @php
        header('Refresh:5; url=/checkin');
    @endphp
</body>

</html>