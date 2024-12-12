<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Afficher un message de bienvenue avec le nom de l'utilisateur
echo "Bonjour " . $_SESSION['user_name'] . ", bienvenue !";
?>