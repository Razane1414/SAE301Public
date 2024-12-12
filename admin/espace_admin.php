<?php
require_once '../config/config.php';

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login_admin.php"); 
    exit();
}

// Afficher un message de bienvenue avec le nom de l'admin
echo "Bonjour " . $_SESSION['user_name'] . ", bienvenue sur la page admin!";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin</title>
    <link rel="stylesheet" href="../include/css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    
</body>
</html>
<?php include '../include/footer.php'; ?>