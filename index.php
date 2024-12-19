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
                        <a class="nav-link" href="#">LE CLUB</a>
                        <a class="nav-link" href="#">SPÉCIALITÉS</a>
                        <a class="nav-link" href="#">AVIS CLIENTS</a>
                        <a class="nav-link" href="#">BLOG</a>
                    </nav>
                </div>

                <!-- Section droite : Devenir membre pour PC -->
                <div class="col-md-3 d-none d-md-flex justify-content-end align-items-center">
                    <a href="#" class="btn btn-rejoindre me-3">Devenir membre</a>
                    <a href="../adherents/login.php" aria-label="Espace Membre">
                        <img src="include/images/icone_membre.svg" alt="Espace Membre" style="max-width: 40px;">
                    </a>
                </div>
            </div>
        </div>
        <!-- Menu burger déroulant pour mobile -->
        <div id="burger-menu" class="burger-menu d-md-none">
            <!-- Croix pour fermer le menu -->
            <button id="close-menu" class="close-btn" aria-label="Fermer le menu">
                &times;
            </button>
            <nav class="nav flex-column text-center">
                <a class="nav-link" href="#">LE CLUB</a>
                <a class="nav-link" href="#">SPÉCIALITÉS</a>
                <a class="nav-link" href="#">AVIS CLIENTS</a>
                <a class="nav-link" href="#">BLOG</a>
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



    <div class="container my-5">
        <div class="row align-items-center">
            <!-- Image Section -->
            <div class="col-md-6">
                <div class="image-container">
                    <div class="yellow-corner-top"></div>
                    <img src="include/images/Fighter.jpg" alt="MMA Fighter" class="img-fluid">
                    <div class="yellow-corner-bottom"></div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="col-md-6">
                <p class="text-uppercase text-warning mb-2">Le Club</p>
                <h1 class="fw-bold">Bienvenue &agrave; la Team Vulcan, le club de MMA r&eacute;f&eacute;rence en
                    Auvergne</h1>
                <p class="mt-3">Team Vulcan est le club de MMA et grappling de r&eacute;f&eacute;rence en Auvergne.
                    Accessible &agrave; tous, nous offrons un entra&icirc;nement de qualit&eacute; dans une ambiance
                    conviviale et motivante.</p>

                <div class="row">
                    <div class="col-md-6">
                        <div class="section">
                            <div class="d-flex align-items-center mb-2">
                                <span class="yellow-diamond"></span>
                                <span class="section-title">Meilleurs entra&icirc;nements</span>
                            </div>
                            <p class="section-text">Entra&icirc;nements dirig&eacute;s par des coachs passionn&eacute;s,
                                adapt&eacute;s &agrave; tous les niveaux.</p>
                        </div>

                        <div class="section">
                            <div class="d-flex align-items-center mb-2">
                                <span class="yellow-diamond"></span>
                                <span class="section-title">Equipement de qualit&eacute;</span>
                            </div>
                            <p class="section-text">Des &eacute;quipements modernes et bien entretenus pour garantir
                                votre s&eacute;curit&eacute; et confort.</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="section">
                            <div class="d-flex align-items-center mb-2">
                                <span class="yellow-diamond"></span>
                                <span class="section-title">Tarif accessible</span>
                            </div>
                            <p class="section-text">Des formules accessibles pour offrir le meilleur rapport
                                qualit&eacute;-prix.</p>
                        </div>
                        <div class="section">
                            <div class="d-flex align-items-center mb-2">
                                <span class="yellow-diamond"></span>
                                <span class="section-title">Ambiance unique</span>
                            </div>
                            <p class="section-text">Rejoignez une communaut&eacute; o&ugrave; respect et entraide sont
                                au c&oelig;ur de notre philosophie.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts JS -->
    <script src="include/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <?php include 'include/footer.php'; ?>
</body>

</html>