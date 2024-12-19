<?php
session_start(); // Pour gérer les sessions utilisateur

// Inclusion du fichier contenant la classe Admin et la configuration de la base de données
require_once '../config/config.php';
require_once '../class/Admin.php';

// Gestion du formulaire de connexion
$error_message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = trim($_POST['prenom']);
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Vérification si l'admin existe avec cet email, nom et prénom
    $sql = "SELECT * FROM admins WHERE prenom = ? AND nom = ? AND email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$prenom, $nom, $email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        // Vérification du mot de passe
        if (password_verify($password, $admin['password'])) {
            // Stockage des informations administrateur dans la session
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nom'] = $admin['nom'];
            $_SESSION['admin_prenom'] = $admin['prenom'];

            // Redirection vers la page d'administration
            header('Location: espace_admin.php');
            exit();
        } else {
            $error_message = "Mot de passe incorrect.";
        }
    } else {
        $error_message = "Aucun administrateur trouvé avec ces informations.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin - Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJxXHgU1nK4mBfFm9kgtVfVhXNdbD3TtWov2pzv56T2XT4D9vleK2U9vH8Xk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../include/css/connexion.css">
</head>
<body>
    <div class="container">
        <div class="header-title">
            Espace Admin
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Connecte toi pour accéder à ton espace administrateur!
                    </div>
                    <div class="card-body">
                        <!-- Formulaire de connexion -->
                        <form method="POST">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
                            </div>
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

                        <!-- Affichage des messages d'erreur -->
                        <?php if (!empty($error_message)) { ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                <?php echo htmlspecialchars($error_message); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0T4b36V7oStn4R+Vofc6u7H0e4k5/Jk5g68j9dqzVdovXfqu" crossorigin="anonymous"></script>
</body>
</html>
