@extends('layouts.plantilla')

@section('title', 'Productos mejor puntuados')

@section('context')
    @include('layouts.carousel')
    <!-- Google Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_products.css') }}?v={{ time() }}">

    @php
        $carouselImgs = [
            'img/carousel/1.jpg',
            'img/carousel/2.jpg',
            'img/carousel/3.jpg',
            'img/carousel/4.jpg',
            'img/carousel/5.jpg',
            'img/carousel/6.png',
            'img/carousel/7.png',
            'img/carousel/8.png',
            'img/carousel/9.jpeg',
            'img/carousel/10.jpg',
        ];
    @endphp

    @if ($products->count())
        <div class="grid-container">
            @foreach ($products as $product)
                <div class="grid-item">
                    <a href="{{ route('All_products.show', $product->id) }}">
                        @if ($product->mainPhoto && $product->mainPhoto->photo_url)
                            <img src="{{ asset($product->mainPhoto->photo_url) }}" alt="{{ $product->name }}">
                        @else
                            @php
                                $randomCarousel = $carouselImgs[array_rand($carouselImgs)];
                            @endphp
                            <img src="{{ asset($randomCarousel) }}" alt="Imagen aleatoria">
                        @endif
                    </a>
                    <a href="{{ route('All_products.show', $product->id) }}" style="text-decoration:none;">
                        <p class="product-title">{{ $product->name }}</p>
                    </a>
                    <p class="product-price">{{ number_format($product->precio, 2) }}€</p>
                    <div class="rating-comments">
                        @php
                            $avg = round($product->ratings_avg_stars ?? 0, 1);
                            $fullStars = floor($avg);
                            $halfStar = $avg - $fullStars >= 0.5 ? 1 : 0;
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
                    <p class="product-description">{{ $product->description }}</p>
                </div>
            @endforeach
        </div>
        <div class="pagination">
            {{ $products->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <p style="text-align:center;">No hay productos puntuados.</p>
    @endif
@endsection
