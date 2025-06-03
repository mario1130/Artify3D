{{-- filepath: /home/futvibeitecfp/www/Artify3D/resources/views/profile/wishlist.blade.php --}}
@extends('layouts.plantilla_user_menu')

@section('title', 'Lista de Deseos')

@section('context')
<div class="container">
    <h1>Lista de Deseos: {{ $wishlistGroup->name }}</h1>
    <div class="wishlist">
        @forelse ($wishlists as $wishlist)
            <div class="wishlist-item">
                <h2>{{ $wishlist->product->name }}</h2>
                <p>{{ $wishlist->product->precio }}€</p>
                <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </div>
        @empty
            <p>No tienes productos en tu lista de deseos.</p>
        @endforelse
    </div>
</div>
@endsection