@extends('layouts.plantilla')

@section('title', ucfirst($category->name))

<link rel="stylesheet" href="{{ asset('css/style_products.css') }}?v={{ time() }}">

@section('context')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- <h1 class="menu-title-category">{{ $category->name }}</h1> --}}

    <div id="particles-root"
        style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:0;pointer-events:none;overflow:hidden;"></div>
    <script src="{{ mix('js/Particles.js') }}"></script>
    @include('layouts.carousel')

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
                    <p class="product-price">{{ $product->precio }}€</p>
                    <p class="product-description">{{ $product->description }}</p>
                </div>
            @endforeach
        </div>
        <div class="pagination">
            {{ $products->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <p style="text-align:center;">No hay productos en esta categoría.</p>
    @endif

@endsection
