@extends('layouts.plantilla_user_menu')

@section('title', 'Productos')

@section('context')
<section class="products">
    @foreach ($products as $product)
        <div class="product">
            <a href="{{ route('products.show', $product->id) }}">
                <img src="https://via.placeholder.com/300x200" alt="{{ $product->titular }}">
            </a>
            <h3>{{ $product->titular }}</h3>
            <p>{{ $product->precio }}€</p>
        </div>
    @endforeach
</section>

<div class="pagination">
    {{ $products->links() }}
</div>
@endsection