@extends('layouts.plantilla')

@section('title', ucfirst($category->name))

@section('1', asset('img/1.jpg'))
@section('2', asset('img/2.jpg'))
@section('3', asset('img/3.jpg'))

@section('context')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<style>/* Agrega esto a tu archivo CSS */
.alert {
    padding: 10px;
    margin: 10px 0;
    border: 1px solid transparent;
    border-radius: 5px;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}</style>

<h1 class="menu-title-category">{{ $category->name }}</h1>

    @include('layouts.carousel') 

    <section class="products">
    @forelse ($products as $product)
        <div class="product">
            {{-- Enlace para abrir la vista específica del producto --}}
            <a href="{{ route('All_products.show', $product->id) }}">
                <img src="{{ asset($product->mainPhoto->photo_url ?? 'img/Default_product.png') }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
            </a>
            <p>{{ $product->precio }}€</p>
            <h4>{{ $product->description }}</h4>
            <div class="b-product-container">
                <form action="{{ route('shoppingcart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                    <input type="hidden" name="product_price" value="{{ $product->precio }}">
                    <button type="submit" class="b-product">Añadir Carrito</button>
                </form>
                <button class="b-product"> <a href="{{ route('index') }}">Comprar</a></button>       
            </div>
        </div>
    @empty
        <p>No hay productos en esta categoría.</p>
    @endforelse
    </section>

    
@endsection