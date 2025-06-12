@extends('layouts.plantilla_solo_cabecera')

@section('title', 'Shopping cart')

@section('context')
<style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #0e0e0e;
      color: white;
    }

    .steps {
        display: flex;
        justify-content: center;
        margin-top: 0;
        position: static;
        top: 88px;
        left: 0;
        background: #0e0e0e;
        z-index: 999;
        padding-top: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #444;
    }

    .step {
      margin: 0 40px;
      text-align: center;
      position: relative;
    }

    .step::after {
      content: '';
      position: absolute;
      right: -90px;
      top: 20%;
      width: 100px;
      height: 2px;
      background-color: gray;
    }

    .step:last-child::after {
      display: none;
    }

    .step span {
      display: inline-block;
      border: 2px solid white;
      border-radius: 50%;
      width: 24px;
      height: 24px;
      line-height: 20px;
      text-align: center;
      margin-bottom: 5px;
      background: #444;    
    }

    .active-step span {
      background: #000000;
      border-color: #22c55e;
      color: #fff;
    }
    .active-step div {
        color: #ffffff;
    }

    .container-outer {
      max-width: 1100px;
      margin: 0 auto 5rem auto;
      padding: 0 16px;
    }

    .left-title {
      text-align: left;
      margin-top: 3rem;
      margin-bottom: 0.5rem;
      font-size: 2rem;
    }
    .left-subtitle {
      text-align: left;
      margin-top: 1.5rem;
      margin-bottom: 2rem;
      color: #bbb;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      gap: 7rem;
      margin: 0 auto 5rem auto;
      max-width: 1100px;
    }

    .cart-box {
      width: 65%;
      min-width: 350px;
      max-width: 700px;
    }

    .summary-box {
      width: 30%;
      min-width: 250px;
      max-width: 350px;
      margin-right: 0;
      background-color: #141414;
      border: 1px solid #444;
      padding: 20px;
      height: fit-content;
    }

    .cart-item {
      display: flex;
      background-color: #141414;
      border: 1px solid #444;
      padding: 20px;
      margin-top: 10px;
      align-items: center;
      justify-content: space-between;
    }

    .cart-left {
      display: flex;
      align-items: center;
    }

    .product-image {
      width: 80px;
      height: 60px;
      background-color: #333;
      margin-right: 20px;
    }

    .product-info p {
      margin: 4px 0;
    }

    .price {
      color: #22c55e;
    }

    .trash-icon {
      font-size: 18px;
      cursor: pointer;
    }

    .cart-buttons {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
    }

    .cart-buttons button {
      background-color: transparent;
      color: white;
      border: 1px solid #999;
      padding: 8px 14px;
      cursor: pointer;
    }

    .summary-box h3 {
      margin-top: 0;
    }

    .summary-line {
      display: flex;
      justify-content: space-between;
      margin: 10px 0;
    }

    .checkout-btn {
      background-color: #22c55e;
      color: white;
      border: none;
      width: 100%;
      padding: 10px;
      margin-top: 20px;
      cursor: pointer;
    }

    small {
      color: #bbb;
    }

    @media (max-width: 700px) {
      .container-outer {
        max-width: 98vw;
        padding: 0 8px;
      }
      .container {
        flex-direction: column;
        gap: 1rem;
        max-width: 100vw;
      }
      .left-title {
        font-size: 1.3rem;
        margin-top: 2rem;
      }
      .cart-box, .summary-box {
        width: 100%;
        min-width: unset;
        max-width: unset;
      }
    }
</style>

<div class="steps">
    <div class="step active-step"><span>1</span><div>Mi Cesta</div></div>
    <div class="step"><span>2</span><div>Método de pago</div></div>
    <div class="step"><span>3</span><div>Resumen</div></div>
</div>

@php
    $cartItems = App\Models\ShoppingCart::where('user_id', auth()->id())->get();
    $total = $cartItems->sum(function($item) { return $item->product_price * $item->quantity; });
    $count = $cartItems->sum('quantity');
@endphp

<div class="container-outer">
    <h2 class="left-title">Mi cesta</h2>
    <p class="left-subtitle">{{ $count }} artículo{{ $count != 1 ? 's' : '' }}</p>

    <div class="container">
        <div class="cart-box">
            @forelse ($cartItems as $item)
            <div class="cart-item">
                <div class="cart-left">
                    <div class="product-image">
                        {{-- Aquí puedes poner una imagen real si tienes $item->product_image --}}
                    </div>
                    <div class="product-info">
                        <p><strong>{{ $item->product_name }}</strong></p>
                        <p class="price">{{ $item->product_price }}€</p>
                        <small>Cantidad: {{ $item->quantity }}</small>
                    </div>
                </div>
                <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="trash-icon" title="Eliminar">&#128465;</button>
                </form>
            </div>
            @empty
            <div class="cart-item">
                <p>Tu carrito está vacío.</p>
            </div>
            @endforelse

            <div class="cart-buttons">
                <form method="POST" action="{{ route('cart.empty') }}">
                    @csrf
                    <button type="submit">Vaciar Cesta</button>
                </form>
                <button onclick="window.location.href='/'">Seguir Comprando</button>
            </div>
        </div>

        <div class="summary-box">
            <h3>Resumen</h3>
            <div class="summary-line">
                <span>Subtotal</span>
                <span>{{ number_format($total, 2) }}€</span>
            </div>
            <div class="summary-line">
                <span>IVA</span>
                <span>Incluido</span>
            </div>
            <hr>
            <div class="summary-line" style="font-weight: bold;">
                <span>Total</span>
                <span>{{ number_format($total, 2) }}€</span>
            </div>
            <button class="checkout-btn" onclick="window.location.href='{{ route('pago') }}'">Ir a pagar</button>
        </div>
    </div>
</div>
@endsection