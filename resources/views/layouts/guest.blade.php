<!doctype html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css'])

</head>

<body style="background-color: #f9fafc ;">
    {{ $slot }}
</body>
@vite(['resources/js/app.js'])

</html>
