<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Vulcan</title>
    <link rel="stylesheet" href="../include/css/header.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <!-- Bouton menu burger à gauche pour mobile -->
                <div class="col-auto d-md-none">
                    <button class="btn btn-burger" id="burger-menu-toggle" aria-label="Menu">
                        <img src="../include/images/menu.svg" alt="Menu" style="max-width: 30px;">
                    </button>
                </div>

                <!-- Logo centré -->
                <div class="col text-center">
                    <a href="index.php">
                        <img src="../include/images/Logo1.png" alt="Logo" class="img-fluid" style="max-width: 100px;">
                    </a>
                </div>

                <!-- Icône espace membre à droite -->
                <div class="col-auto d-md-none">
                    <a href="adherents/login.php" aria-label="Espace Membre">
                        <img src="../include/images/icone_membre.svg" alt="Espace Membre" style="max-width: 30px;">
                    </a>
                </div>

                <!-- Navigation centrale pour PC uniquement -->
                <div class="col-md-6 d-none d-md-block" id="nav-pc">
                    <nav class="nav justify-content-center">
                        <a class="nav-link" href="club.php">LE CLUB</a>
                        <a class="nav-link" href="specialites.php">SPÉCIALITÉS</a>
                        <a class="nav-link" href="avis_clients.php">AVIS CLIENTS</a>
                        <a class="nav-link" href="blog.php">BLOG</a>
                    </nav>
                </div>

                <!-- Section droite : Devenir membre pour PC -->
                <div class="col-md-3 d-none d-md-flex justify-content-end align-items-center">
                    <a href="#" class="btn btn-rejoindre me-3">Devenir membre</a>
                    <a href="../adherents/login.php" aria-label="Espace Membre">
                        <img src="../include/images/icone_membre.svg" alt="Espace Membre" style="max-width: 40px;">
                    </a>
                </div>
            </div>
        </div>

<!-- Menu burger déroulant pour mobile -->
<div id="burger-menu" class="burger-menu d-md-none">
    <!-- Croix pour fermer le menu -->
    <button id="close-menu" class="close-btn" aria-label="Fermer le menu">
        &times; <!-- Symbole croix -->
    </button>
    <nav class="nav flex-column text-center">
        <a class="nav-link" href="club.php">LE CLUB</a>
        <a class="nav-link" href="specialites.php">SPÉCIALITÉS</a>
        <a class="nav-link" href="avis_clients.php">AVIS CLIENTS</a>
        <a class="nav-link" href="blog.php">BLOG</a>
    </nav>
</div>
    </header>

    <!-- Lien vers le fichier JavaScript -->
    <script src="../include/js/script.js"></script>
</body>

</html>