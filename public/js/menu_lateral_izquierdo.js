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