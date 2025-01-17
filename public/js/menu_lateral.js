document.addEventListener('DOMContentLoaded', () => {
    // Menú lateral izquierdo
    const sideMenu = document.getElementById('sideMenu'); // Menú lateral
    const overlay = document.getElementById('menuOverlay'); // Fondo oscuro
    const overlayup = document.getElementById('menuOverlayup'); // Fondo oscuro up
    const categoriesLink = document.getElementById('categoriesLink'); // Enlace "Categorías"
    const closeMenuButton = document.getElementById('closeMenu'); // Botón de cerrar

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

    // Menú lateral derecho
    const sideMenuright = document.getElementById('sideMenuright'); // Menú lateral
    const userLink = document.getElementById('userLink'); // Enlace "User"
    const closeMenurightButton = document.getElementById('closeMenuright'); // Botón de cerrar

    userLink.addEventListener('click', (event) => {
        event.preventDefault();
        sideMenuright.style.right = '0'; // Muestra el menú
        overlay.style.display = 'block'; // Muestra el overlay
    });

    closeMenurightButton.addEventListener('click', () => {
        sideMenuright.style.right = '-550px'; // Oculta el menú
        overlay.style.display = 'none'; // Oculta el overlay
    });

    overlay.addEventListener('click', () => {
        sideMenuright.style.right = '-550px'; // Oculta el menú
        overlay.style.display = 'none'; // Oculta el overlay
    });




    // Menú up
    const sideMenuup = document.getElementById('sideMenuup'); // Menú lateral
    const searchLink = document.getElementById('searchLink'); // Enlace "search"
    const closeMenuupButton = document.getElementById('closeMenuup'); // Botón de cerrar

    searchLink.addEventListener('click', (event) => {
        event.preventDefault();
        sideMenuup.classList.add('open'); // Muestra el menú
        overlayup.style.display = 'block'; // Muestra el overlay
    });

    closeMenuupButton.addEventListener('click', () => {
        sideMenuup.classList.remove('open'); // Oculta el menú
        overlayup.style.display = 'none'; // Oculta el overlay
    });
    
    overlayup.addEventListener('click', () => {
        sideMenuup.classList.remove('open'); // Oculta el menú
        overlayup.style.display = 'none'; // Oculta el overlay
    });









});