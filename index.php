<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Vulcan</title>
    <link rel="stylesheet" href="include/css/header.css">
    <link rel="stylesheet" href="include/css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Réinitialisation des marges et paddings */
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        /* Contenu principal ajusté pour occuper toute la hauteur */
        .home {
            min-height: calc(100vh - 50px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .overlay-text {
            text-align: left;
            position: absolute;
            top: 50%;
            left: 10%;
            transform: translateY(-50%);
            color: #fff;
        }

        footer {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <!-- Bouton menu burger à gauche pour mobile -->
                <div class="col-auto d-md-none">
                    <button class="btn btn-burger" id="burger-menu-toggle" aria-label="Menu">
                        <img src="include/images/menu.svg" alt="Menu" style="max-width: 30px;">
                    </button>
                </div>

                <!-- Logo centré -->
                <div class="col text-center">
                    <a href="index.php">
                        <img src="include/images/Logo1.png" alt="Logo" class="img-fluid" style="max-width: 100px;">
                    </a>
                </div>

                <!-- Icône espace membre à droite -->
                <div class="col-auto d-md-none">
                    <a href="adherents/login.php" aria-label="Espace Membre">
                        <img src="include/images/icone_membre.svg" alt="Espace Membre" style="max-width: 30px;">
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
                    <a href="adherents/register.php" class="btn btn-rejoindre me-3">Devenir membre</a>
                    <a href="adherents/login.php" aria-label="Espace Membre">
                        <img src="include/images/icone_membre.svg" alt="Espace Membre" style="max-width: 40px;">
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

    <!-- Section Hero -->
    <div class="home">
        <div class="overlay-text">
            <h4 class="sous-titre">WELCOM TO THE FIGHT</h4>
            <h1>TEAM <span class="highlight">VULCAN</span>, <br>PASSION DES SPORTS DE COMBAT</h1>
            <p>Rejoignez-nous dans l'univers des sports de combat avec une équipe professionnelle dédiée à votre
                progression et à votre épanouissement. Que vous soyez débutant ou confirmé, la team Vulcan vous attend.
            </p>
            <a href="#" class="btn-rejoindre btn">BOXER !</a>
        </div>
    </div>

    <!-- Scripts JS -->
    <script src="include/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <?php include 'include/footer.php'; ?>
</body>

</html>