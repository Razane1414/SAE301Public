<!-- API POUR RECUPERER LES EVENTS -->
<?php
if (isset($_GET['id'])) {
    // Si un ID est passé en paramètre, on récupère un événement spécifique
    $event = Event::getEventById($pdo, $_GET['id']);
    echo json_encode($event); // Retourne l'événement en format JSON
} else {
    // Sinon, on récupère tous les événements
    $events = Event::getAllEvents($pdo);
    echo json_encode($events); // Retourne tous les événements en format JSON
}
?>
