@extends('layouts.plantilla_user_menu')

@section('title', 'Pedidos')

@section('context')
    <style>
        main {
            max-width: 900px;
            margin: 40px auto 60px auto;
            padding: 0 16px;
        }

        h1 {
            color: #fff;
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .pedido {
            background: #181818;
            border: 1px solid #333;
            border-radius: 10px;
            margin-bottom: 2rem;
            padding: 20px 24px;
            box-shadow: 0 2px 8px #0002;
        }

        .pedido .fecha {
            color: #aaa;
            font-size: 0.95rem;
            margin-bottom: 10px;
        }

        .pedido-contenido {
            display: flex;
            align-items: flex-start;
            gap: 24px;
        }

        .imagen {
            width: 90px;
            height: 70px;
            background: #333;
            border-radius: 8px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .imagen img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 8px;
        }

        .detalles {
            flex: 1;
        }

        .titulo {
            color: #fff;
            font-size: 1.1rem;
            margin-bottom: 6px;
        }

        .precio {
            color: #22c55e;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .acciones button {
            background: #222;
            color: #fff;
            border: 1px solid #444;
            border-radius: 5px;
            padding: 6px 14px;
            margin-right: 10px;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }

        .acciones button.comentar {
            background: #22c55e;
            color: #fff;
            border: none;
        }

        .acciones button:hover {
            background: #22c55e;
            color: #fff;
        }

        .badge {
            display: inline-block;
            background: #22c55e;
            color: #fff;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.95rem;
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

        @media (max-width: 700px) {
            .pedido-contenido {
                flex-direction: column;
                gap: 10px;
            }

            .imagen {
                width: 100%;
                height: 120px;
            }
        }
    </style>
    <div class="main-content">
        <main>
            <h1>Mis Pedidos</h1>
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
                        // Buscar el producto y su imagen principal
                        $product = \App\Models\Product::find($item->product_id);
                        $photoUrl =
                            $product && $product->mainPhoto
                                ? asset($product->mainPhoto->photo_url)
                                : asset('img/Default_product.png');
                    @endphp
                    @if ($mostrar)
                        <section class="pedido">
                            <p class="fecha">Comprado el {{ $order->created_at->format('d \d\e F Y') }}</p>
                            <div class="pedido-contenido">
                                <div class="imagen">
                                    <img src="{{ $photoUrl }}" alt="{{ $product->name ?? 'Sin nombre' }}">
                                </div>
                                <div class="detalles">
                                    <p class="titulo">{{ $item->product_name }}</p>
                                    <p class="precio">{{ number_format($item->product_price, 2) }}€</p>
                                    <div class="acciones">
                                        @if ($devolucion && $devolucion->status === 'rechazada')
                                            <span class="badge" style="background:#e11d48;">Rechazada</span>
                                        @elseif(!$devolucion && $diasRestantes > 0)
                                            <button type="button"
                                                onclick="openReturnModal({{ $item->id }})">Devolver</button>
                                            <span class="badge" style="background:#444;">
                                                Te quedan {{ $diasRestantes }} día{{ $diasRestantes == 1 ? '' : 's' }} para
                                                devolver
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
                                                style="background:#e74c3c;color:#fff;border:none;padding:8px 18px;border-radius:5px;cursor:default;font-size: unset;"
                                                disabled>Comprado</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                @endforeach
            @empty
                <p style="color:#fff;">No tienes pedidos aún.</p>
            @endforelse
        </main>
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
