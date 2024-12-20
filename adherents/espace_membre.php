<?php

require_once '../config/config.php';

session_start();
if (!isset($_SESSION['adherent_id'])) {
    // Si l'utilisateur n'est pas connecté, redirection vers la page de connexion
    header('Location: login.php');
    exit;
}

// Requête pour récupérer les informations de l'admin, y compris la photo
$sqlAdmin = "SELECT nom, prenom, biographie, fonction, photo FROM admins WHERE id = :id";
$stmt = $pdo->prepare($sqlAdmin);
$stmt->execute(['id' => 1]);  // On récupère l'admin avec l'ID 1 comme exemple
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérification si l'admin existe
if ($admin === false) {
    echo "Admin non trouvé.";
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
                    <div class="evenInfo">
                        <div class="event-title">Aucun événement sélectionné</div>
                        
                        <div class="detailEvent"> 
                            <p class="event-location"></p>
                            <p class="description">Cliquez sur un événement du calendrier pour afficher ses détails ici.</p>
                        </div>
                    </div>

                    <!-- Affichage des informations de l'admin -->
                    <div class="admin-info">
                        <p><?php echo nl2br(htmlspecialchars($admin['biographie'])); ?></p>
                        <div class="bottomCard d-flex justify-content-between align-items-center">
                            <!-- Colonne gauche : image -->
                            <div class="left">
                                <?php if ($admin['photo']) : ?>
                                    <img src="<?php echo $admin['photo']; ?>" alt="Photo de l'admin" class="img-fluid" style="max-width: 200px;">
                                <?php else : ?>
                                    <p>Aucune photo disponible</p>
                                <?php endif; ?>
                            </div>

                            <!-- Colonne droite : informations -->
                            <div class="right">
                                <div class="nomCard"><?php echo $admin['nom']; echo ' ' . $admin['prenom']; ?></div>
                                <p><?php echo $admin['fonction']; ?></p>
                            </div>
                        </div>
                    </div>
                                
                    <!-- Bouton d'inscription -->
                    <button id="btn-inscription" class="btn-register" style="display:none;">S'inscrire</button>
                </div>
                <div class="image-section">
                    <div class="image-container">
                        <img src="../include/images/img_combat.png" alt="Image Combat">
                    </div>
                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../include/footer.php'; ?>
</body>

</html> 