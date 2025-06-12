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
}

    .menu-title-category {
        color: #4CAF50;
        text-decoration: underline;
        font-size: 2em;
        margin: 30px 0 30px 0;
        text-align: center;
    }
    .grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        max-width: 1000px;
        width: 100%;
        margin: 0 auto 40px auto;
        padding: 20px;
        box-sizing: border-box;
    }
    .grid-item {
        background-color: #1a1a1a;
        text-align: left;
        display: flex;
        flex-direction: column;
        border-radius: 8px;
        border: 1px solid #333;
        box-shadow: 0 2px 8px #0002;
        overflow: hidden;
        transition: box-shadow 0.2s;
    }
    .grid-item:hover {
        box-shadow: 0 0 0 2px #4CAF50;
    }
    .image-placeholder,
    .grid-item img {
        width: 100%;
        padding-bottom: 62%;
        background-color: #2a2a2a;
        border-bottom: 1px solid #444444;
        object-fit: cover;
        display: block;
    }
    .grid-item img {
        padding-bottom: 0;
        height: 180px;
        background: #2a2a2a;
    }
    .product-title {
        font-size: 1em;
        margin: 15px 15px 5px 15px;
        color: #f0f0f0;
        line-height: 1.4;
        min-height: 2.5em;
    }
    .product-price {
        font-size: 0.95em;
        color: #4CAF50;
        margin: 0 15px 15px 15px;
        font-weight: bold;
    }
    .product-actions {
        display: flex;
        gap: 10px;
        margin: 0 15px 15px 15px;
    }
    .b-product, .product-actions a {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 8px 15px;
        font-size: 0.95em;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s;
        display: inline-block;
        margin-top: 5px;
    }
    .b-product:hover, .product-actions a:hover {
        background-color: #388e3c;
    }
    .product-description {
        font-size: 0.95em;
        color: #ccc;
        margin: 0 15px 15px 15px;
        min-height: 2.5em;
    }
    @media (max-width: 900px) {
        .grid-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }
    }
    @media (max-width: 600px) {
        .grid-container {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
</style>

<h1 class="menu-title-category">{{ $category->name }}</h1>

@include('layouts.carousel')

@if($products->count())
    <div class="grid-container">
        @foreach ($products as $product)
            <div class="grid-item">
                <a href="{{ route('All_products.show', $product->id) }}">
                    @if($product->mainPhoto && $product->mainPhoto->photo_url)
                        <img src="{{ asset($product->mainPhoto->photo_url) }}" alt="{{ $product->name }}">
                    @else
                        <div class="image-placeholder"></div>
                    @endif
                </a>
                <a href="{{ route('All_products.show', $product->id) }}" style="text-decoration:none;">
                    <p class="product-title">{{ $product->name }}</p>
                </a>
                <p class="product-price">{{ $product->precio }}€</p>
                <p class="product-description">{{ $product->description }}</p>

            </div>
        @endforeach
    </div>
@else
    <p style="text-align:center;">No hay productos en esta categoría.</p>
@endif

@endsection