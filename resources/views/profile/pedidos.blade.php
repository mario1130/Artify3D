@extends('layouts.plantilla_user_menu')

@section('title', 'Pedidos')

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
            box-shadow: 0 0 0 2px #22c55e;
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
            color: #22c55e;
            font-weight: bold;
            margin: 0 0 10px 0;
            font-size: 0.95em;
        }

        .acciones {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }

        .devolver-btn {
            background: #22c55e;
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
        .devolver-btn:hover {
            background-color: #15803d;
        }

        .comprado-btn {
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 7px 18px;
            font-size: 0.98em;
            cursor: default;
            text-decoration: none;
            display: inline-block;
        }

        .badge {
            display: inline-block;
            background: #444;
            color: #fff;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.95rem;
        }
        .badge-rechazada {
            background: #e11d48 !important;
        }

        .modal-devolucion {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: #000a;
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .modal-devolucion .modal-content {
            background: #222;
            padding: 30px 24px;
            border-radius: 10px;
            max-width: 350px;
            width: 90%;
            color: #fff;
            position: relative;
        }

        .modal-devolucion .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: #fff;
            font-size: 1.3rem;
            cursor: pointer;
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
            <h1 class="header">Pedidos</h1>
        </div>
        <div class="order-list">
            @php
                $orders = \App\Models\Order::where('user_id', auth()->id())
                    ->latest()
                    ->get();
            @endphp

            @forelse($orders as $order)
                @foreach ($order->items as $item)
                    @php
                        $devolucion = \App\Models\Returns::where('order_item_id', $item->id)->first();
                        $mostrar = !$devolucion || ($devolucion && $devolucion->status === 'rechazada');
                        $diasDesdeCompra = \Carbon\Carbon::parse($order->created_at)->diffInDays(now());
                        $diasRestantes = 5 - $diasDesdeCompra;
                        $product = \App\Models\Product::find($item->product_id);
                        $photoUrl =
                            $product && $product->mainPhoto
                                ? asset($product->mainPhoto->photo_url)
                                : asset('img/Default_product.png');
                    @endphp
                    @if ($mostrar)
                        <div class="pedido">
                            <div class="pedido-contenido">
                                <div class="imagen">
                                    <img src="{{ $photoUrl }}" alt="{{ $product->name ?? 'Sin nombre' }}">
                                </div>
                                <div class="detalles">
                                    <p class="fecha">Comprado el {{ $order->created_at->format('d \d\e F Y') }}</p>
                                    <p class="titulo">{{ $item->product_name }}</p>
                                    <p class="precio">{{ number_format($item->product_price, 2) }}€</p>
                                    <div class="acciones">
                                        @if ($devolucion && $devolucion->status === 'rechazada')
                                            <span class="badge badge-rechazada">Rechazada</span>
                                        @elseif(!$devolucion && $diasRestantes > 0)
                                            <button type="button"
                                                class="devolver-btn"
                                                onclick="openReturnModal({{ $item->id }})">Devolver</button>
                                            <span class="badge">
                                                Te quedan {{ $diasRestantes }} día{{ $diasRestantes == 1 ? '' : 's' }} para devolver
                                            </span>
                                            <!-- Modal para devolución -->
                                            <div class="modal-devolucion" id="modal-devolucion-{{ $item->id }}">
                                                <div class="modal-content">
                                                    <button class="close-btn"
                                                        onclick="closeReturnModal({{ $item->id }})">&times;</button>
                                                    <h3>Solicitar devolución</h3>
                                                    <form method="POST" action="{{ route('returns.store') }}">
                                                        @csrf
                                                        <input type="hidden" name="order_item_id"
                                                            value="{{ $item->id }}">
                                                        <textarea name="reason" placeholder="Motivo de la devolución" style="width:100%;margin-bottom:12px;"></textarea>
                                                        <button type="submit"
                                                            style="background:#22c55e;color:#fff;border:none;padding:8px 18px;border-radius:5px;cursor:pointer;">Confirmar
                                                            devolución</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @elseif(!$devolucion && $diasRestantes <= 0)
                                            <button type="button"
                                                class="comprado-btn"
                                                disabled>Comprado</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @empty
                <p style="color:#fff;">No tienes pedidos aún.</p>
            @endforelse
        </div>
        <div class="pagination">
        </div>
    </div>
    <script>
        function openReturnModal(id) {
            document.getElementById('modal-devolucion-' + id).style.display = 'flex';
        }

        function closeReturnModal(id) {
            document.getElementById('modal-devolucion-' + id).style.display = 'none';
        }
    </script>
@endsection