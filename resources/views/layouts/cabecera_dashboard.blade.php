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
        <a href="#" id="adminNotificationBell" style="position:relative;">
            <img src="{{ asset('/img/admin/campana.png') }}" alt="notificaciones">
            @if(isset($adminNotifications) && $adminNotifications->where('read_at', null)->count() > 0)
                <span class="notification-count">{{ $adminNotifications->where('read_at', null)->count() }}</span>
            @endif
        </a>

        <!-- Popup de notificaciones admin -->
        <div id="adminNotificationPopup" class="admin-notification-popup" style="display:none;">
            <div class="popup-header">
                <span>Notificaciones</span>
                <button id="closeAdminNotificationPopup" style="background:none;border:none;font-size:1.5em;float:right;">&times;</button>
            </div>
            <div class="popup-body">
                @if(isset($adminNotifications))
                    @forelse($adminNotifications as $notification)
                        <div class="admin-notification-item{{ $notification->read_at ? ' read' : '' }}">
                            <div>
                                <strong>
                                    @if($notification->type === 'comment_report')
                                        Denuncia de comentario
                                    @elseif($notification->type === 'return')
                                        Nueva devolución
                                    @else
                                        Notificación
                                    @endif
                                </strong>
                                <span style="font-size:0.9em;color:#888;">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                            <div>{{ $notification->message ?? '' }}</div>
                            <div class="acciones">
                                <a href="{{ route('admin.notifications.read', $notification->id) }}">Marcar como leída</a>
                                <a href="{{ route('admin.notifications.delete', $notification->id) }}">Eliminar</a>
                            </div>
                        </div>
                    @empty
                        <div style="color:#888;">No hay notificaciones.</div>
                    @endforelse
                @else
                    <div style="color:#888;">No hay notificaciones.</div>
                @endif
            </div>
        </div>

        @auth
            @php
                $user = Auth::user();
                $avatar = $user->avatar 
                    ? asset('storage/' . $user->avatar)
                    : ( $user->profile_photo 
                        ? $user->profile_photo 
                        : asset('img/user.png') );
            @endphp
            <a href="#" id="userLink">
                <img class="user-avatar" src="{{ $avatar }}" alt="user">
            </a>
        @else
            <a href="{{ route('login.show') }}" id="userLink"><img src="{{ asset('img/user.png') }}" alt="user"></a>
        @endauth
    </div>
</header>


<!-- Menú lateral izquierdo -->
<div class="side-menu" id="sideMenu">
    <ul>
        <li><a href="{{ route('admin.dashboard') }}" ><img src="{{ asset('/img/admin/rayas.png') }}" alt="rayas"></a></li>
        <li><a href="{{ route('admin.dashboard') }}" ><img src="{{ asset('/img/admin/casa.png') }}" alt="casa"></a></li>
    </ul>
    <hr class="separator">
    <ul>
        <li><a href="{{ route('admin.users.index') }}" ><img src="{{ asset('/img/admin/user.png') }}" alt="shopping"></a></li>
        <li><a href="{{ route('admin.orders.index') }}" ><img src="{{ asset('/img/admin/shopping.png') }}" alt="shopping"></a></li>
        <li><a href="{{ route('admin.products.index') }}" ><img src="{{ asset('/img/admin/tienda.png') }}" alt="tienda"></a></li>
        <li><a href="{{ route('admin.categories.index') }}" ><img src="{{ asset('/img/admin/category.png') }}" alt="category"></a></li>
        <li><a href="{{ route('admin.comments.index') }}" ><img src="{{ asset('/img/admin/mensaje.png') }}" alt="mensaje"></a></li>
        <li><a href="{{ route('admin.returns.index') }}" ><img src="{{ asset('/img/admin/devolver.png') }}" alt="devolver"></a></li>
    </ul>
    <hr class="separator">
    <ul>
        <li><a href="{{ route('admin.notifications.index') }}" ><img src="{{ asset('/img/admin/comentario.png') }}" alt="comentario"></a></li>
        <li><a href="{{ route('admin.soporte.index') }}" ><img src="{{ asset('/img/admin/support.png') }}" alt="support"></a></li>
        <li><a href="{{ route('admin.log_admin.index') }}" ><img src="{{ asset('/img/admin/monitoreo.png') }}" alt="monitoreo"></a></li>
    </ul>
</div>

<!-- Menú lateral derecho -->
<div class="side-menu-right" id="sideMenuright" data-logged-in="{{ auth()->check() ? 'true' : 'false' }}">
    <button class="close-btn-right" id="closeMenuright">&times;</button>
    <ul>
        <a class="menu-title">Usuario</a>
        <li><a href="{{ route('admin.profile.index') }}" id="userLink">Mis Datos</a></li>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const bell = document.getElementById('adminNotificationBell');
    const popup = document.getElementById('adminNotificationPopup');
    const closeBtn = document.getElementById('closeAdminNotificationPopup');

    bell.addEventListener('click', function(e) {
        e.preventDefault();
        popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
    });

    closeBtn.addEventListener('click', function() {
        popup.style.display = 'none';
        // Marcar todas como leídas al cerrar
        fetch('{{ route('admin.notifications.markAllRead') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
    });

    document.addEventListener('click', function(e) {
        if (!popup.contains(e.target) && !bell.contains(e.target)) {
            if (popup.style.display === 'block') {
                popup.style.display = 'none';
                // Marcar todas como leídas al cerrar
                fetch('{{ route('admin.notifications.markAllRead') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });
            }
        }
    });
});
</script>
<script src="{{ asset('js/menu_lateral_dashboard.js') }}"></script>