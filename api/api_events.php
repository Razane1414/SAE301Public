<?php
// Connexion à la base de données
require_once('../config/config.php');
// class event
require_once('../class/Event.php');

// Récupérer les requête HTTP (GET, POST, PUT, DELETE)
$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'GET':
        // Si c'est une requête GET, récupérer tous les événements
        if (isset($_GET['id'])) {
            // Si un ID est passé en paramètre, on récupère un événement spécifique
            $event = Event::getEventById($pdo, $_GET['id']);
            echo json_encode($event); // Retourne l'événement en format JSON
        } else {
            // Sinon, on récupère tous les événements
            $events = Event::getAllEvents($pdo);
            echo json_encode($events); // Retourne tous les événements en format JSON
        }
        break;

    case 'POST':
        // Si c'est une requête POST, on ajoute un nouvel événement
        $data = json_decode(file_get_contents('php://input'), true); // Récupère les données envoyées en JSON
        if ($data) {
            // Si les données sont présentes, on crée et sauvegarde un événement
            $event = new Event($data['titre'], $data['description'], $data['date_event'], $data['lieu'], $data['type']);
            $event->save($pdo); // Appelle la méthode pour enregistrer l'événement
            echo json_encode(['message' => 'Événement ajouté avec succès']);
        } else {
            // Si les données sont manquantes, on renvoie une erreur
            echo json_encode(['message' => 'Erreur : données manquantes']);
        }
        break;

    case 'PUT':
        // Si c'est une requête PUT, on met à jour un événement existant
        $data = json_decode(file_get_contents('php://input'), true); // Récupère les données envoyées en JSON
        if (isset($data['id'])) {
            // Si l'ID de l'événement est présent, on met à jour les données
            $event = new Event($data['titre'], $data['description'], $data['date_event'], $data['lieu'], $data['type']);
            $event->update($pdo, $data['id']); // Appelle la méthode pour mettre à jour l'événement
            echo json_encode(['message' => 'Événement mis à jour avec succès']);
        } else {
            // Si l'ID est manquant, on renvoie une erreur
            echo json_encode(['message' => 'Erreur : ID de l\'événement manquant']);
        }
        break;

    case 'DELETE':
        // Si c'est une requête DELETE, on supprime un événement
        if (isset($_GET['id'])) {
            // Si l'ID est passé en paramètre, on supprime l'événement
            Event::delete($pdo, $_GET['id']); // Appelle la méthode pour supprimer l'événement
            echo json_encode(['message' => 'Événement supprimé avec succès']);
        } else {
            // Si l'ID est manquant, on renvoie une erreur
            echo json_encode(['message' => 'Erreur : ID de l\'événement manquant']);
        }
        break;

}
?>
