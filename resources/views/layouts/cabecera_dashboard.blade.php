    <header>

        <nav class="cabecera">
        <ul>
            <a class="logo" href="{{ route('admin.dashboard') }}"><img src="{{ asset('img/favicon_artify.png') }}" alt=""></a>
            <a>ARTIFY3D</a>
        </ul>
        </nav>

        <div class="side-menu-up" id="sideMenuup">
        <div class="search">
            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="query" id="searchInput" placeholder="Búsqueda" />
            </form>
        </div>
        </div>
        
        <div class="cabecera2">
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

        
        <ul>
            <a class="menu-title">C</a>
            <a class="menu-title">C</a>
        </ul>
        <hr class="separator">
        <ul>
            <a class="menu-title">C</a>
            <a class="menu-title">C</a>
            <a class="menu-title">C</a>
            <a class="menu-title">C</a>
            <a class="menu-title">C</a>
            <a class="menu-title">C</a>
            <a class="menu-title">C</a>
        </ul>
        <hr class="separator">
        <ul>
            <a class="menu-title">C</a>
            <a class="menu-title">C</a>
            <a class="menu-title">C</a>
        </ul>
        <hr class="separator">
        <ul>
            <a class="menu-title">C</a>
            <a class="menu-title">C</a>
        </ul>
</div>


<!-- Menú lateral derecho -->
<div class="side-menu-right" id="sideMenuright" data-logged-in="{{ auth()->check() ? 'true' : 'false' }}">
    <button class="close-btn-right" id="closeMenuright">&times;</button>

    
        <ul>
            <a class="menu-title">Usuario</a>
            <li><a href="{{ route('profile.index') }}" id="userLink">Mis Datos</a></li>
            <li><a href="#">Configuración</a></li>
        </ul>
        
        <!-- Formulario de cierre de sesión -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button class="Cerrar-Session" type="submit">Cerrar Sesión</button>
        </form>
    
</div>



<!-- Overlay -->
<div class="overlay" id="menuOverlay"></div>

<script src="{{ asset('js/menu_lateral_dashboard.js') }}"></script>