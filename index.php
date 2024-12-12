<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Vulcan</title>
    <link rel="stylesheet" href="css\home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>


<body>
  <header>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-3">
                <img src="images/Logi1.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
            </div>

            <!-- Navigation au centre -->
            <div class="col-6 text-center">
                <nav class="nav justify-content-center">
                    <a class="nav-link mx-2 active" href="#">LE CLUB</a>
                    <a class="nav-link mx-2" href="#">SPÉCIALITÉS</a>
                    <a class="nav-link mx-2" href="#">AVIS CLIENTS</a>
                    <a class="nav-link mx-2" href="#">BLOG</a>
                </nav>
            </div>

            <div class="col-3 d-flex justify-content-end align-items-center flex-wrap">
                <!-- Le bouton et l'icône sont dans un conteneur flex -->
                <a href="#" class="btn-rejoindre btn me-2 mb-2 mb-sm-0">Nous rejoindre</a>
                <a href="#" class="text-dark">
                    <img src="images/icone_membre.svg" alt="Espace Membre" class="img-fluid" style="max-width: 40px;">
                </a>
            </div>
        </div>
    </div>
  </header>

  <div class="home">
      <div class="overlay-text">
          <h4>WELCOM TO THE FIGHT</h4>
          <h1>TEAM VULCAN, PASSION DES SPORTS DE COMBAT</h1>
          <p>Rejoignez nous dans l'univers des sports de combat avec une équipe professionnelle dédiée à votre progression et à votre épanouissement. Que vous soyez débutant ou confirmé, la team Vulcan vous attend.</p>
          <a href="#" class="btn-rejoindre btn">BOXER !</a>
      </div>
  </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
