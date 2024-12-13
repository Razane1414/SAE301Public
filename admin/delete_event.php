<?php
// Inclure la configuration pour la connexion à la base de données
require_once '../config/config.php';
require_once '../class/Event.php';

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer l'ID de l'événement à supprimer
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Supprimer l'événement
    Event::delete($pdo, $id);
    
    // Rediriger vers la page admin après suppression
    header("Location: espace_admin.php");
    exit();
}
?>