<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style_plantilla.css') }}?v={{ time() }}">
    <link rel="icon"  sizes="516x516" href="{{ asset('favicon_artify.ico') }}" type="image/x-icon">

</head>
<body>
    
    @include('layouts.cabecera')

    @include('layouts.carousel')
    
    @yield('context')

    @include('layouts.footer')
    

    <script src="{{ asset('js/menu_lateral.js') }}"></script>
    <script src="{{ asset('js/carousel.js') }}"></script>
</body>
</html>