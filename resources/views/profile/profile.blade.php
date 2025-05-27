@extends('layouts.plantilla_user_menu')

@section('title', 'Perfil')


@section('context')

<style>.profile-container {
    margin: 2rem auto;
    padding: 1rem;
    max-width: 600px;
    border: 1px solid #ccc;
    border-radius: 8px;
}

.profile-container h1 {
    text-align: center;
    margin-bottom: 1rem;
}

.profile-details p {
    font-size: 1.2rem;
    margin: 0.5rem 0;
}

.profile-picture {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 1rem;
    border: 2px solid #ccc;
}

</style>
<div class="profile-container">
    <h1>Perfil de Usuario</h1>
    <img class="profile-picture" src="{{ auth()->user()->profile_picture ?? asset('images/default-profile.png') }}" alt="Foto de Perfil">
    <div class="profile-details">
        <p><strong>Nombre:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Fecha de Creación:</strong> {{ auth()->user()->created_at->format('d/m/Y') }}</p>
        <p><strong>Última Actualización:</strong> {{ auth()->user()->updated_at->format('d/m/Y') }}</p>
    </div>
</div>
@endsection
    


