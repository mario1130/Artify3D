@extends('layouts.plantilla')

@section('title', 'Página Principal')

@section('context')
    {{-- Aquí puedes poner tu sección de productos si quieres que siga viéndose --}}
    <section class="products">
        {{-- ... tus productos ... --}}
    </section>

    {{-- Aquí React se montará --}}
    <div id="app"></div>
    <script src="{{ mix('js/landing.js') }}"></script>
@endsection