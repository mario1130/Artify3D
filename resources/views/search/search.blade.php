@extends('layouts.plantilla')

@section('title', 'Resultados de búsqueda')

@section('context')
<div class="search-results-page">
    <h1>Resultados de búsqueda para: "{{ $query }}"</h1>

    @if ($results->isEmpty())
        <p>No se encontraron resultados.</p>
    @else
        <section class="products">
            @foreach ($results as $product)
                <div class="product">
                    {{-- Mostrar la imagen principal o una imagen por defecto --}}
                    <img src="{{ asset($product->mainPhoto->photo_url ?? 'img/Default_product.png') }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
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
            @endforeach
        </section>
    @endif
</div>
@endsection

