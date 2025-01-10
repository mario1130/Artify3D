<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
    <h1>Cabezera que no va a cambiar</h1> <hr> <br>
    @yield('content');
    <br> <hr>
    <h1>El footer</h1>

</body>
</html>