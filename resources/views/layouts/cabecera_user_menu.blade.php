<header>

    <nav class="cabecera">
    <ul>
        <a class="logo" href="{{ route('index') }}"><img src="img/Logo.png" alt=""></a>
        <a href="{{ route('index') }}">Inicio</a>
        <a href="#" id="categoriesLink">Categorías</a>
    
    </ul>
    </nav>

    <div class="cabecera2">
        <a href="#" id="searchLink"><img src="{{ asset('img/lupa.png') }}" alt="lupa"></a>
        <a href="{{ route('shoppingcart') }}"><img class="shopping" src="{{ asset('img/shopping.png') }}" alt="shopping"></a>
    
        @auth
            @if (Auth::user()->profile_photo)
            <a href="#" id="userLink">
                <img src="{{ Auth::user()->profile_photo }}" alt="user">
            </a>
            @else
            <a href="#" id="userLink">
                <img class="user-avatar" src="data:image/png;base64,{{ \App\Helpers\ImageHelper::generateInitialAvatar(Auth::user()->name) }}" alt="user">
            </a>
            @endif
        @else
            <a href="{{ route('login.show') }}" id="userLink"><img src="img/user.png" alt="user"></a>
        @endauth
    </div>
</header>


<!-- Menú lateral izquierdo -->
<div class="side-menu" id="sideMenu">
<button class="close-btn" id="closeMenu">&times;</button>

<hr class="separator">
<ul>
    <a class="menu-title">Categorías</a>
    <li><a href="#">Renders</a></li>
    <li><a href="#">Tutoriales</a></li>
    <li><a href="#">Blender</a></li>
    <li><a href="#">Maya</a></li>
    <li><a href="#">SketchUp</a></li>
</ul>
<hr class="separator2">
<ul>
    <a class="menu-title">Trending</a>
    <li><a href="#">Populars</a></li>
    <li><a href="#">Best Rated</a></li>
</ul>


</div>



<!-- Menú lateral derecho -->
<div class="side-menu-right" id="sideMenuright">
    <ul>
        <a class="menu-title">Mi Cuenta</a>
        <li><a href="#">Mis datos</a></li>
        <li><a href="#">Comentarios</a></li>
        <li><a href="#">Lista de Deseos</a></li>
        <li><a href="#">Notificaciones</a></li>
        <li><a href="{{ route('my_products.index') }}">Mis productos</a></li>
    </ul>
    <hr class="separator2">
    <ul>
        <a class="menu-title">Compras</a>
        <li><a href="#">Pedidos</a></li>
        <li><a href="#">Pedidos Cancelados</a></li>
        <li><a href="#">Historial de Compras</a></li>
    </ul>

    <!-- Iniciar sesión -->
    <div class="menu-session">
        <hr class="separator2">
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button class="Cerrar-Session" type="submit">Cerrar Sesión</button>
        </form>
    </div>
</div>


<!-- Menú up -->
<div class="side-menu-up" id="sideMenuup">

<div class="search">
    <input type="text" id="searchInput" placeholder="Búsqueda" />
    <button class="search-button" id="searchButton"><img src="img/lupa.png" alt="lupa"></button>
    <button class="close-btn-up" id="closeMenuup">&times;</button>
</div>


</div>




<!-- Overlay -->
<div class="overlay" id="menuOverlay"></div>
<div class="overlayup" id="menuOverlayup"></div>

<script src="{{ asset('js/menu_lateral_izquierdo.js') }}"></script>