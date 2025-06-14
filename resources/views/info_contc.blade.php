@extends('layouts.plantilla')

@section('title', 'Información de Contacto')

@section('context')
    <style>
        .contact-container {
            max-width: 800px;
            margin: 40px auto;
            background: #181818;
            color: #f0f0f0;
            border-radius: 10px;
            padding: 32px 24px;
            box-shadow: 0 2px 8px #0002;
            font-size: 1.05em;
            line-height: 1.7;
        }

        .contact-container h1,
        .contact-container h2 {
            color: #4CAF50;
            margin-top: 1.5em;
            margin-bottom: 0.5em;
        }

        .contact-container a {
            color: #4CAF50;
            text-decoration: underline;
            word-break: break-all;
        }

        .contact-container ul {
            margin-left: 1.5em;
            margin-bottom: 1em;
        }
    </style>

    <div class="contact-container">
        <h1>Información de Contacto</h1>
        <p>Si tienes cualquier duda, consulta o necesitas soporte, puedes ponerte en contacto con nosotros a través de los
            siguientes medios:</p>

        <ul>
            <li><strong>Correo electrónico:</strong> <a href="mailto:soporte@artify3d.es">soporte@artify3d.es</a></li>

            <li><strong>Dirección:</strong> Calle Ejemplo 123, 28000 Madrid, España</li>
        </ul>

        <h2>Horario de atención</h2>
        <p>Lunes a Viernes de 9:00 a 18:00 (CET)</p>

        <h2>Redes sociales</h2>
        <ul>
            <li><a href="https://twitter.com/nategentile" target="_blank">Twitter</a></li>
            <li><a href="https://instagram.com/nategentile" target="_blank">Instagram</a></li>
            <li><a href="https://youtube.com/nategentile" target="_blank">YouTube</a></li>
        </ul>
    </div>
@endsection
