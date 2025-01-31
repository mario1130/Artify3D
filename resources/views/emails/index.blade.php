@extends('layouts.plantilla')
@section('title','Contactanos')
@section('context')

    <h1>Contáctanos</h1>

    <form action="{{route('contacto.store')}}" method="POST">
    @csrf

    <label>
        Nombre:<input name="nombre">
    </label>
    <br>
    <label>
        Correo:<input name="correo">
    </label>
    <br>
    <label>
        Mensaje:<textarea name="mensaje"></textarea>
    </label>
    <br>
    <button type="submit" style="width: 10%">Enviar</button>
    </form>
    
@endsection