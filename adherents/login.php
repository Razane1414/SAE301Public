<?php
session_start(); // Pour gérer les sessions utilisateur

// Inclusion du fichier contenant la classe Adherent et la configuration de la base de données
require_once '../config/config.php';
require_once '../class/Adherent.php';

// Gestion du formulaire de connexion
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Vérification si l'email existe
    $adherent = Adherent::emailExists($pdo, $email);
    if ($adherent) {
        // Vérification du mot de passe
        if (password_verify($password, $adherent['password'])) {
            // Stockage des informations utilisateur dans la session
            $_SESSION['adherent_id'] = $adherent['id'];
            $_SESSION['adherent_nom'] = $adherent['nom'];
            $_SESSION['adherent_prenom'] = $adherent['prenom'];

            // Redirection vers la page d'accueil ou tableau de bord
            header('Location: espace_membre.php');
            exit;
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Adresse e-mail non trouvée.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login membre</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJxXHgU1nK4mBfFm9kgtVfVhXNdbD3TtWov2pzv56T2XT4D9vleK2U9vH8Xk" crossorigin="anonymous">
    <!-- Google Fonts pour Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;800&display=swap" rel="stylesheet">
    <!-- Lien vers le fichier CSS personnalisé -->
    <link rel="stylesheet" href="../include/css/connexion.css">
    <link rel="stylesheet" href="../include/css/home.css">
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
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Mot de passe"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </form>

                        <!-- Gestion des erreurs -->
                        <?php if (!empty($error)) { ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lien vers le JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw8f+ua7Kw1TIq0T4b36V7oStn4R+Vofc6u7H0e4k5/Jk5g68j9dqzVdovXfqu"
        crossorigin="anonymous"></script>
</body>

</html>
