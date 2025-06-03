@extends('layouts.plantilla_user_menu')

@section('title', 'Pedidos Cancelados')

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
    background: #e11d48;
    color: #fff;
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 0.95rem;
    margin-left: 10px;
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

<main>
    <h1>Pedidos Cancelados</h1>
    @php
        $orders = \App\Models\Order::where('user_id', auth()->id())->latest()->get();
        $hayCancelados = false;
    @endphp

    @foreach($orders as $order)
        @foreach($order->items as $item)
            @php
                $devolucion = \App\Models\Returns::where('order_item_id', $item->id)
                    ->where('status', 'aceptada')
                    ->first();
            @endphp
            @if($devolucion)
                @php $hayCancelados = true; @endphp
                <section class="pedido">
                    <p class="fecha">
                        Cancelado el {{ \Carbon\Carbon::parse($devolucion->updated_at)->format('d \d\e F Y') }}
                        <span class="badge">{{ ucfirst($devolucion->status) }}</span>
                    </p>
                    <div class="pedido-contenido">
                        <div class="imagen">
                            {{-- Si tienes imagen: <img src="{{ $item->product_image }}" alt="Producto"> --}}
                        </div>
                        <div class="detalles">
                            <p class="titulo">{{ $item->product_name }}</p>
                            <p class="precio">{{ number_format($item->product_price, 2) }}€</p>
                            <div class="acciones">
                                <button class="comentar">Comentar</button>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    @endforeach

    @if(!$hayCancelados)
        <p style="color:#fff;">No tienes pedidos cancelados.</p>
    @endif
</main>
@endsection