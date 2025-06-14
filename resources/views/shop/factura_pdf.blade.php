<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Factura #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 40px;
            color: #333;
            line-height: 1.6;
            background-color: #fff;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            background-color: #fff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 2.2em;
            color: #333;
            margin: 0;
        }

        .shop-logo {
            width: 120px;
            height: auto;
            background-color: #222;
            color: #fff;
            text-align: center;
            line-height: 50px;
            font-weight: bold;
            font-size: 1.1em;
            padding: 5px 10px;
            border-radius: 6px;
        }

        .order-info {
            margin-bottom: 30px;
        }

        .order-info p {
            margin: 5px 0;
            font-size: 0.95em;
        }

        .order-info strong {
            color: #555;
        }

        .section-title {
            font-size: 1.2em;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #333;
            font-weight: bold;
        }

        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .item-table th,
        .item-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        .item-table th {
            background-color: #f9f9f9;
            font-weight: bold;
            color: #555;
            font-size: 0.9em;
        }

        .item-table .item-details {
            display: flex;
            align-items: center;
        }

        .item-table .item-image-placeholder {
            width: 60px;
            height: 60px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .item-table .item-description {
            font-size: 0.9em;
            color: #333;
        }

        .item-table .item-description strong {
            display: block;
            margin-bottom: 3px;
        }

        .item-table .price {
            font-weight: bold;
            white-space: nowrap;
        }

        .summary-table {
            width: 300px;
            float: right;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 8px 0;
            text-align: right;
            border-bottom: 1px solid #eee;
            font-size: 0.95em;
        }

        .summary-table .label {
            text-align: left;
            color: #555;
        }

        .summary-table .total-row td {
            font-weight: bold;
            font-size: 1.1em;
            border-top: 2px solid #333;
            border-bottom: none;
            padding-top: 15px;
        }

        .summary-table .points-row td {
            font-weight: bold;
            color: #555;
            border-bottom: none;
            padding-top: 5px;
        }

        .address-section {
            clear: both;
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .address-box {
            width: 48%;
            box-sizing: border-box;
            padding-right: 20px;
            margin-bottom: 20px;
        }

        .address-box h3 {
            font-size: 1.1em;
            margin-top: 0;
            margin-bottom: 10px;
            color: #333;
        }

        .address-box p {
            margin: 3px 0;
            font-size: 0.9em;
            color: #555;
        }

        .nif-nie {
            margin-top: 15px;
            font-size: 0.9em;
            color: #555;
        }

        .footer-notes {
            clear: both;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.85em;
            color: #777;
            text-align: justify;
        }

        .footer-notes p {
            margin-bottom: 10px;
        }

        .footer-notes strong {
            color: #555;
        }

        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .container {
                padding: 15px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .shop-logo {
                margin-top: 15px;
            }

            .item-table th,
            .item-table td {
                padding: 8px;
            }

            .summary-table {
                width: 100%;
                float: none;
                margin-left: 0;
                margin-right: 0;
            }

            .address-section {
                flex-direction: column;
            }

            .address-box {
                width: 100%;
                padding-right: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Factura</h1>
            <div class="shop-logo">ARTIFY3D</div>
        </div>

        <div class="order-info">
            <p><strong>Número de pedido:</strong> #{{ $order->id }}</p>
            <p><strong>Fecha del pedido:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
        </div>

        <div class="section-title">ARTÍCULOS</div>
        <table class="item-table">
            <thead>
                <tr>
                    <th></th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>
                            <div class="item-details">
                                <div class="item-image-placeholder">
                                    {{-- Si tienes imagen: --}}
                                    {{-- <img src="{{ asset($item->product_image) }}" style="width:60px;height:60px;object-fit:cover;"> --}}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="item-description">
                                <strong>{{ $item->product_name }}</strong>
                                {{-- Puedes añadir más detalles aquí --}}
                            </div>
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td class="price">{{ number_format($item->product_price, 2) }} €</td>
                        <td class="price">{{ number_format($item->product_price * $item->quantity, 2) }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="summary-table">
            <tr>
                <td class="label">Subtotal</td>
                <td>{{ number_format($order->subtotal ?? $order->total, 2) }} €</td>
            </tr>
            <tr>
                <td class="label">Descuento</td>
                <td>{{ number_format($order->discount ?? 0, 2) }} €</td>
            </tr>
            <tr>
                <td class="label">Gastos de envío</td>
                <td>{{ number_format($order->shipping ?? 0, 2) }} €</td>
            </tr>
            <tr class="total-row">
                <td class="label">TOTAL</td>
                <td>{{ number_format($order->total, 2) }} €</td>
            </tr>
            @if (isset($order->points))
                <tr class="points-row">
                    <td class="label">Puntos obtenidos</td>
                    <td>{{ $order->points }} P</td>
                </tr>
            @endif
        </table>

        <div class="address-section">
            <div class="address-box">
                <h3>Método de pago:</h3>
                <p>{{ $order->payment_method ?? 'Tarjeta' }}</p>
                <p>{{ $order->card_holder ?? ($order->user->name ?? '') }}</p>
                <p>{{ $order->card_expiry ?? '' }}</p>
            </div>

        </div>
        @if (isset($order->nif))
            <p class="nif-nie">NIF/NIE: {{ $order->nif }}</p>
        @endif

        <div class="footer-notes">
            <p>Este documento es informativo, no siendo equivalente a la factura oficial. Recibirás un email con la
                factura de tu compra realizada en Artify3D en un máximo de 24 horas tras haber recepcionado tu pedido.
                Para cualquier pregunta relacionada con la misma puedes ponerte en contacto con nuestro servicio de
                atención al cliente.</p>
        </div>
    </div>
</body>

</html>
