document.addEventListener("DOMContentLoaded", function() {
    const openMenuButton = document.getElementById("openMenu");
    const closeMenuButton = document.getElementById("closeMenu");
    const dropdown = document.querySelector(".dropdown");

    openMenuButton.addEventListener("click", function() {
        dropdown.style.clipPath = "inset(0 0 0 0)";
        openMenuButton.style.display = "none"; // Oculta el botón de abrir
        closeMenuButton.style.display = "block"; // Muestra el botón de cerrar
    });

    closeMenuButton.addEventListener("click", function() {
        dropdown.style.clipPath = "inset(0 0 100% 100%)";
        openMenuButton.style.display = "block"; // Muestra el botón de abrir
        closeMenuButton.style.display = "none"; // Oculta el botón de cerrar
    });
});
