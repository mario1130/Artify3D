@extends('layouts.plantilla_user_menu')

@section('title', 'Lista de Deseos')

@section('context')
<style>
    .main-content {
        width: 100%;
        max-width: 900px;
        text-align: center;
        margin: 0 auto;
    }
    .wishlist-header {
        text-align: left;
        font-size: 2em;
        margin: 0 0 30px 0;
        color: #f0f0f0;
        width: 100%;
        max-width: 900px;
        margin-left: 6rem;
        margin-top: 5rem;
    }
    .wishlist-list {
        display: flex;
        flex-direction: column;
        gap: 30px;
        align-items: center;
    }
    .wishlist-item {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #1a1a1a;
        border-bottom: 1px solid #333333;
        flex-wrap: wrap;
        padding: 20px;
        width: 100%;
        max-width: 700px;
        position: relative;
        transition: box-shadow 0.2s;
    }
    .wishlist-item:last-child {
        border-bottom: none;
    }
    .wishlist-image-placeholder {
        width: 100px;
        height: 80px;
        background-color: #2a2a2a;
        border: 1px solid #444444;
        margin-right: 20px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #888;
        font-size: 2em;
    }
    .wishlist-details {
        flex-grow: 1;
        margin-right: 20px;
        min-width: 250px;
        text-align: left;
    }
    .wishlist-title {
        font-size: 1.1em;
        margin: 0 0 5px 0;
        color: #f0f0f0;
    }
    .wishlist-price {
        font-size: 0.9em;
        color: #4CAF50;
        margin: 0;
    }
    .wishlist-actions {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        flex-shrink: 0;
        min-width: 120px;
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
    }
    .wishlist-remove-btn {
        background-color: #f44336;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        font-size: 0.9em;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s ease;
        margin-top: 10px;
    }
    .wishlist-remove-btn:hover {
        background-color: #c0392b;
    }
    @media (max-width: 768px) {
        .wishlist-item {
            flex-direction: column;
            align-items: center;
            max-width: 100%;
        }
        .wishlist-image-placeholder {
            margin-right: 0;
            margin-bottom: 15px;
        }
        .wishlist-details {
            margin-right: 0;
            margin-bottom: 15px;
            text-align: center;
        }
        .wishlist-actions {
            position: static;
            width: 100%;
            align-items: center;
            text-align: center;
            transform: none;
            margin-top: 10px;
        }
        .wishlist-header {
            margin-left: 0;
            text-align: center;
        }
    }
</style>

<div class="main-content">
    <h1 class="wishlist-header">Lista de Deseos: {{ $wishlistGroup->name }}</h1>
    <div class="wishlist-list">
        @forelse ($wishlists as $wishlist)
            <a href="{{ route('All_products.show', $wishlist->product->id) }}" style="text-decoration:none;display:block;width:100%;">
                <div class="wishlist-item" style="cursor:pointer; position:relative;">
                    @if (isset($wishlist->product->mainPhoto) && $wishlist->product->mainPhoto->photo_url)
                        <div class="wishlist-image-placeholder" style="padding:0;">
                            <img src="{{ asset($wishlist->product->mainPhoto->photo_url) }}" alt="{{ $wishlist->product->name }}"
                                style="width:100px;height:80px;object-fit:cover;">
                        </div>
                    @else
                        <div class="wishlist-image-placeholder"></div>
                    @endif
                    <div class="wishlist-details">
                        <p class="wishlist-title">{{ $wishlist->product->name }}</p>
                        <p class="wishlist-price">{{ $wishlist->product->precio }}€</p>
                    </div>
                    <div class="wishlist-actions" onclick="event.stopPropagation();">
                        <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="wishlist-remove-btn">Eliminar</button>
                        </form>
                    </div>
                </div>
            </a>
        @empty
            <p>No tienes productos en tu lista de deseos.</p>
        @endforelse
    </div>
</div>
@endsection