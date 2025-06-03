@extends('layouts.plantilla')

@section('title', $product->name)

@section('context')
<div class="product-details">
    <img src="{{ asset($product->mainPhoto->photo_url ?? 'img/Default_product.png') }}" alt="{{ $product->name }}">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->precio }}€</p>
    <p>{{ $product->description }}</p>
</div>

    {{-- Botón para añadir a la lista de deseos --}}
    <button class="wishlist-button" onclick="toggleWishlistPopup()">Añadir a la lista de deseos</button>

{{-- Popup para seleccionar o crear una lista de deseos --}}
<div id="wishlist-popup" style="display: none;">
    {{-- Formulario para seleccionar una lista existente --}}
    <form action="{{ route('wishlist.store') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <label for="wishlist_group_id">Selecciona una lista:</label>
        <select name="wishlist_group_id" id="wishlist_group_id" required>
            @foreach ($wishlistGroups as $group)
                <option value="{{ $group->id }}">{{ $group->name }}</option>
            @endforeach
        </select>
        <button type="submit">Añadir</button>
    </form>

    <hr>

    {{-- Formulario para crear una nueva lista --}}
    <h2>Crear Nueva Lista</h2>
    <form action="{{ route('wishlist_group.store') }}" method="POST">
        @csrf
        <label for="new_wishlist_name">Nombre de la nueva lista:</label>
        <input type="text" name="name" id="new_wishlist_name" placeholder="Nombre de la lista" required>
        <button type="submit">Crear Lista</button>
    </form>

    <button onclick="toggleWishlistPopup()">Cerrar</button>
</div>

{{-- Formulario para añadir comentarios --}}
<div class="comments-section">
    <h2>Añadir un comentario</h2>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <textarea name="content" rows="4" placeholder="Escribe tu comentario aquí..." required></textarea>
        <button type="submit">Enviar</button>
    </form>
</div>

{{-- Mostrar comentarios existentes --}}
<div class="existing-comments">
    <h2>Comentarios</h2>
    @forelse ($product->comments as $comment)
        <div class="comment">
            <p><strong>{{ $comment->user->name }}</strong>:</p>
            <p>{{ $comment->content }}</p>
            @if ($comment->user_id === auth()->id())
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Eliminar</button>
                </form>
            @endif
        </div>
    @empty
        <p>No hay comentarios aún.</p>
    @endforelse
</div>

<script>
    function toggleWishlistPopup() {
        const popup = document.getElementById('wishlist-popup');
        popup.style.display = popup.style.display === 'none' ? 'block' : 'none';
    }
</script>
@endsection


