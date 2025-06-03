{{-- filepath: /home/futvibeitecfp/www/Artify3D/resources/views/profile/wishlist_groups.blade.php --}}
@extends('layouts.plantilla_user_menu')

@section('title', 'Mis Listas de Deseos')

@section('context')
<div class="container">
    <h1>Mis Listas de Deseos</h1>
    <div class="wishlist-groups">
        @forelse ($wishlistGroups as $group)
            <div class="wishlist-group-item">
                <h2>{{ $group->name }}</h2>
                <form action="{{ route('wishlist_group.destroy', $group->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar Lista</button>
                </form>
                <a href="{{ route('wishlist.index', $group->id) }}" class="view-list-button">Ver Productos</a>
            </div>
        @empty
            <p>No tienes listas de deseos creadas.</p>
        @endforelse
    </div>

    <div class="create-wishlist-group">
        <h2>Crear Nueva Lista de Deseos</h2>
        <form action="{{ route('wishlist_group.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nombre de la lista" required>
            <button type="submit">Crear Lista</button>
        </form>
    </div>
</div>
@endsection