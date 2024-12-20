// MENU BURGEEER
document.addEventListener("DOMContentLoaded", function () {
    // Sélectionne les éléments
    const burgerMenu = document.getElementById("burger-menu");
    const burgerLinks = document.querySelectorAll("#burger-menu .nav-link");
    const closeButton = document.getElementById("close-menu");
    const burgerToggle = document.getElementById("burger-menu-toggle");

    // Fonction pour fermer le menu
    function closeMenu() {
        burgerMenu.classList.remove("active");
    }

    // Ferme le menu quand on clique sur un lien
    burgerLinks.forEach(link => {
        link.addEventListener("click", closeMenu);
    });

    // Ferme le menu avec la croix
    closeButton.addEventListener("click", closeMenu);

    // Ouvre le menu avec le bouton burger
    burgerToggle.addEventListener("click", () => {
        burgerMenu.classList.toggle("active");
    });
});