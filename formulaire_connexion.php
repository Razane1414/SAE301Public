<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Membres</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJxXHgU1nK4mBfFm9kgtVfVhXNdbD3TtWov2pzv56T2XT4D9vleK2U9vH8Xk" crossorigin="anonymous">
    <!-- Google Fonts pour Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;800&display=swap" rel="stylesheet">
      <!-- Lien vers le fichier CSS personnalisé -->
      <link rel="stylesheet" href="css/connexion.css">
      <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <div class="container">
        <!-- Titre Espace Membres -->
        <div class="header-title">
            Espace Membres
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Connecte toi pour accéder à ton espace personnel !
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="nom" placeholder="Nom" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" id="email" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="motdepasse" placeholder="Mot de passe" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lien vers le JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0T4b36V7oStn4R+Vofc6u7H0e4k5/Jk5g68j9dqzVdovXfqu" crossorigin="anonymous"></script>
</body>
</html>