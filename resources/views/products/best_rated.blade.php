@extends('layouts.plantilla')

@section('title', 'Productos mejor puntuados')

@section('context')
    @include('layouts.carousel')
    <!-- Google Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .container {
            max-width: 960px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .product-section {
            display: flex;
            gap: 30px;
            margin-bottom: 50px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
        }
        .product-details {
            min-width: 270px;
            max-width: 320px;
            margin: 20px;
            background: #232323;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .product-details h2 {
            font-size: 1.2em;
            margin: 15px 0 8px 0;
            color: #f0f0f0;
            text-align: center;
        }
        .rating-comments {
            display: flex;
            align-items: center;
            font-size: 0.95em;
            color: #cccccc;
            margin-bottom: 10px;
            justify-content: center;
        }
        .rating-comments .stars {
            color: gold;
            margin-right: 5px;
        }
        .action-button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 15px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
            white-space: nowrap;
            margin-top: 15px;
            width: 100%;
        }
        .action-button:hover {
            background-color: #45a049;
        }
        .product-details img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            background: #2a2a2a;
            margin-bottom: 10px;
        }
        @media (max-width: 992px) {
            .product-section {
                flex-direction: column;
                align-items: center;
            }
            .product-details {
                width: 100%;
                max-width: 500px;
            }
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px 10px;
            }
            .product-details {
                max-width: 100%;
            }
        }
    </style>
<div class="container">
    <h1 style="margin: 30px 0 40px 0; color: #f0f0f0;">Mejor puntuados</h1>
    <div class="product-section">
        @forelse ($products as $product)
            <div class="product-details">
                <a href="{{ route('All_products.show', $product->id) }}">
                    <img src="{{ asset($product->mainPhoto->photo_url ?? 'img/Default_product.png') }}"
                         alt="{{ $product->name }}">
                </a>
                <h2>{{ $product->name }}</h2>
                <div class="rating-comments">
                    <span style="color:#4CAF50;font-weight:bold;">{{ number_format($product->precio, 2) }}€</span>
                </div>
                <div class="rating-comments">
                    @php
                        $avg = round($product->ratings_avg_stars ?? 0, 1);
                        $fullStars = floor($avg);
                        $halfStar = ($avg - $fullStars) >= 0.5 ? 1 : 0;
                        $emptyStars = 5 - $fullStars - $halfStar;
                    @endphp
                    <span class="stars">
                        @for ($i = 0; $i < $fullStars; $i++)
                            ★
                        @endfor
                        @if ($halfStar)
                            <span style="color:gold;">☆</span>
                        @endif
                        @for ($i = 0; $i < $emptyStars; $i++)
                            <span style="color:#888;">☆</span>
                        @endfor
                    </span>
                    {{ $avg }}/5
                </div>
                <a href="{{ route('All_products.show', $product->id) }}" class="action-button">Ver producto</a>
            </div>
        @empty
            <p style="color:#ccc;">No hay productos puntuados.</p>
        @endforelse
    </div>
    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>
@endsection