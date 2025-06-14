@extends('layouts.plantilla_user_menu')

@section('title', 'Mis Listas de Deseos')

@section('context')
    <style>
        .header {
            width: 100%;
            max-width: 900px;
            margin: 40px auto 0 auto;
            text-align: left;
        }

        .header h1 {
            color: #4CAF50;
            text-decoration: underline;
            font-size: 1.8em;
            margin: 0;
            padding-left: 20px;
        }



        h2 {
            font-size: 2.2em;
            margin-bottom: 40px;
            color: #f0f0f0;
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 60px;
            margin-bottom: 50px;
            flex-wrap: wrap;
        }

        .feature-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 350px;
            text-align: left;
        }

        .icon-box {
            font-size: 3em;
            color: #f0f0f0;
            border: 2px solid #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            display: inline-block;
            line-height: 1;
        }

        .icon-people {
            font-size: 3em;
            color: #f0f0f0;
            margin-bottom: 10px;
            border: 2px solid #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            line-height: 1;
        }

        .feature-box h3 {
            font-size: 1.2em;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .feature-box p {
            font-size: 0.9em;
            color: #cccccc;
            line-height: 1.4;
        }

        .create-list-button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            text-decoration: none;
            margin-bottom: 60px;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .create-list-button:hover {
            background-color: #45a049;
        }

        .list-items {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .list-card {
            background-color: #333333;
            border-radius: 8px;
            width: 250px;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            overflow: hidden;
            border: 1px solid #555555;
            margin-bottom: 20px;
            position: relative;
            transition: box-shadow 0.2s;
            cursor: pointer;
        }

        .list-card:hover {
            box-shadow: 0 0 0 2px #4CAF50;
        }

        .list-name {
            background-color: #444444;
            color: #f0f0f0;
            padding: 15px 10px;
            text-align: center;
            font-size: 1.1em;
            border-top: 1px solid #555555;
        }

        .list-actions {
            position: absolute;
            top: 10px;
            left: 10px;
            display: flex;
            gap: 8px;
            z-index: 2;
        }

        .list-actions form,
        .list-actions a {
            display: inline;
        }

        .delete-btn {
            background: #222;
            color: #f44336;
            border: none;
            border-radius: 4px;
            padding: 4px 10px;
            cursor: pointer;
            font-size: 0.95em;
            transition: background 0.2s;
        }

        .delete-btn:hover {
            background: #f44336;
            color: #fff;
        }

        .list-button {
            display: flex;
            justify-content: center;
            gap: 60px;
            margin-bottom: 50px;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .features {
                flex-direction: column;
                align-items: center;
                gap: 30px;
            }

            .list-items {
                flex-direction: column;
                align-items: center;
            }

            .header h1 {
                padding-left: 0;
                text-align: center;
            }
        }
    </style>


    <div class="main-content">
        <h2>Listas</h2>

        <div class="features">
            <div class="feature-box">
                <div class="icon-box">&#9776;</div>
                <h3>Mantente organizado</h3>
                <p>Guarda tus productos e ideas en una única ubicación</p>
            </div>
            <div class="feature-box">
                <div class="icon-people">👥</div>
                <h3>Comprar con amigos</h3>
                <p>Ver y editar productos de las listas junto con amigos</p>
            </div>
        </div>

        <div class="list-button">
            <!-- Botón para crear lista, abre el formulario -->
            <button class="create-list-button"
                onclick="document.getElementById('create-list-form').style.display='block';this.style.display='none';">
                Crear una lista
            </button>
        </div>
        <!-- Formulario para crear lista -->
        <div id="create-list-form" style="display:none; margin-bottom:40px;">
            <form action="{{ route('wishlist_group.store') }}" method="POST"
                style="display:flex; gap:10px; justify-content:center; align-items:center;">
                @csrf
                <input type="text" name="name" placeholder="Nombre de la lista" required
                    style="padding:10px; border-radius:4px; border:1px solid #555; background:#222; color:#fff;">
                <button type="submit" class="create-list-button" style="margin-bottom:0;">Crear</button>
            </form>
        </div>

        <div class="list-items">
            @forelse ($wishlistGroups as $group)
                <div class="list-card"
                    onclick="if(event.target === this || event.target.classList.contains('list-name')) window.location='{{ route('wishlist.index', $group->id) }}'">
                    <div class="list-actions">
                        <form action="{{ route('wishlist_group.destroy', $group->id) }}" method="POST"
                            onsubmit="event.stopPropagation(); return confirm('¿Eliminar esta lista?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" title="Eliminar lista">✕</button>
                        </form>
                    </div>
                    <div class="list-name">{{ $group->name }}</div>
                </div>
            @empty
                <p style="color:#aaa;">No tienes listas de deseos creadas.</p>
            @endforelse
        </div>
    </div>
@endsection
