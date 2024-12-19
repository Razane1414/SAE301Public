<?php
require_once '../config/config.php';
header('Content-Type: application/json');

// Vérification de la méthode
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Si un ID est passé, on récupère les détails de l'événement
        $eventId = $_GET['id'];
        $stmt = $pdo->prepare("SELECT id, titre, description, date_event, lieu, type FROM events WHERE id = ?");
        $stmt->execute([$eventId]);
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($event) {
            echo json_encode(['success' => true, 'events' => [$event]]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Événement non trouvé']);
        }
    } else {
        // Si aucun ID n'est passé, récupérer tous les événements
        $stmt = $pdo->query("SELECT id, titre, description, date_event FROM events");
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'events' => $events]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}
?>
