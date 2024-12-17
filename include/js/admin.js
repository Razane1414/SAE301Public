document.addEventListener('DOMContentLoaded', function() {
    // Écouteur d'événement sur le bouton plus
    const btnPlus = document.getElementById("btn-plus");
    const form = document.getElementById("add-event-form");

    if (btnPlus && form) {
        btnPlus.addEventListener("click", function() {
            // Alterner l'affichage du formulaire
            if (form.style.display === "none") {
                form.style.display = "block";  // Afficher le formulaire
            } else {
                form.style.display = "none";  // Cacher le formulaire
            }
        });
    } else {
        console.error("L'élément bouton ou le formulaire n'a pas été trouvé.");
    }
});
