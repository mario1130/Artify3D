@extends('layouts.plantilla_dashboard')

@section('context')
    <style>
        .form-card textarea#mensaje {
            min-height: 580px;
            max-height: 600px;
            width: 100%;
            resize: vertical;
            font-size: 1.1rem;
            padding: 18px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            background: #f9fafb;
            color: #22223b;
            box-shadow: 0 2px 8px 0 #0001;
            margin-bottom: 18px;
            transition: border 0.2s;
        }

        .form-card textarea#mensaje:focus {
            border: 1.5px solid #6366f1;
            outline: none;
            background: #fff;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }
    </style>
    <div class="top-bar" style="">
        <h1 style="font-weight:bold; ">Contactar con Soporte</h1>
    </div>

    <h2 class="title">Enviar mensaje al soporte</h2>

    <div class="container">
        <div class="form-card">
            @if (session('success'))
                <div class="alert alert-success"
                    style="color: #fff; background: #22c55e; padding: 10px 20px; border-radius: 6px; margin-bottom: 18px;">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger"
                    style="color: #fff; background: #e11d48; padding: 10px 20px; border-radius: 6px; margin-bottom: 18px;">
                    <ul style="margin: 0; padding-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.soporte.enviar') }}" method="POST"
                style="display: flex; flex-direction: column; height: 100%;">
                @csrf
                <div class="form-fields-center">
                    <div class="form-group" style="width:100%;">
                        <textarea id="mensaje" name="mensaje" rows="10" style="width:100%;resize:vertical;" required
                            placeholder="Escribe tu mensaje aquí...">{{ old('mensaje') }}</textarea>
                        @error('mensaje')
                            <div class="error-message" style="color: #e11d48;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="action-button save">Enviar</button>
                    <a href="{{ route('admin.dashboard') }}" class="action-button cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
