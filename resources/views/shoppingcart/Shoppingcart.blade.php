@extends('layouts.plantilla')

@section('title', 'Shopping cart')

@section('context')
<style>
    .cart {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 2rem;
    }
    .cart-item {
        display: flex;
        justify-content: space-between;
        width: 50%;
        margin-bottom: 1rem;
        border-bottom: 1px solid #ccc;
        padding-bottom: 1rem;
    }
    .cart-item h3, .cart-item p {
        margin: 0;
    }
</style>

<div class="cart">
    <h1>Tu carrito</h1>
    @php
        $cartItems = App\Models\ShoppingCart::where('user_id', auth()->id())->get();
    @endphp

    @if ($cartItems->count() > 0)
        @foreach ($cartItems as $item)
            <div class="cart-item">
                <h3>{{ $item->product_name }}</h3>
                <p>{{ $item->product_price }}€</p>
                <p>Cantidad: {{ $item->quantity }}</p>
            </div>
        @endforeach
    @else
        <p>Tu carrito está vacío.</p>
    @endif

    <form>
        <button type="button" onclick="window.location.href='/'">Seguir Comprando</button>
    </form>
</div>
@endsection