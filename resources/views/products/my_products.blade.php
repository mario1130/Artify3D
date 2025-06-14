@extends('layouts.plantilla_user_menu')

@section('title', 'Mis Productos')

<link rel="stylesheet" href="{{ asset('css/style_myproducts.css') }}?v={{ time() }}">

@section('context')
        <div class="main-content">
            <h1>Mis Productos</h1>
            <button class="add-product"> <a href="{{ route('add_products.add_show') }}">Añadir Producto</a></button>
            <div class="product-list">
                @forelse ($products as $product)
                    <div class="product-item">
                        <div class="product-image">
                            <img src="{{ asset($product->mainPhoto->photo_url ?? 'img/Default_product.png') }}"
                                alt="{{ $product->name }}">
                        </div>
                        <div class="product-details">
                            <h2>{{ $product->name }}</h2>
                            <p class="price">{{ $product->precio }}€</p>
                            <a href="{{ route('products.edit_show', $product->id) }}" class="edit-product">Editar
                                Producto</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-product"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>No tienes productos añadidos.</p>
                @endforelse
            </div>
            <div class="pagination">
                {{ $products->links('vendor.pagination.tailwind') }}
            </div>
        </div>
@endsection
