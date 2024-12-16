<!-- API POUR METTRE AJOUR LES EVENTS -->

<?php
// Récupérer les données envoyées en JSON
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    // Si l'ID de l'événement est présent, on met à jour les données
    $event = new Event($data['titre'], $data['description'], $data['date_event'], $data['lieu'], $data['type']);
    $event->update($pdo, $data['id']); // Appelle la méthode pour mettre à jour l'événement
    echo json_encode(['message' => 'Événement mis à jour avec succès']);
} else {
    // Si l'ID est manquant, on renvoie une erreur
    echo json_encode(['message' => 'Erreur : ID de l\'événement manquant']);
}
?>
