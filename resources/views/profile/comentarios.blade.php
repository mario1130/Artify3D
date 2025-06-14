@extends('layouts.plantilla_user_menu')

@section('title', 'Comentarios')

@section('context')
    <style>
        .header {
            text-align: left;
            font-size: 2em;
            margin: 0 0 30px 0;
            color: #f0f0f0;
            width: 100%;
            max-width: 900px;
            margin-top: 5rem;
        }

        .section-title {
            font-size: 1.5em;
            margin-bottom: 25px;
            color: #f0f0f0;
        }

        .product-list {
            display: flex;
            flex-direction: column;
            gap: 30px;
            align-items: center;
        }

        .product-item {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #1a1a1a;
            border-bottom: 1px solid #333333;
            flex-wrap: wrap;
            padding: 20px;
            width: 35vw;
            max-width: 50vw;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-image-placeholder {
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

        .product-details {
            flex-grow: 1;
            margin-right: 20px;
            min-width: 250px;
            text-align: left;
        }

        .product-title {
            font-size: 1.1em;
            margin: 0 0 5px 0;
            color: #f0f0f0;
        }

        .product-price {
            font-size: 0.9em;
            color: #4CAF50;
            margin: 0;
        }

        .comments-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            flex-shrink: 0;
            min-width: 120px;
        }

        .comments-count {
            font-size: 1em;
            margin-bottom: 10px;
            color: #f0f0f0;
            white-space: nowrap;
        }

        .view-comments-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            font-size: 0.9em;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .view-comments-button:hover {
            background-color: #45a049;
        }

        .title-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .product-item {
                flex-direction: column;
                align-items: center;
                max-width: 100%;
            }

            .product-image-placeholder {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .product-details {
                margin-right: 0;
                margin-bottom: 15px;
                text-align: center;
            }

            .comments-info {
                width: 100%;
                align-items: center;
                text-align: center;
            }
        }
    </style>



    <div class="main-content">
        <div class="title-container">
        <h1 class="header">Comentarios</h1>
        <h2 class="section-title">Productos</h2>
        </div>
        <div class="product-list">
            @forelse ($products as $product)
                <div class="product-item">
                    @if (isset($product->mainPhoto) && $product->mainPhoto->photo_url)
                        <div class="product-image-placeholder" style="padding:0;">
                            <img src="{{ asset($product->mainPhoto->photo_url) }}" alt="{{ $product->name }}"
                                style="width:100px;height:80px;object-fit:cover;">
                        </div>
                    @else
                        <div class="product-image-placeholder"></div>
                    @endif
                    <div class="product-details">
                        <p class="product-title">{{ $product->name }}</p>
                        @if (isset($product->price))
                            <p class="product-price">{{ $product->price }}€</p>
                        @endif
                    </div>
                    <div class="comments-info">
                        <p class="comments-count">{{ $product->comments_count }} Comentarios</p>
                        <a href="{{ route('All_products.show', $product->id) }}#comentarios"
                            class="view-comments-button">Ver Comentarios</a>
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
@endsection
