{{-- filepath: resources/views/shop/resumen.blade.php --}}
@extends('layouts.plantilla_solo_cabecera')

@section('title', 'Resumen')

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
      margin-top: 10px;
    }

    .step {
      margin: 0 30px;
      text-align: center;
      position: relative;
    }

    .step::after {
      content: '';
      position: absolute;
      right: -50px;
      top: 50%;
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
      color: #fff;
    }

    .container-outer {
      max-width: 1100px;
      margin: 0 auto 5rem auto;
      padding: 0 16px;
    }

    h2 {
      margin: 30px 0 20px 0;
      text-align: left;
      font-size: 2rem;
    }

    .container {
      display: flex;
      justify-content: space-between;
      gap: 2rem;
      margin: 0 auto;
      max-width: 1100px;
    }

    .product-summary {
      width: 65%;
      background-color: #141414;
      border: 1px solid #444;
      padding: 20px;
    }

    .product-item {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .product-image {
      width: 80px;
      height: 60px;
      background-color: #333;
      margin-right: 20px;
    }

    .product-info {
      flex: 1;
    }

    .product-info p {
      margin: 5px 0;
    }

    .product-info .price {
      color: #22c55e;
    }

    .download-btn {
      margin-top: 20px;
      background-color: #222;
      color: white;
      border: 1px solid #777;
      padding: 8px 12px;
      cursor: pointer;
    }

    .summary-box {
      width: 30%;
      background-color: #141414;
      border: 1px solid #444;
      padding: 20px;
      height: fit-content;
    }

    .summary-box h3 {
      margin-top: 0;
    }

    .summary-line {
      display: flex;
      justify-content: space-between;
      margin: 10px 0;
    }

    .finalize-btn {
      background-color: #22c55e;
      color: white;
      border: none;
      width: 100%;
      padding: 10px;
      margin-top: 20px;
      cursor: pointer;
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
      h2 {
        font-size: 1.3rem;
      }
      .product-summary, .summary-box {
        width: 100%;
      }
    }
</style>

<div class="steps">
    <div class="step"><span>1</span><div>Mi Cesta</div></div>
    <div class="step"><span>2</span><div>Método de pago</div></div>
    <div class="step active-step"><span>3</span><div>Resumen</div></div>
</div>

<div class="container-outer">
  <h2>Resumen</h2>

  @php
      $total = $order ? $order->total : 0;
  @endphp

  <div class="container">
    <div class="product-summary">
      @if($order && $order->items->count())
        @foreach ($order->items as $item)
          <div class="product-item">
            <div class="product-image">
              {{-- Aquí puedes poner una imagen real si tienes $item->product_image --}}
            </div>
            <div class="product-info">
              <p><strong>{{ $item->product_name }}</strong></p>
              <p class="price">{{ number_format($item->product_price, 2) }}€</p>
              <small>Cantidad: {{ $item->quantity }}</small>
            </div>
          </div>
        @endforeach
        <button class="download-btn" onclick="window.location='{{ route('factura.descargar', $order->id) }}'">Descargar Factura</button>
      @else
        <p>No hay productos en tu compra.</p>
      @endif
    </div>

    <div class="summary-box">
      <h3>Resumen</h3>
      <div class="summary-line">
        <span>Subtotal</span>
        <span>{{ number_format($total, 2) }}€</span>
      </div>
      <hr style="border-color: #444;">
      <small>Total (Impuestos Incluidos)</small>
      <form method="POST" action="{{ route('finalizar.compra') }}">
        @csrf
        <button type="submit" class="finalize-btn">Finalizar compra</button>
      </form>
    </div>
  </div>
</div>
@endsection