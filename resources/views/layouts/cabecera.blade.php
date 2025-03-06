    <header>

        <nav class="cabecera">
        <ul>
            <a class="logo" href="{{ route('index') }}"><img src="img/Logo.png" alt=""></a>
            <a href="{{ route('index') }}">Inicio</a>
            <a href="#" id="categoriesLink">Categorías</a>
        </ul>
        </nav>

        <!--<div class="cabecera2">
            <a href="#" id="searchLink"><img src="img/lupa.png" alt="lupa"></a>
            <a href="{{ route('shoppingcart') }}"><img src="img/shopping.png" alt="shopping"></a>
            <a href="#" id="userLink"><img src="img/user.png" alt="user"></a>
            
        </div>-->
        <div class="cabecera2">
            <a href="#" id="searchLink"><img src="img/lupa.png" alt="lupa"></a>
            <a href="{{ route('shoppingcart') }}"><img src="img/shopping.png" alt="shopping"></a>
        
            @auth
                <a href="#" id="userLink">
                    <img src="{{ Auth::user()->profile_photo }}" alt="user">
                </a>
            
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
    <button class="close-btn-right" id="closeMenuright">&times;</button>

    @auth
        <hr class="separator">
        <p>Mi cuenta</p>
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
        
        <!-- Formulario de cierre de sesión -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    @else
        <!-- Si el usuario no está autenticado, mostrar el botón de "Iniciar Sesión" -->
        <div class="flex justify-center items-center h-full">
            <a class="session bg-blue-600 text-white px-4 py-2 rounded-lg" href="{{ route('login.show') }}">
                Iniciar Sesión
            </a>
        </div>
    @endauth
</div>

<!-- Popup de inicio de sesión -->
<div class="login-popup" id="loginPopup" style="display:none;">
    <div class="popup-content">
        <p>¡Debes iniciar sesión para acceder a esta sección!</p>
        <a href="{{ route('login.show') }}" class="session bg-blue-600 text-white px-4 py-2 rounded-lg">Iniciar Sesión</a>
        <button id="closePopup" class="close-popup">Cerrar</button>
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

<script src="{{ asset('js/menu_lateral.js') }}"></script>