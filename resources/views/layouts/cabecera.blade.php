    <header>

        <nav class="cabecera">
        <ul>
            <a class="logo" href="/"><img src="img/Logo.png" alt=""></a>
            <a href="/">Inicio</a>
            <a href="#" id="categoriesLink">Categorías</a>
        
        </ul>
        </nav>

        <div class="cabecera2">
            <a href="#" id="searchLink"><img src="img/lupa.png" alt="lupa"></a>
            <a href="#" id="userLink"><img src="img/user.png" alt="user"></a>
            <a href="/shoppingcart"><img src="img/shopping.png" alt="shopping"></a>
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

    <hr class="separator">
    <p>Mi Cuenta</p>
    <ul>
        <a class="menu-title">Mi Cuenta</a>
        <li><a href="#">Mis datos</a></li>
        <li><a href="#">Comentarios</a></li>
        <li><a href="#">Lista de Deseos</a></li>
        <li><a href="#">Notificaciones</a></li>
        <li><a href="#">Mis productos</a></li>
    </ul>
    <hr class="separator2">
    <ul>
        <a class="menu-title">Compras</a>
        <li><a href="#">Pedidos</a></li>
        <li><a href="#">Pedidos Cancelados</a></li>
        <li><a href="#">Historial de Compras</a></li>
        
    </ul>

    
    <div class="menu-session">
        <hr class="separator2">
        <a class="session" href="/session">Iniciar Sesión</a>
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