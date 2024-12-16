<?php

// Inclure la configuration pour la connexion à la base de données
require_once '../config/config.php';
require_once '../class/Event.php'; 
require_once '../class/Adherent.php';

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login_admin.php"); 
    exit();
}

// Afficher un message de bienvenue avec le nom de l'admin
echo "Bonjour " . $_SESSION['user_name'] . ", bienvenue sur la page admin!";

// Ajouter un événement
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_event'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_event = $_POST['date_event'];
    $lieu = $_POST['lieu'];
    $type = $_POST['type'];

    // Vérifier si les données sont valides
    if (!empty($titre) && !empty($description) && !empty($date_event)) {
        $event = new Event($titre, $description, $date_event, $lieu, $type);
        $event->save($pdo); // Sauvegarder l'événement dans la base de données
        echo "<script>alert('Événement ajouté avec succès');</script>";
    }
}

// Modifier un événement
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_event'])) {
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
        echo "<script>alert('Événement mis à jour avec succès');</script>";
        header("Location: espace_admin.php");
        exit(); // Assurez-vous que le script s'arrête après la redirection
    } else {
        echo "<script>alert('Tous les champs doivent être remplis');</script>";
    }
}

// Supprimer un événement
if (isset($_GET['delete_id'])) {
    $eventId = $_GET['delete_id'];
    Event::delete($pdo, $eventId); // Appeler la méthode pour supprimer l'événement
    echo "<script>alert('Événement supprimé avec succès');</script>";
}

// Récupérer un événement spécifique si l'ID est passé dans l'URL pour modification
$event = null;
if (isset($_GET['id'])) {
    $event = Event::getEventById($pdo, $_GET['id']);
}

// Récupérer tous les événements
$events = Event::getAllEvents($pdo);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_adherent'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $date_naissance = $_POST['date_naissance'];
    $sexe = $_POST['sexe'];

    // Vérifier si les données sont valides
    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($password) && !empty($date_naissance) && !empty($sexe)) {
        if (!Adherent::emailExists($pdo, $email)) {
            // Ajouter les nouveaux paramètres dans le constructeur ou une méthode d'initialisation
            $adherent = new Adherent($nom, $prenom, $email, $password, $date_naissance, $sexe);
            $adherent->save($pdo); // Sauvegarder l'adhérent dans la base de données
            echo "<script>alert('Adhérent ajouté avec succès');</script>";
        } else {
            echo "<script>alert('Cet email est déjà utilisé');</script>";
        }
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
    <title>Gestion des événements</title>
</head>
<body>
    <h1>Gestion des événements</h1>

    <!-- Formulaire d'ajout d'événement -->
    <h2>Ajouter un événement</h2>
    <form method="POST">
        <div>
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div>
            <label for="date_event">Date</label>
            <input type="date" id="date_event" name="date_event" required>
        </div>
        <div>
            <label for="lieu">Lieu</label>
            <input type="text" id="lieu" name="lieu">
        </div>
        <div>
            <label for="type">Type</label>
            <input type="text" id="type" name="type">
        </div>
        <button type="submit" name="add_event">Ajouter</button>
    </form>

    <!-- Liste des événements -->
    <h2>Liste des événements</h2>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date</th>
                <th>Lieu</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= $event['titre'] ?></td>
                    <td><?= $event['description'] ?></td>
                    <td><?= $event['date_event'] ?></td>
                    <td><?= $event['lieu'] ?></td>
                    <td><?= $event['type'] ?></td>
                    <td>
                        <a href="edit_event.php?id=<?= $event['id'] ?>">Modifier</a>
                        <a href="?delete_id=<?= $event['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet événement ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Ajouter un adhérent</h2>
    <form method="POST">
        <div>
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div>
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="date_naissance">Date de naissance</label>
            <input type="date" id="date_naissance" name="date_naissance" required>
        </div>
        <div>
            <label for="sexe">Sexe</label>
            <select id="sexe" name="sexe" required>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select>
        </div>
        <button type="submit" name="add_adherent">Ajouter</button>
    </form>


</body>
</html>

<?php
// Inclure le footer
include '../include/footer.php';
?>