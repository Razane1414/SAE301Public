<?php

require_once '../config/config.php';

session_start();
if (!isset($_SESSION['adherent_id'])) {
    // Si l'utilisateur n'est pas connecté, redirection vers la page de connexion
    header('Location: connexion.php');
    exit;
}

// Utilisation des données du membre connecté
$adherent_id = $_SESSION['adherent_id'];
$adherent_nom = $_SESSION['adherent_nom'];
$adherent_prenom = $_SESSION['adherent_prenom'];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <link rel="stylesheet" href="../include/css/home.css">
    <link rel="stylesheet" href="../include/css/membre.css">
    <link rel="stylesheet" href="../include/css/calendrier.css">
    <script src="../include/js/calendriermembre.js"></script>

    <title>Espace membre</title>
</head>

<body>
    <?php
    include '../include/header.php';
    ?>

    <div class="container my-5">
        <div id="calendar"></div>

        <div class="py-5">
            <div class="header">Événement</div>
            <div class="content-section">
                <div class="text-section">
                    <div class="event-title">Aucun événement sélectionné</div>
                    <p class="event-date"></p>
                    <p class="event-location"></p>
                    <p class="event-type"></p>
                    <p class="description">Cliquez sur un événement du calendrier pour afficher ses détails ici.</p>
                    
                    <!-- Bouton d'inscription -->
                    <button id="btn-inscription" class="btn btn-primary" style="display:none;">S'inscrire</button>
                </div>
                <div class="image-section">
                    <div class="image-container">
                        <img src="../include/images/jjb.png" alt="JJB Stage">
                    </div>
                </div>
            </div>
        </div>

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../include/footer.php'; ?>
</body>

</html>
