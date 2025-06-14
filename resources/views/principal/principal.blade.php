@extends('layouts.plantilla')

@section('title', 'Página Principal')

@section('context')

    {{-- React --}}
    <div id="app"></div>
    <script src="{{ mix('js/landing.js') }}"></script>

@endsection
