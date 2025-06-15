@extends('layouts.plantilla_user_menu')

@section('title', 'Mis Productos')

@section('context')
    <style>
        .main-content {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto 40px auto;
            padding: 20px;
            box-sizing: border-box;
        }

        h1 {
            text-align: left;
            font-size: 2em;
            margin: 5rem 0 30px 0;
            color: #f0f0f0;
            width: 100%;
        }

        .add-product {
            background-color: #1D7129;
            color: white;
            padding: 12px 28px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            margin-bottom: 40px;
            transition: background 0.2s;
        }
        .add-product a {
            color: white;
            text-decoration: none;
        }
        .add-product:hover {
            background-color: #1D7129;
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

        .product-item:hover {
            box-shadow: 0 0 0 2px #1D7129;
        }

        .product-image {
            width: 100px;
            height: 80px;
            background-color: #2a2a2a;
            border: 1px solid #444444;
            margin-right: 20px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .product-details {
            flex-grow: 1;
            margin-right: 0;
            min-width: 150px;
            text-align: left;
        }

        .product-details h2 {
            font-size: 1em;
            margin: 0 0 5px 0;
            color: #f0f0f0;
            line-height: 1.4;
            min-height: 2.5em;
        }

        .price {
            font-size: 0.95em;
            color: #1D7129;
            margin: 0 0 10px 0;
            font-weight: bold;
        }

        .product-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .edit-product-btn,
        .delete-product-btn {
            background-color: #1D7129;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 7px 18px;
            font-size: 0.98em;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .edit-product-btn {
            background-color: #2196f3;
        }
        .edit-product-btn:hover {
            background-color: #17691f;
        }
        .delete-product-btn {
            background-color: #e53935;
        }
        .delete-product-btn:hover {
            background-color: #b71c1c;
        }

        .pagination {
            margin-top: 0px;
            margin-bottom: 2rem;
            justify-content: flex-start;
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
            .product-image {
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
            .product-actions {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.3em;
                margin-top: 2.5rem;
            }
            .product-image {
                width: 90vw;
                max-width: 250px;
                height: 28vw;
                max-height: 90px;
            }
            .product-details h2 {
                font-size: 1em;
            }
            .price {
                font-size: 0.95em;
            }
        }
    </style>

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
                        <div class="product-actions">
                            <a href="{{ route('products.edit_show', $product->id) }}" class="edit-product-btn">Editar</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-product-btn"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                            </form>
                        </div>
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