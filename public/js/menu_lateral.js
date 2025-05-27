document.addEventListener('DOMContentLoaded', () => {
    // Menú lateral izquierdo
    const sideMenu = document.getElementById('sideMenu');
    const overlay = document.getElementById('menuOverlay');
    const overlayup = document.getElementById('menuOverlayup');
    const categoriesLink = document.getElementById('categoriesLink');
    const closeMenuButton = document.getElementById('closeMenu');

    categoriesLink.addEventListener('click', (event) => {
        event.preventDefault();
        sideMenu.style.left = '0';
        overlay.style.display = 'block';
    });

    closeMenuButton.addEventListener('click', () => {
        sideMenu.style.left = '-550px';
        overlay.style.display = 'none';
    });

    overlay.addEventListener('click', () => {
        sideMenu.style.left = '-550px';
        overlay.style.display = 'none';
    });

    // Menú lateral derecho
    const sideMenuright = document.getElementById('sideMenuright');
    const userLink = document.getElementById('userLink');
    const closeMenurightButton = document.getElementById('closeMenuright');

    // Obtener si el usuario está autenticado
    const isLoggedIn = sideMenuright.getAttribute('data-logged-in') === 'true';

    // Referencias al modal
    const loginModal = document.getElementById('loginModal');
    const goToLoginButton = document.getElementById('goToLogin');
    const closeModalButton = document.getElementById('closeModal');

    // 🔹 Asegurar que el modal esté oculto al iniciar la página
    loginModal.style.display = 'none';

    // Mostrar menú lateral derecho o el popup si no está autenticado
    userLink.addEventListener('click', (event) => {
        event.preventDefault();
        
        if (!isLoggedIn) {
            // Si no está autenticado, mostrar el popup
            loginModal.style.display = 'flex';
        } else {
            // Si está autenticado, abrir el menú derecho
            sideMenuright.style.right = '0';
            overlay.style.display = 'block';
        }
    });

    // Cerrar menú lateral derecho
    closeMenurightButton.addEventListener('click', () => {
        sideMenuright.style.right = '-550px';
        overlay.style.display = 'none';
    });

    overlay.addEventListener('click', () => {
        sideMenuright.style.right = '-550px';
        overlay.style.display = 'none';
    });

    // Menú up
    const sideMenuup = document.getElementById('sideMenuup');
    const searchLink = document.getElementById('searchLink');
    const closeMenuupButton = document.getElementById('closeMenuup');

    searchLink.addEventListener('click', (event) => {
        event.preventDefault();
        sideMenuup.classList.add('open');
        overlayup.style.display = 'block';
    });

    closeMenuupButton.addEventListener('click', () => {
        sideMenuup.classList.remove('open');
        overlayup.style.display = 'none';
    });

    overlayup.addEventListener('click', () => {
        sideMenuup.classList.remove('open');
        overlayup.style.display = 'none';
    });

    // Eventos del modal
    goToLoginButton.addEventListener('click', () => {
        window.location.href = '/login'; // Redirige a la página de login
    });

    closeModalButton.addEventListener('click', () => {
        loginModal.style.display = 'none'; // Cierra el modal
    });

    // Cierra el modal si se hace clic fuera de la caja de contenido
    loginModal.addEventListener('click', (event) => {
        if (event.target === loginModal) {
            loginModal.style.display = 'none';
        }
    });
});