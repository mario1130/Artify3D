@extends('layouts.plantilla')

@section('title', 'Artify3D')
@section('1', 'img/1.jpg')
@section('2', 'img/2.jpg')
@section('3', 'img/3.jpg')

@section('context')
    @include('layouts.carousel')
    @include('layouts.principal') 
@endsection

