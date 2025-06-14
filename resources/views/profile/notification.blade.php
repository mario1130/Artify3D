@extends('layouts.plantilla_user_menu')

@section('title', 'Notificaciones')

@section('context')
    <style>
        h1,
        h2 {
            text-align: center;
            margin-top: 20px;
        }

        .seccion {
            margin: 30px auto;
            max-width: 600px;
        }

        .grupo {
            margin-bottom: 40px;
        }

        .grupo h3 {
            font-size: 0.9em;
            color: #ccc;
            border-bottom: 1px solid #333;
            padding-bottom: 5px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .notificacion {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            transition: opacity 0.2s;
        }

        .notificacion.leida {
            opacity: 0.5;
        }

        .notificacion .imagen {
            width: 60px;
            height: 50px;
            border: 1px solid #aaa;
            border-radius: 5px;
            margin-right: 15px;
            flex-shrink: 0;
            background: #222;
        }

        .notificacion .contenido {
            display: flex;
            flex-direction: column;
        }

        .contenido p {
            margin: 0;
            font-size: 0.95em;
        }

        .contenido span {
            margin-top: 5px;
            font-size: 0.8em;
            color: #999;
        }

        hr {
            border: 1px solid #333;
            margin: 30px 0;
        }

        .acciones {
            margin-top: 8px;
        }

        .acciones a {
            color: #00c853;
            font-size: 0.85em;
            margin-right: 10px;
            text-decoration: underline;
        }
    </style>

<div class="main-content">
    <h2>Mis Notificaciones</h2>

    <div class="seccion">
        @php
            $now = \Carbon\Carbon::now();
            $notificaciones24h = auth()
                ->user()
                ->notifications->filter(function ($n) use ($now) {
                    return $n->created_at->diffInHours($now) < 24;
                });
            $notificacionesAntiguas = auth()
                ->user()
                ->notifications->filter(function ($n) use ($now) {
                    return $n->created_at->diffInHours($now) >= 24;
                });
        @endphp

        <div class="grupo">
            <h3>Últimas 24 horas</h3>
            @forelse ($notificaciones24h as $notification)
                <div class="notificacion{{ $notification->read_at ? ' leida' : '' }}">
                    <div class="imagen"></div>
                    <div class="contenido">
                        @if (($notification->data['type'] ?? null) === 'global')
                            <p style="color:#e11d48; font-weight:bold;">
                                {{ $notification->data['message'] ?? 'Notificación' }}
                            </p>
                        @else
                            <p>{{ $notification->data['message'] ?? 'Notificación' }}</p>
                        @endif
                        <span>{{ $notification->created_at->diffForHumans() }} •
                            {{ $notification->data['type'] ?? 'General' }}</span>
                        <div class="acciones">
                            <a href="{{ route('notifications.read', $notification->id) }}">Ver más</a>
                            <a href="{{ route('notifications.delete', $notification->id) }}">Eliminar</a>
                        </div>
                    </div>
                </div>
            @empty
                <p style="color:#888;">No tienes notificaciones recientes.</p>
            @endforelse
        </div>

        <hr>

        <div class="grupo">
            <h3>Anteriores</h3>
            @forelse ($notificacionesAntiguas as $notification)
                <div class="notificacion{{ $notification->read_at ? ' leida' : '' }}">
                    <div class="imagen"></div>
                    <div class="contenido">
                        @if (($notification->data['type'] ?? null) === 'global')
                            <p style="color:#e11d48; font-weight:bold;">
                                {{ $notification->data['message'] ?? 'Notificación' }}
                            </p>
                        @else
                            <p>{{ $notification->data['message'] ?? 'Notificación' }}</p>
                        @endif
                        <span>{{ $notification->created_at->diffForHumans() }} •
                            {{ $notification->data['type'] ?? 'General' }}</span>
                        <div class="acciones">
                            <a href="{{ route('notifications.read', $notification->id) }}">Ver más</a>
                            <a href="{{ route('notifications.delete', $notification->id) }}">Eliminar</a>
                        </div>
                    </div>
                </div>
            @empty
                <p style="color:#888;">No tienes notificaciones anteriores.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
