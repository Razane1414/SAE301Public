<!-- API POUR SUPP LES EVENTS DIRECTEMENT DE LAB BDD -->

<?php
if (isset($_GET['id'])) {
    // Si l'ID est passé en paramètre, on supprime l'événement
    Event::delete($pdo, $_GET['id']); // Appelle la méthode pour supprimer l'événement
    echo json_encode(['message' => 'Événement supprimé avec succès']);
} else {
    // Si l'ID est manquant, on renvoie une erreur
    echo json_encode(['message' => 'Erreur : ID de l\'événement manquant']);
}
?>
