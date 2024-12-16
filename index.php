<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Vulcan</title>
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
            /* Ajustez 50px à la hauteur de votre footer si nécessaire */
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .overlay-text {
            text-align: left;
            /* Alignement à gauche */
            position: absolute;
            top: 50%;
            left: 10%;
            /* Ajustez selon vos besoins */
            transform: translateY(-50%);
            color: #fff;
            /* Assurez une lisibilité si un fond est appliqué */
        }

        .overlay-text h1 {
            font-size: 2.5rem;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .overlay-text h4 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .overlay-text p {
            font-size: 1rem;
            margin-bottom: 1rem;
            max-width: 600px;
            /* Limiter la largeur pour une bonne lisibilité */
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
            <div class="row align-items-center">
                <div class="col-3">
                    <img src="include/images/Logo1.png" alt="Logo" class="img-fluid" style="max-width: 100px;">
                </div>
                <div class="col-6 text-center">
                    <nav class="nav justify-content-center">
                        <a class="nav-link mx-2 active" href="#">LE CLUB</a>
                        <a class="nav-link mx-2" href="#">SPÉCIALITÉS</a>
                        <a class="nav-link mx-2" href="#">AVIS CLIENTS</a>
                        <a class="nav-link mx-2" href="#">BLOG</a>
                    </nav>
                </div>
                <div class="col-3 d-flex justify-content-end align-items-center flex-wrap">
                    <a href="#" class="btn-rejoindre btn me-2 mb-2 mb-sm-0">Nous rejoindre</a>
                    <a href="adherents/login.php" class="text-dark">
                        <img src="include/images/icone_membre.svg" alt="Espace Membre" class="img-fluid"
                            style="max-width: 40px;">
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="home">
        <div class="overlay-text">
            <h4 class="sous-titre">WELCOM TO THE FIGHT</h4>
            <h1>TEAM <span class="highlight">VULCAN</span>, <br>PASSION DES SPORTS DE COMBAT</h1>
            <p>Rejoignez nous dans l'univers des sports de combat avec une équipe professionnelle dédiée à votre
                progression et à votre épanouissement. Que vous soyez débutant ou confirmé, la team Vulcan vous attend.
            </p>
            <a href="#" class="btn-rejoindre btn">BOXER !</a>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="image-container">
                    <div class="yellow-corner-top"></div>
                    <img src="include/images/Fighter.jpg" alt="MMA Fighter">
                    <div class="yellow-corner-bottom"></div>
                </div>
            </div>
            <div class="col-md-6 content">
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

    <?php include 'include/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>