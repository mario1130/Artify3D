@extends('layouts.plantilla_solo_cabecera')

@section('title', 'Método de pago')

@section('context')
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #0e0e0e;
            color: white;
        }

        .steps {
            display: flex;
            justify-content: center;
            margin-top: 0;
            position: static;
            top: 88px;
            left: 0;
            background: #0e0e0e;
            z-index: 999;
            padding-top: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #444;
        }

        .step {
            margin: 0 40px;
            text-align: center;
            position: relative;
        }

        .step::after {
            content: '';
            position: absolute;
            right: -90px;
            top: 20%;
            width: 100px;
            height: 2px;
            background-color: gray;
        }

        .step:last-child::after {
            display: none;
        }

        .step span {
            display: inline-block;
            border: 2px solid white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            line-height: 20px;
            text-align: center;
            margin-bottom: 5px;
            background: #444;
        }

        .active-step span {
            background: #000000;
            border-color: #22c55e;
            color: #fff;
        }

        .active-step div {
            color: #ffffff;
        }

        .container-outer {
            max-width: 1100px;
            margin: 0 auto 5rem auto;
            padding: 0 16px;
        }

        h2 {
            text-align: left;
            margin: 30px 0 20px 0;
            padding: 0;
            font-size: 2rem;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 7rem;
            margin: 0 auto;
            max-width: 1100px;
        }

        .checkout-btn {
            background-color: #22c55e;
            color: white;
            border: none;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            cursor: pointer;
            display: inline-block;
            text-align: center;
        }

        .payment-methods {
            display: flex;
            flex-direction: column;
            gap: 20px;
            background-color: #141414;
            border: 1px solid #444;
            padding: 20px;
            width: 60%;
        }

        .payment-method {
            width: 100%;
            margin-bottom: 0;
        }

        .payment-method input[type="text"],
        .payment-method input[type="email"] {
            width: calc(100% - 10px);
            margin: 5px 0;
            padding: 8px;
            background-color: #222;
            border: 1px solid #555;
            color: white;
        }

        .half-inputs {
            display: flex;
            gap: 10px;
        }

        .confirm-button {
            background-color: #22c55e;
            color: white;
            border: none;
            padding: 8px 12px;
            margin-top: 10px;
            cursor: pointer;
        }

        .summary {
            background-color: #141414;
            border: 1px solid #444;
            padding: 20px;
            width: 30%;
            height: fit-content;
        }

        .summary h3 {
            margin-top: 0;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .continue-button {
            background-color: #22c55e;
            color: white;
            border: none;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            cursor: pointer;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        @media (max-width: 700px) {
            .container-outer {
                max-width: 98vw;
                padding: 0 8px;
            }

            .container {
                flex-direction: column;
                gap: 1rem;
                max-width: 100vw;
            }

            h2 {
                font-size: 1.3rem;
            }

            .payment-methods,
            .summary {
                width: 100%;
            }
        }
    </style>

    <div class="steps">
        <div class="step"><span>1</span>
            <div>Mi Cesta</div>
        </div>
        <div class="step active-step"><span>2</span>
            <div>Método de pago</div>
        </div>
        <div class="step"><span>3</span>
            <div>Resumen</div>
        </div>
    </div>

    <div class="container-outer">

        <h2>Método de pago</h2>

        @php
            $cartItems = App\Models\ShoppingCart::where('user_id', auth()->id())->get();
            $total = $cartItems->sum(function ($item) {
                return $item->product_price * $item->quantity;
            });
        @endphp

        @if ($errors->any())
            <div style="background:#ffdddd; color:#b10000; padding:10px; border-radius:6px; margin-bottom:20px;">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container">
            <form id="pago-form" class="payment-methods" method="POST" action="{{ route('pago.confirmar') }}">
                @csrf
                <div class="payment-method">
                    <label>
                        <input type="radio" name="payment" value="tarjeta" checked>
                        Tarjeta de crédito o débito
                    </label>
                    <div class="tarjeta-fields">
                        <input type="text" name="card_number" placeholder="Número de tarjeta">
                        <div class="half-inputs">
                            <input type="text" name="card_expiry" placeholder="MM/AA">
                            <input style="margin-right: 0.7rem;" type="text" name="card_cvc" placeholder="3 dígitos">
                        </div>
                        <input type="text" name="card_name" placeholder="Nombre del Titular">
                    </div>
                </div>

                <div class="payment-method">
                    <label>
                        <input type="radio" name="payment" value="paypal">
                        Paypal
                    </label>
                    <div class="paypal-fields" style="display: none;">
                        <input type="email" name="paypal_email" placeholder="Correo de PayPal" disabled>
                    </div>
                </div>

                <div class="payment-method">
                    <label>
                        <input type="radio" name="payment" value="transferencia" disabled>
                        Transferencia ordinaria
                    </label>
                </div>
            </form>

            <div class="summary">
                <h3>Resumen</h3>
                <div class="summary-line">
                    <span>Subtotal</span>
                    <span>{{ number_format($total, 2) }}€</span>
                </div>
                <hr style="border-color: #444;">
                <small>Total (Impuestos Incluidos)</small>
                <button type="button" class="checkout-btn" onclick="document.getElementById('pago-form').submit();">
                    Guardar y Pagar
                </button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[name="payment"]');
            const tarjetaFields = document.querySelector('.tarjeta-fields');
            const paypalFields = document.querySelector('.paypal-fields');

            function updateFields() {
                const selectedRadio = document.querySelector('input[name="payment"]:checked');
                if (!selectedRadio) {
                    tarjetaFields.style.display = 'none';
                    paypalFields.style.display = 'none';
                    return;
                }
                const selected = selectedRadio.value;
                tarjetaFields.style.display = selected === 'tarjeta' ? 'block' : 'none';
                paypalFields.style.display = selected === 'paypal' ? 'block' : 'none';
            }

            radios.forEach(radio => {
                radio.addEventListener('change', updateFields);
            });

            updateFields(); // Inicializa al cargar
        });
    </script>
@endsection
