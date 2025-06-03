@extends('layouts.plantilla_user_menu')

@section('title', 'Comentarios')


@section('context')
<div class="container">
    <div class="main-content">
        <h1>Comentarios de Productos</h1>
        <div class="product-list">
            @forelse ($products as $product)
            <div class="product-item">
                <div class="product-details">
                    <h2>{{ $product->name }}</h2>
                    <p>Número de comentarios: {{ $product->comments_count }}</p>
                </div>
            </div>
            @empty
                <p>No hay productos disponibles.</p>
            @endforelse
        </div>
        <div class="pagination">
            {{ $products->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>
@endsection