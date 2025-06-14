@extends('layouts.plantilla_user_menu')

@section('title', 'Comentarios')

@section('context')
     <style>
        .main-content {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto 40px auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .title-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .header {
            text-align: left;
            font-size: 2em;
            margin: 5rem 0 30px 0;
            color: #f0f0f0;
            width: 100%;
        }

        .section-title {
            font-size: 1.5em;
            margin-bottom: 25px;
            color: #f0f0f0;
            margin-left: 12rem
        }

        .product-list {
            display: flex;
            flex-direction: column;
            gap: 30px;
            align-items: stretch;
            width: 100%;
        }

        .product-item {
            background-color: #1a1a1a;
            border: 1px solid #333;
            box-shadow: 0 2px 8px #0002;
            display: flex;
            flex-direction: row;
            align-items: center;
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
            padding: 20px;
            margin-bottom: 0;
            transition: box-shadow 0.2s;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-item:hover {
            box-shadow: 0 0 0 2px #4caf50;
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
            overflow: hidden;
        }

        .product-image-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .product-details {
            flex-grow: 1;
            margin-right: 20px;
            min-width: 150px;
            text-align: left;
        }

        .product-title {
            font-size: 1em;
            margin: 0 0 5px 0;
            color: #f0f0f0;
            line-height: 1.4;
            min-height: 2.5em;
        }

        .product-price {
            font-size: 0.95em;
            color: #4caf50;
            margin: 0;
            font-weight: bold;
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
            background-color: #4caf50;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            font-size: 0.95em;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
            display: inline-block;
            margin-top: 5px;
        }

        .view-comments-button:hover {
            background-color: #388e3c;
        }

        .pagination {
            margin-top: 0px;
            margin-bottom: 2rem;
            justify-content: center;
            display: flex;
        }

        .pagination a,
        .pagination span {
            padding: 0px 0px;
            border-radius: 0px;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .pagination .current-page {
            color: rgb(255, 255, 255);
            font-weight: bold;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 20px;
            cursor: default;
        }
        .pagination a,
        .pagination span:not(.current-page) {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
            gap: 10px;
        }

        .pagination a:hover {
            background-color: #155d1f54;
        }

        @media (max-width: 810px) {
            .main-content {
                width: 100%;
                max-width: 505px;
            }
            .product-list {
                gap: 18px;
            }
        }

        @media (max-width: 768px) {
            .product-item {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
                max-width: 100%;
                padding: 15px 8px;
            }
            .product-image-placeholder {
                margin-right: 0;
                margin-bottom: 10px;
                width: 90vw;
                max-width: 320px;
                height: 30vw;
                max-height: 120px;
                align-self: center;
            }
            .product-details {
                margin-right: 0;
                margin-bottom: 10px;
                text-align: center;
                min-width: 0;
            }
            .comments-info {
                width: 100%;
                align-items: center;
                text-align: center;
                min-width: 0;
            }
        }

        @media (max-width: 480px) {
            .header {
                font-size: 1.3em;
                margin-top: 2.5rem;
            }
            .section-title {
                font-size: 1.1em;
            }
            .product-image-placeholder {
                width: 90vw;
                max-width: 250px;
                height: 28vw;
                max-height: 90px;
            }
            .product-title {
                font-size: 1em;
            }
            .product-price {
                font-size: 0.95em;
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
