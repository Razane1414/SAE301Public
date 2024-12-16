document.addEventListener('DOMContentLoaded', function () {
    let burgerToggle = document.getElementById('burger-menu-toggle'); // Bouton menu burger
    let burgerMenu = document.getElementById('burger-menu'); // Menu déroulant
    let closeMenu = document.getElementById('close-menu'); // Croix pour fermer

    // Ouvrir le menu burger
    if (burgerToggle && burgerMenu) {
        burgerToggle.addEventListener('click', function () {
            burgerMenu.classList.add('active');
        });
    }

    // Fermer le menu avec la croix
    if (closeMenu && burgerMenu) {
        closeMenu.addEventListener('click', function () {
            burgerMenu.classList.remove('active');
        });
    }
});