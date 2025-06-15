@extends('layouts.plantilla_user_menu')

@section('title', 'Pedidos Cancelados')

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
            margin-left: 12rem;
        }

        .order-list {
            display: flex;
            flex-direction: column;
            gap: 30px;
            align-items: stretch;
            width: 100%;
        }

        .pedido {
            background: #181818;
            border: 1px solid #333;
            border-radius: 10px;
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

        .pedido:hover {
            box-shadow: 0 0 0 2px #1D7129;
        }

        .pedido:last-child {
            border-bottom: none;
        }

        .pedido .fecha {
            color: #aaa;
            font-size: 0.95rem;
            margin-bottom: 10px;
            width: 100%;
        }

        .pedido-contenido {
            display: flex;
            align-items: flex-start;
            gap: 24px;
            width: 100%;
        }

        .imagen {
            width: 100px;
            height: 80px;
            background: #333;
            border-radius: 8px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .imagen img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .detalles {
            flex: 1;
            min-width: 150px;
            text-align: left;
        }

        .titulo {
            color: #fff;
            font-size: 1em;
            margin: 0 0 5px 0;
            line-height: 1.4;
            min-height: 2.5em;
        }

        .precio {
            color: #1D7129;
            font-weight: bold;
            margin: 0 0 10px 0;
            font-size: 0.95em;
        }

        .acciones {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }

        .comentar-btn {
            background-color: #1D7129;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 7px 18px;
            font-size: 0.98em;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .comentar-btn:hover {
            background-color: #1D7129;
        }

        .badge {
            display: inline-block;
            background: #e11d48;
            color: #fff;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.95rem;
            margin-left: 10px;
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
            .order-list {
                gap: 18px;
            }
        }

        @media (max-width: 768px) {
            .pedido {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
                max-width: 100%;
                padding: 15px 8px;
            }
            .pedido-contenido {
                flex-direction: column;
                gap: 10px;
                width: 100%;
            }
            .imagen {
                margin-right: 0;
                margin-bottom: 10px;
                width: 90vw;
                max-width: 320px;
                height: 30vw;
                max-height: 120px;
                align-self: center;
            }
            .detalles {
                margin-right: 0;
                margin-bottom: 10px;
                text-align: center;
                min-width: 0;
            }
            .acciones {
                justify-content: center;
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
            .imagen {
                width: 90vw;
                max-width: 250px;
                height: 28vw;
                max-height: 90px;
            }
            .titulo {
                font-size: 1em;
            }
            .precio {
                font-size: 0.95em;
            }
        }
    </style>

    <div class="main-content">
        <div class="title-container">
            <h1 class="header">Pedidos Cancelados</h1>
        </div>
        <div class="order-list">
            @php
                $orders = \App\Models\Order::where('user_id', auth()->id())
                    ->latest()
                    ->get();
                $hayCancelados = false;
            @endphp

            @foreach ($orders as $order)
                @foreach ($order->items as $item)
                    @php
                        $devolucion = \App\Models\Returns::where('order_item_id', $item->id)
                            ->where('status', 'aceptada')
                            ->first();
                        $product = \App\Models\Product::find($item->product_id);
                        $photoUrl =
                            $product && $product->mainPhoto
                                ? asset($product->mainPhoto->photo_url)
                                : asset('img/Default_product.png');
                    @endphp
                    @if ($devolucion)
                        @php $hayCancelados = true; @endphp
                        <div class="pedido">
                            <div class="pedido-contenido">
                                <div class="imagen">
                                    <img src="{{ $photoUrl }}" alt="{{ $product->name ?? 'Sin nombre' }}">
                                </div>
                                <div class="detalles">
                                    <p class="fecha">
                                        Cancelado el {{ \Carbon\Carbon::parse($devolucion->updated_at)->format('d \d\e F Y') }}
                                        <span class="badge">{{ ucfirst($devolucion->status) }}</span>
                                    </p>
                                    <p class="titulo">{{ $item->product_name }}</p>
                                    <p class="precio">{{ number_format($item->product_price, 2) }}€</p>
                                    <div class="acciones">
                                        <button class="comentar-btn">Comentar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach

            @if (!$hayCancelados)
                <p style="color:#fff;">No tienes pedidos cancelados.</p>
            @endif
        </div>
        <div class="pagination">
        </div>
    </div>
@endsection