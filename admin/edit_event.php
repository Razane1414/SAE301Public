<?php
// Inclure la configuration et la classe Event
require_once '../config/config.php';
require_once '../class/Event.php'; 

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login_admin.php");
    exit();
}

// Récupérer l'ID de l'événement depuis l'URL et récupérer l'événement
if (isset($_GET['id'])) {
    $eventId = $_GET['id'];
    $event = Event::getEventById($pdo, $eventId);
    if (!$event) {
        echo "Événement non trouvé.";
        exit();
    }
}

// Modifier l'événement
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_event = $_POST['date_event'];
    $lieu = $_POST['lieu'];
    $type = $_POST['type'];

    // Vérifier si les données sont valides
    if (!empty($id) && !empty($titre) && !empty($description) && !empty($date_event)) {
        $event = new Event($titre, $description, $date_event, $lieu, $type);
        $event->update($pdo, $id); // Mise à jour de l'événement
        header("Location: espace_admin.php"); // Rediriger vers la page admin après la mise à jour
        exit();
    } else {
        echo "<script>alert('Tous les champs doivent être remplis');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'événement</title>
</head>
<body>
    <h1>Modifier l'événement</h1>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $event['id'] ?>"> <!-- Champ caché pour l'ID -->
        <div>
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" value="<?= $event['titre'] ?>" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" required><?= $event['description'] ?></textarea>
        </div>
        <div>
            <label for="date_event">Date</label>
            <input type="date" id="date_event" name="date_event" value="<?= $event['date_event'] ?>" required>
        </div>
        <div>
            <label for="lieu">Lieu</label>
            <input type="text" id="lieu" name="lieu" value="<?= $event['lieu'] ?>">
        </div>
        <div>
            <label for="type">Type</label>
            <input type="text" id="type" name="type" value="<?= $event['type'] ?>">
        </div>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>