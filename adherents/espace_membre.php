<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../include/css/home.css">
    <title>Gestion des événements</title>
</head>

<body>
    <?php
    require_once '../config/config.php';
    include '../include/header.php';
    session_start();

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php"); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
        exit();
    }

    // Afficher un message de bienvenue avec le nom de l'utilisateur
    echo "<p>Bonjour " . htmlspecialchars($_SESSION['user_name']) . ", bienvenue !</p>";
    ?>
    <div class="container py-5">
        <div class="header">Événement</div>
        <div class="content-section">
            <div class="text-section">
                <div class="event-title">Événement sélectionné : Stage de découverte JJB</div>
                <p class="description">
                    L'événement sélectionné est un stage de découverte de Jiu-Jitsu Brésilien (JJB), une opportunité
                    idéale pour s'initier à cet art martial et en apprendre les bases dans un cadre encadré et convivial
                    réalisé le Lundi 06.
                </p>
                <div class="trainer-card">
                    <img src="../include/images/visage.jpg" alt="Photo de profil">
                    <div class="trainer-card-content">
                        <h4><strong>David TIVEYRAT</strong></h4>
                        <p><strong>Entraîneur JJB, Grappling</strong></p>
                        <ul>
                            <li><strong>Ceinture bleue grappling et grappling-fight</strong></li>
                            <li><strong>Ceinture noire de Judo</strong></li>
                            <li><strong>Ceinture noire de Ju-Jitsu</strong></li>
                            <li><strong>Ceinture bleue de Jiu-Jitsu Brésilien</strong></li>
                        </ul>
                    </div>
                </div>
                <div class="button-container">
                    <button class="btn-register">S'inscrire à l'événement</button>
                </div>
            </div>
            <div class="image-section">
                <div class="image-container">
                    <img src="../include/images/jjb.png" alt="JJB Stage">
                    <div class="corner corner-top-left"></div>
                    <div class="corner corner-bottom-right"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../include/footer.php'; ?>
</body>

</html>