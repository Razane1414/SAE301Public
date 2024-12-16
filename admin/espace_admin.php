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

// Récupérer un événement spécifique pour modification
$eventToEdit = null;
if (isset($_GET['edit_id'])) {
    $eventToEdit = Event::getEventById($pdo, $_GET['edit_id']);
}

// Ajouter un événement via l'API
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_event'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_event = $_POST['date_event'];
    $lieu = $_POST['lieu'];
    $type = $_POST['type'];

    // Vérifier si les données sont valides
    if (!empty($titre) && !empty($description) && !empty($date_event)) {
        // Préparer les données à envoyer à l'API
        $data = [
            'titre' => $titre,
            'description' => $description,
            'date_event' => $date_event,
            'lieu' => $lieu,
            'type' => $type
        ];

        // Envoyer une requête POST à l'API
        $url = 'http://localhost/SAE301Local/api/api_events.php';         
        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/json',
                'content' => json_encode($data)
            ]
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context); // Exécuter la requête

        // Afficher directement la réponse de l'API (message d'erreur ou succès)
        echo "<script>alert('" . $response . "');</script>";
    } else {
        echo "<script>alert('Tous les champs doivent être remplis');</script>";
    }
}

// Modifier un événement via l'API
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_event'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_event = $_POST['date_event'];
    $lieu = $_POST['lieu'];
    $type = $_POST['type'];

    // Vérifier si les données sont valides
    if (!empty($id) && !empty($titre) && !empty($description) && !empty($date_event)) {
        // Préparer les données à envoyer à l'API
        $data = [
            'id' => $id,
            'titre' => $titre,
            'description' => $description,
            'date_event' => $date_event,
            'lieu' => $lieu,
            'type' => $type
        ];

        // Envoyer une requête PUT à l'API
        $url = 'http://localhost/SAE301Local/api/api_events.php';         
        $options = [
            'http' => [
                'method'  => 'PUT',
                'header'  => 'Content-Type: application/json',
                'content' => json_encode($data)
            ]
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        // Afficher directement la réponse de l'API (message d'erreur ou succès)
        echo "<script>alert('" . $response . "');</script>";

        header("Location: espace_admin.php");
        exit();
    } else {
        echo "<script>alert('Tous les champs doivent être remplis');</script>";
    }
}

// Supprimer un événement via l'API
if (isset($_GET['delete_id'])) {
    $eventId = $_GET['delete_id'];

    // Envoyer une requête DELETE à l'API
    $url = 'http://localhost/SAE301Local/api/api_events.php?id=' . $eventId;         
    $options = [
        'http' => [
            'method'  => 'DELETE',
            'header'  => 'Content-Type: application/json'
        ]
    ];
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    // Afficher directement la réponse de l'API (message d'erreur ou succès)
    echo "<script>alert('" . $response . "');</script>";

    header("Location: espace_admin.php");
    exit();
}

// Ajouter un adhérent via l'API
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

// Récupérer tous les événements
$events = Event::getAllEvents($pdo);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des événements</title>
    <link rel="stylesheet" href="../include/css/admin.css">
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
            <select id="type" name="type" required>
                <?php
                // Récupérer les types d'événements depuis la base de données via la méthode de la classe Event
                $eventTypes = Event::getEventTypes($pdo);
                foreach ($eventTypes as $value => $label) {
                    echo "<option value=\"$value\">$label</option>";
                }
                ?>
            </select>
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
                        <a href="?edit_id=<?= $event['id'] ?>">Modifier</a>
                        <a href="?delete_id=<?= $event['id'] ?>"
                            onclick="return confirm('Voulez-vous vraiment supprimer cet événement ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($eventToEdit): ?>
        <h2>Modifier l'événement</h2>
        <form method="POST">
            <div>
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" value="<?= $eventToEdit['titre'] ?>" required>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description" required><?= $eventToEdit['description'] ?></textarea>
            </div>
            <div>
                <label for="date_event">Date</label>
                <input type="date" id="date_event" name="date_event" value="<?= $eventToEdit['date_event'] ?>" required>
            </div>
            <div>
                <label for="lieu">Lieu</label>
                <input type="text" id="lieu" name="lieu" value="<?= $eventToEdit['lieu'] ?>">
            </div>
            <div>
                <label for="type">Type</label>
                <select id="type" name="type" required>
                    <?php
                    $eventTypes = Event::getEventTypes($pdo);
                    foreach ($eventTypes as $value => $label) {
                        $selected = ($value == $eventToEdit['type']) ? 'selected' : '';
                        echo "<option value=\"$value\" $selected>$label</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" name="id" value="<?= $eventToEdit['id'] ?>">
            <button type="submit" name="update_event">Mettre à jour</button>
        </form>
    <?php endif; ?>

    <!-- Formulaire d'ajout d'adhérent -->
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
                <option value="M">Homme</option>
                <option value="F">Femme</option>
            </select>
        </div>
        <button type="submit" name="add_adherent">Ajouter un adhérent</button>
    </form>

</body>

</html>
