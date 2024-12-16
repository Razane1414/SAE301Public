<!-- API POUR CREER LES EVENTS ET LES AJOUTER EN BDD -->

<?php
// Récupérer les données envoyées en JSON
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // Si les données sont présentes, on crée et sauvegarde un événement
    $event = new Event($data['titre'], $data['description'], $data['date_event'], $data['lieu'], $data['type']);
    $event->save($pdo); // Appelle la méthode pour enregistrer l'événement
    echo json_encode(['message' => 'Événement ajouté avec succès']);
} else {
    // Si les données sont manquantes, on renvoie une erreur
    echo json_encode(['message' => 'Erreur : données manquantes']);
}
?>
