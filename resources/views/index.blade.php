@extends('layouts.plantilla')

@section('title', 'Artify3D')

@section('context')
    @if (session('success'))
        <div id="popup-success"
            style="position:fixed;top:30px;left:50%;transform:translateX(-50%);background:#22c55e;color:white;padding:20px 40px;border-radius:8px;z-index:9999;font-size:1.2rem;box-shadow:0 2px 12px #0008;">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('popup-success').style.display = 'none';
            }, 3000);
        </script>
    @endif
    {{-- @include('layouts.carousel') --}}
    @include('principal.principal')
@endsection
