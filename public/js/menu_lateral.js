document.addEventListener('DOMContentLoaded', () => {
    // Menú lateral izquierdo
    const sideMenu = document.getElementById('sideMenu');
    const overlay = document.getElementById('menuOverlay');
    const overlayup = document.getElementById('menuOverlayup');
    const categoriesLink = document.getElementById('categoriesLink');
    const closeMenuButton = document.getElementById('closeMenu');

    categoriesLink.addEventListener('click', (event) => {
        event.preventDefault();
        sideMenu.style.left = '0'; // Muestra el menú
        overlay.style.display = 'block'; // Muestra el overlay
    });

    closeMenuButton.addEventListener('click', () => {
        sideMenu.style.left = '-550px'; // Oculta el menú
        overlay.style.display = 'none'; // Oculta el overlay
    });

    overlay.addEventListener('click', () => {
        sideMenu.style.left = '-550px'; // Oculta el menú
        overlay.style.display = 'none'; // Oculta el overlay
    });


    // Menú lateral derecho general
    const sideMenuright = document.getElementById('sideMenuright');
    const closeMenurightButton = document.getElementById('closeMenuright');

    // Menú lateral derecho usuario (solo móvil)
    const sideMenurightUser = document.getElementById('sideMenurightUser');
    const closeMenurightUserButton = document.getElementById('closeMenurightUser');

    // Avatar
    const userLink = document.getElementById('userLink');

    // Modal de login
    const loginModal = document.getElementById('loginModal');
    const goToLoginButton = document.getElementById('goToLogin');
    const closeModalButton = document.getElementById('closeModal');

    // Asegura que el modal esté oculto al iniciar
    if (loginModal) loginModal.style.display = 'none';

    // Abrir menú derecho o modal según autenticación y dispositivo
    if (userLink) {
        userLink.addEventListener('click', (event) => {
            event.preventDefault();
            // Si existe el menú de usuario y estamos en móvil
            if (sideMenurightUser && window.innerWidth <= 810) {
                sideMenurightUser.style.right = '0';
                overlay.style.display = 'block';
            }
            // Si existe el menú general
            else if (sideMenuright) {
                const isLoggedIn = sideMenuright.getAttribute('data-logged-in') === 'true';
                if (!isLoggedIn && loginModal) {
                    loginModal.style.display = 'flex';
                } else {
                    sideMenuright.style.right = '0';
                    overlay.style.display = 'block';
                }
            }
        });
    }

    // Cerrar menú lateral derecho usuario (solo móvil)
    if (sideMenurightUser && closeMenurightUserButton && overlay) {
        closeMenurightUserButton.addEventListener('click', () => {
            sideMenurightUser.style.right = '-550px';
            overlay.style.display = 'none';
        });
    }

    // Cerrar menú lateral derecho general
    if (sideMenuright && closeMenurightButton && overlay) {
        closeMenurightButton.addEventListener('click', () => {
            sideMenuright.style.right = '-550px';
            overlay.style.display = 'none';
        });
    }

    // Overlay cierra ambos menús y el modal
    if (overlay) {
        overlay.addEventListener('click', () => {
            if (sideMenu && sideMenu.style.left === '0px') sideMenu.style.left = '-550px';
            if (sideMenuright && sideMenuright.style.right === '0px') sideMenuright.style.right = '-550px';
            if (sideMenurightUser && sideMenurightUser.style.right === '0px') sideMenurightUser.style.right = '-550px';
            overlay.style.display = 'none';
            if (loginModal) loginModal.style.display = 'none';
        });
    }

    // Menú up
    const sideMenuup = document.getElementById('sideMenuup');
    const searchLink = document.getElementById('searchLink');
    const closeMenuupButton = document.getElementById('closeMenuup');

    if (searchLink && sideMenuup && overlayup) {
        searchLink.addEventListener('click', (event) => {
            event.preventDefault();
            sideMenuup.classList.add('open');
            overlayup.style.display = 'block';
        });
    }

    if (closeMenuupButton && sideMenuup && overlayup) {
        closeMenuupButton.addEventListener('click', () => {
            sideMenuup.classList.remove('open');
            overlayup.style.display = 'none';
        });
    }

    if (overlayup && sideMenuup) {
        overlayup.addEventListener('click', () => {
            sideMenuup.classList.remove('open');
            overlayup.style.display = 'none';
        });
    }

    // Eventos del modal login
    if (goToLoginButton) {
        goToLoginButton.addEventListener('click', () => {
            window.location.href = '/login';
        });
    }

    if (closeModalButton) {
        closeModalButton.addEventListener('click', () => {
            if (loginModal) loginModal.style.display = 'none';
        });
    }

    if (loginModal) {
        loginModal.addEventListener('click', (event) => {
            if (event.target === loginModal) {
                loginModal.style.display = 'none';
            }
        });
    }
});