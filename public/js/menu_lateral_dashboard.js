document.addEventListener("DOMContentLoaded", () => {
    // Menú lateral derecho
    const sideMenuright = document.getElementById("sideMenuright");
    const userLink = document.getElementById("userLink");
    const closeMenurightButton = document.getElementById("closeMenuright");
    const overlay = document.getElementById("menuOverlay");

    // Obtener si el usuario está autenticado
    const isLoggedIn = sideMenuright.getAttribute("data-logged-in") === "true";

    // Mostrar menú lateral derecho o el popup si no está autenticado
    userLink.addEventListener("click", (event) => {
        event.preventDefault();

        if (!isLoggedIn) {
            // Si no está autenticado, mostrar el popup
            alert("Por favor, inicia sesión para acceder a esta sección.");
        } else {
            // Si está autenticado, abrir el menú derecho
            sideMenuright.style.right = "0";
            overlay.style.display = "block";
        }
    });

    // Cerrar menú lateral derecho
    closeMenurightButton.addEventListener("click", () => {
        sideMenuright.style.right = "-550px";
        overlay.style.display = "none";
    });

    overlay.addEventListener("click", () => {
        sideMenuright.style.right = "-550px";
        overlay.style.display = "none";
    });
});
