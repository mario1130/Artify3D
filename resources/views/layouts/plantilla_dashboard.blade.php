<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/favicon_artify.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_plantilla_dashboard.css') }}?v={{ time() }}">

</head>
<body class="@yield('body-class', 'default-body')">


    @include('layouts.cabecera_dashboard')
    

    <main style="margin-left: 5rem">
        @yield('context')
    </main>

    {{-- @include('layouts.footer') --}}
    

</body>
</html>