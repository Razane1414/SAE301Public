<?php
// Inclure le fichier de configuration pour la connexion à la base de données
require_once '../config/config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];  // Récupérer le nom
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Rechercher l'utilisateur dans la base de données avec le nom et l'email
    $sql = "SELECT * FROM adherents WHERE nom = ? AND email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe avec cet email et nom
    if ($row) {
        // Vérifier si le mot de passe correspond
        if ($password === $row['password']) {
            // Démarrer une session et rediriger vers l'espace membre
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['nom'];  // Stocker le nom pour l'afficher dans l'espace membre

            // Rediriger vers la page de l'adhérent (espace membre)
            header("Location: espace_membre.php");
            exit();  // Assure que le script s'arrête ici après la redirection
        } else {
            $error_message = "Mot de passe incorrect.";
        }
    } else {
        $error_message = "Aucun utilisateur trouvé.";
    }
}
?>

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
    <link rel="stylesheet" href="../css/connexion.css">
    <link rel="stylesheet" href="../css/home.css">
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
                        <!-- Formulaire de connexion -->
                        <form method="POST">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </form>

                        <?php if (isset($error_message)) { ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lien vers le JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0T4b36V7oStn4R+Vofc6u7H0e4k5/Jk5g68j9dqzVdovXfqu" crossorigin="anonymous"></script>
</body>
</html>
