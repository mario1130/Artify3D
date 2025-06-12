    <header>

        <nav class="cabecera">
            <ul>
                <a class="logo" href="{{ route('index') }}"><img src="{{ asset('img/Logo.png') }}" alt=""></a>
                <a href="{{ route('index') }}">Inicio</a>
                <a href="#" id="categoriesLink">Categorías</a>
            </ul>
        </nav>


        <div class="cabecera2">
            <a href="#" id="searchLink"><img src="{{ asset('img/lupa.png') }}" alt="lupa"></a>
            <a href="{{ route('shoppingcart') }}"><img class="shopping" src="{{ asset('img/shopping.png') }}"
                    alt="shopping"></a>

            @auth
                @if (Auth::user()->avatar)
                    <a href="#" id="userLink" class="user-link">
                        <img class="user-avatar" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="user">
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <div class="notification-bell">
                                <i class="fa fa-bell"></i>
                                <span class="notification-count">{{ auth()->user()->unreadNotifications->count() }}</span>
                            </div>
                        @endif
                    </a>
                @else
                    <a href="#" id="userLink" class="user-link">
                        <img class="user-avatar"
                            src="data:image/png;base64,{{ \App\Helpers\ImageHelper::generateInitialAvatar(Auth::user()->name) }}"
                            alt="user">
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <div class="notification-bell">
                                <i class="fa fa-bell"></i>
                                <span class="notification-count">{{ auth()->user()->unreadNotifications->count() }}</span>
                            </div>
                        @endif
                    </a>
                @endif
            @else
                <a href="{{ route('login.show') }}" id="userLink" class="user-link">
                    <img src={{ asset('img/user.png') }} alt="user">
                </a>
            @endauth
        </div>

    </header>


    <!-- Menú lateral izquierdo -->
    <div class="side-menu" id="sideMenu">
        <button class="close-btn" id="closeMenu">&times;</button>


        <hr class="separator">
        <ul>
            <a class="menu-title">Categorías</a>
            @foreach ($categories as $category)
                <li><a href="{{ route('products.byCategory', $category->slug) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
        <hr class="separator2">
        <ul>
            <a class="menu-title">Trending</a>
            <li><a href="{{ route('populars.populars') }}">Populars</a></li>
            <li><a href="{{ route('products.bestrated') }}">Best Rated</a></li>
        </ul>

    </div>




    <!-- Menú lateral derecho -->
    <div class="side-menu-right" id="sideMenuright" data-logged-in="{{ auth()->check() ? 'true' : 'false' }}">
        <button class="close-btn-right" id="closeMenuright">&times;</button>


        <hr class="separator">
        <ul>
            <a class="menu-title">Mi Cuenta</a>
            <li><a href="{{ route('profile.index') }}" id="userLink">Mis Datos</a></li>
            <li><a href="{{ route('comments.index') }}">Comentarios</a></li>
            <li><a href="{{ route('wishlist.groups') }}">Lista de Deseos</a></li>
            <li>
                <a href="{{ route('notifications.index') }}" style="position:relative;">
                    Notificaciones
                    @if (auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                        <span
                            style="
                        display:inline-block;
                        position:absolute;
                        top: 8px;
                        right: -14px;
                        width: 4px;
                        height: 4px;
                        background: #e11d48;
                        border-radius: 50%;
                        ">
                        </span>
                    @endif
                </a>
            </li>
            <li><a href="{{ route('my_products.index') }}">Mis productos</a></li>
        </ul>
        <hr class="separator2">
        <ul>
            <a class="menu-title">Compras</a>
            <li><a href="{{ route('pedidos.index') }}">Pedidos</a></li>
            <li><a href="{{ route('pedidoscancelados.index') }}">Pedidos Cancelados</a></li>
            <li><a href="{{ route('purchasehistory.index') }}">Historial de Compras</a></li>

        </ul>
        <hr class="separator3">
        <!-- Formulario de cierre de sesión -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button class="Cerrar-Session" type="submit">Cerrar Sesión</button>
        </form>

    </div>

    <!-- Modal de Login -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <p>Debes iniciar sesión para acceder a esta sección.</p>
            <button id="goToLogin">Ir a Iniciar Sesión</button>
            <button id="closeModal">Cerrar</button>
        </div>
    </div>


    <!-- Menú up -->
    <div class="side-menu-up" id="sideMenuup">

        <div class="search">
            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="query" id="searchInput" placeholder="Búsqueda" />
                <button type="submit" class="search-button" id="searchButton"><img src="{{ asset('img/lupa.png') }}"
                        alt="lupa"></button>

            </form>
            <button class="close-btn-up" id="closeMenuup">&times;</button>
        </div>
    </div>


    <!-- Overlay -->
    <div class="overlay" id="menuOverlay"></div>
    <div class="overlayup" id="menuOverlayup"></div>

    <script src="{{ asset('js/menu_lateral.js') }}"></script>
