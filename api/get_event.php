<?php
require_once '../config/config.php';
header('Content-Type: application/json');

// Vérification de la méthode
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $date = isset($_GET['date']) ? $_GET['date'] : null;

    if ($date) {
        // Récupérer les événements pour une date donnée
        $stmt = $pdo->prepare("SELECT id, titre, description, date_event FROM events WHERE date_event = ?");
        $stmt->execute([$date]);
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'events' => $events]);
    } else {
        // Renvoyer tous les événements si aucune date spécifique n'est fournie
        $stmt = $pdo->query("SELECT id, titre, description, date_event FROM events");
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'events' => $events]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}
?>
