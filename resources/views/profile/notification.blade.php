@extends('layouts.plantilla_user_menu')

@section('title', 'Wishlist')

@section('context')
<div class="container">
    <h1>Notificaciones</h1>
    @forelse (auth()->user()->notifications as $notification)
        <div class="notification">
            <p>{{ $notification->data['message'] }}</p>
            {{-- <a href="{{ $notification->data['url'] }}">Ver más</a> --}}
            <a href="{{ route('notifications.read', $notification->id) }}">Ver más</a>
            <a href="{{ route('notifications.delete', $notification->id) }}">Eliminar</a>
        </div>
    @empty
        <p>No tienes notificaciones.</p>
    @endforelse
</div>
@endsection

