<!-- FICHIER PRINCIPAL POUR GERER LES REQUETES HTTP -->
 
<?php
// Connexion à la base de données
require_once('../config/config.php');
// class event
require_once('../class/Event.php');

// Récupérer la méthode HTTP
$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'POST':
        require_once('post_event.php'); // Inclure le fichier de gestion POST
        break;

    case 'PUT':
        require_once('put_event.php'); // Inclure le fichier de gestion PUT
        break;

    case 'DELETE':
        require_once('delete_event.php'); // Inclure le fichier de gestion DELETE
        break;

    default:
        echo json_encode(['message' => 'Méthode HTTP non supportée']);
        break;
}
?>
