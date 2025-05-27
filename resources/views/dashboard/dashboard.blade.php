@extends('layouts.plantilla_dashboard')

@section('context')
    <h1>Bienvenido al Panel de Administración</h1>
    <p>Solo los administradores pueden acceder a esta página.</p>

<div id="app"></div>
    <script src="{{ mix('js/app.js') }}"></script>

@endsection
