@extends('layouts.plantilla')

@section('title', $product->name)

@section('context')
    <!-- Google Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        .container {
            max-width: 960px;
            width: 100%;
            margin: 6rem auto;
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

        .product-image-area {
            flex-shrink: 0;
            width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .main-image-placeholder,
        .product-image-area img {
            width: 100%;
            padding-bottom: 75%;
            background-color: #2a2a2a;
            border: 1px solid #444444;
            margin-bottom: 20px;
            object-fit: cover;
            display: block;
        }

        .product-image-area img {
            padding-bottom: 0;
            height: 215px;
            background: #2a2a2a;
        }

        .thumbnail-gallery {
            display: flex;
            gap: 10px;
        }

        .thumbnail-placeholder {
            width: 70px;
            height: 52.5px;
            background-color: #2a2a2a;
            border: 1px solid #444444;
            cursor: pointer;
        }

        .product-details {
            flex-grow: 1;
            min-width: 350px;
            max-width: 400px;
            margin-left: 1rem;
        }

        .product-details h1 {
            font-size: 1.5em;
            margin: 0 0 10px 0;
            color: #f0f0f0;
        }

        .rating-comments {
            display: flex;
            align-items: center;
            font-size: 0.9em;
            color: #cccccc;
            margin-bottom: 20px;
        }

        .rating-comments .stars {
            color: gold;
            margin-right: 5px;
        }

        .rating-comments .comments-count {
            margin-left: 10px;
        }

        .description-title {
            font-size: 1.1em;
            margin-bottom: 10px;
            color: #f0f0f0;
        }

        .description-text {
            font-size: 0.9em;
            color: #cccccc;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        .price-actions-column {
            flex-shrink: 0;
            width: 180px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .product-price {
            font-size: 1.8em;
            color: #4CAF50;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: right;
            width: 100%;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .action-button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 15px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            width: 100%;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
            white-space: nowrap;
        }

        .action-button.add-to-cart {
            background-color: #333333;
            border: 1px solid #555555;
            color: #f0f0f0;
        }

        .action-button:hover {
            background-color: #45a049;
        }

        .action-button.add-to-cart:hover {
            background-color: #444444;
        }

        .wishlist-button {
            background-color: #222;
            color: #fff;
            border: 1px solid #4CAF50;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1em;
            cursor: pointer;
            margin-top: 0;
            margin-bottom: 0;
            width: 100%;
            transition: background 0.2s;
        }

        .wishlist-button:hover {
            background-color: #4CAF50;
            color: #fff;
        }

        #wishlist-popup {
            background: #222;
            border: 1px solid #4CAF50;
            border-radius: 8px;
            padding: 20px;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, 0);
            z-index: 1000;
            min-width: 300px;
            color: #fff;
            display: none;
        }

        #wishlist-popup label,
        #wishlist-popup input,
        #wishlist-popup select,
        #wishlist-popup button {
            color: #222;
            margin-bottom: 10px;
            display: block;
            width: 100%;
        }

        #wishlist-popup button {
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 0;
            margin-top: 10px;
            cursor: pointer;
        }

        .comments-section {
            margin-top: 50px;
            padding-top: 30px;
            border-top: 1px solid #333333;
            width: 100%;
        }

        .comments-section h2 {
            font-size: 1.5em;
            margin-bottom: 30px;
            color: #f0f0f0;
        }

        .comment-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            justify-content: flex-start;
            /* Fuerza alineación a la izquierda */
        }

        .comment-avatar {
            width: 40px;
            height: 40px;
            background-color: #4CAF50;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 1.1em;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .comment-content {
            flex-grow: 1;
        }

        .comment-text {
            font-size: 0.95em;
            color: #f0f0f0;
            margin-bottom: 10px;
        }

        .comment-actions {
            font-size: 0.85em;
            color: #cccccc;
        }

        .comment-actions span {
            margin-right: 15px;
            cursor: pointer;
        }

        .comment-actions span:hover {
            text-decoration: underline;
        }

        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin-left: 5px;
            vertical-align: middle;
        }

        .icon-btn .material-icons {
            color: #e67e22;
            font-size: 20px;
            vertical-align: middle;
        }

        .icon-btn:hover .material-icons {
            color: #d35400;
        }

        @media (max-width: 992px) {
            .product-section {
                flex-direction: column;
                align-items: center;
            }

            .product-image-area,
            .product-details,
            .price-actions-column {
                width: 100%;
                max-width: 500px;
                text-align: center;
                align-items: center;
            }

            .price-actions-column {
                align-items: center;
            }

            .product-price {
                text-align: center;
            }

            .action-buttons {
                width: 70%;
                max-width: 250px;
            }

            .thumbnail-gallery {
                justify-content: center;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 20px 10px;
            }

            .main-image-placeholder {
                padding-bottom: 60%;
            }

            .thumbnail-gallery {
                flex-wrap: wrap;
                justify-content: center;
            }

            .thumbnail-placeholder {
                width: 60px;
                height: 45px;
            }

            .product-image-area,
            .product-details,
            .price-actions-column {
                max-width: 100%;
            }

            .action-buttons {
                width: 90%;
                max-width: none;
            }

            .rating-form-stars button {
                background: none;
                border: none;
                cursor: pointer;
                font-size: 1.5em;
                padding: 0 2px;
            }

            .rating-form-stars button:focus {
                outline: none;
            }
        }
    </style>

    <div class="container">
        <div class="product-section">
            <div class="product-image-area">
                @if ($product->mainPhoto && $product->mainPhoto->photo_url)
                    <img src="{{ asset($product->mainPhoto->photo_url) }}" alt="{{ $product->name }}">
                @else
                    <div class="main-image-placeholder"></div>
                @endif
                <div class="thumbnail-gallery">
                    @foreach ($product->photos ?? [] as $photo)
                        @if (!$photo->is_main)
                            <img src="{{ asset($photo->photo_url) }}" class="thumbnail-placeholder" alt="Miniatura">
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="product-details">
                <h1>{{ $product->name }}</h1>
                <div class="rating-comments">
                    <span class="stars">
                        @php
                            $avg = round($product->averageRating() ?? 0, 1);
                            $fullStars = floor($avg);
                            $halfStar = $avg - $fullStars >= 0.5 ? 1 : 0;
                            $emptyStars = 5 - $fullStars - $halfStar;
                        @endphp
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
                    <span class="comments-count">{{ $product->comments->count() }} Comentarios</span>
                </div>
                @auth
                    @php
                        $userRating = $product->userRating(auth()->id());
                    @endphp
                    <form action="{{ route('products.rate', $product->id) }}" method="POST" style="margin-bottom:10px;">
                        @csrf
                        <label style="color:#ccc;">Tu puntuación:</label>
                        <span class="rating-form-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="submit" name="stars" value="{{ $i }}"
                                    title="{{ $i }} estrella{{ $i > 1 ? 's' : '' }}"
                                    style="color:{{ $userRating && $userRating->stars >= $i ? 'gold' : '#888' }};">
                                    {{ $userRating && $userRating->stars >= $i ? '★' : '☆' }}
                                </button>
                            @endfor
                        </span>
                        @if ($userRating)
                            <small style="color:#4CAF50;">Has votado: {{ $userRating->stars }}/5</small>
                        @endif
                    </form>
                @endauth
                <p class="description-title">Descripción</p>
                <p class="description-text">{{ $product->description }}</p>
            </div>
            <div class="price-actions-column">
                <p class="product-price">{{ number_format($product->precio, 2) }}€</p>
                <div class="action-buttons">
                    @if (isset($hasPurchased) && $hasPurchased)
                        <span style="color: #e74c3c; font-weight: bold; font-size: 1.1em;">Comprado</span>
                    @else
                        {{-- Botón Comprar: añade a la cesta y redirige a la cesta --}}
                        <form action="{{ route('shoppingcart.add') }}" method="POST" style="margin:0;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_name" value="{{ $product->name }}">
                            <input type="hidden" name="product_price" value="{{ $product->precio }}">
                            <button type="submit" class="action-button" name="go_to_cart" value="1">Comprar</button>
                        </form>
                        {{-- Botón Añadir a la Cesta: solo añade --}}
                        <form action="{{ route('shoppingcart.add') }}" method="POST" style="margin:0;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_name" value="{{ $product->name }}">
                            <input type="hidden" name="product_price" value="{{ $product->precio }}">
                            <button type="submit" class="action-button add-to-cart">Añadir a la Cesta</button>
                        </form>
                    @endif
                    <button class="wishlist-button" onclick="toggleWishlistPopup()">Añadir a la lista de deseos</button>

                </div>
            </div>
        </div>
        
        {{-- Popup para seleccionar o crear una lista de deseos --}}
        <div id="wishlist-popup">
            <form action="{{ route('wishlist.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <label for="wishlist_group_id">Selecciona una lista:</label>
                <select name="wishlist_group_id" id="wishlist_group_id" required>
                    @foreach ($wishlistGroups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
                <button type="submit">Añadir</button>
            </form>
            <hr>
            <h2>Crear Nueva Lista</h2>
            <form action="{{ route('wishlist_group.store') }}" method="POST">
                @csrf
                <label for="new_wishlist_name">Nombre de la nueva lista:</label>
                <input type="text" name="name" id="new_wishlist_name" placeholder="Nombre de la lista" required>
                <button type="submit">Crear Lista</button>
            </form>
            <button onclick="toggleWishlistPopup()">Cerrar</button>
        </div>

        <div class="url-section" style="margin-top:20px; text-align:left; width:100%;">
        @if (isset($hasPurchased) && $hasPurchased && $product->download_url)
            <div class="download-url-section" style="margin-top:18px;">
                <strong>URL de descarga:</strong>
                <span style="word-break:break-all; color:#4CAF50;">
                    {{ $product->download_url }}
                </span>
            </div>
        @endif
        </div>

        <div class="comments-section">
            <h2>Comentarios</h2>
            <form action="{{ route('comments.store') }}" method="POST" style="margin-bottom:30px;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <textarea name="content" rows="4" placeholder="Escribe tu comentario aquí..." required
                    style="width:100%;margin-bottom:10px;color:black;"></textarea>
                <button type="submit" class="action-button" style="width: 10%">Enviar</button>
            </form>
            @forelse ($product->comments as $comment)
                <div class="comment-item">
                    <div class="comment-avatar">{{ strtoupper(substr($comment->user->name, 0, 1)) }}</div>
                    <div class="comment-content">
                        <p class="comment-text">{{ $comment->content }}</p>
                        <div class="comment-actions">
                            <span>{{ $comment->user->name }}</span>
                            @if ($comment->user_id === auth()->id())
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <span>
                                        <button type="submit" class="action-button"
                                            style="background:#c0392b;padding:4px 10px;font-size:0.9em; width: 10%;">Eliminar</button>
                                    </span>
                                </form>
                            @endif
                            {{-- Botón de denunciar comentario (texto) --}}
                            @if (auth()->check() && $comment->user_id !== auth()->id())
                                <form action="{{ route('comments.report', $comment->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="action-button"
                                        style="background:#e67e22;padding:4px 10px;font-size:0.9em;margin-left:8px;width: 10%">Denunciar</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p>No hay comentarios aún.</p>
            @endforelse
        </div>
    </div>

    <script>
        function toggleWishlistPopup() {
            const popup = document.getElementById('wishlist-popup');
            popup.style.display = popup.style.display === 'none' ? 'block' : 'none';
        }
    </script>
@endsection
