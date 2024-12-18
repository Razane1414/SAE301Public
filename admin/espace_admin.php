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
    <link rel="stylesheet" href="../include/css/calendrier.css">

    <!-- FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    <script src="../include/js/calendrier.js"></script>
</head>


<body>

    <div id="calendar"></div>

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

 
    <div id="section-ajouter-adherent">
    <!-- Titre de la section -->
    <h1 class="titlee">
    <span class="highlight">Ajouter</span> un adhérent
</h1>

    <!-- Carte contenant le formulaire -->
    <div class="carte-formulaire">
        <!-- En-tête de la carte -->
        <div class="carte-header">Formulaire d'ajout</div>

        <!-- Corps de la carte (formulaire) -->
        <div class="carte-corps">
            <form method="POST">
                <div>
                <input type="text" class="champ-formulaire" id="nom" name="nom" placeholder="Nom de l'adhérent" required>
                </div>
                <div>
                <input type="text" class="champ-formulaire" id="prenom" name="prenom" placeholder="Prenom de l'adhérent" required>
                </div>
                <div>
                <input type="email" class="champ-formulaire" id="email" name="email" placeholder="Email" required>
                </div>
                <div>
                <input type="password" class="champ-formulaire" id="password" name="password" placeholder="Mot de passe" required>
                </div>
                <div>
                <input type="date" class="champ-formulaire" id="date_naissance" name="date_naissance" placeholder="Mot de passe" required>
                </div>
                <div>
                <select class="champ-formulaire" id="sexe" name="sexe" required>
                    <option value="M">Homme</option>
                    <option value="F">Femme</option> 
                    </select>
                </div>
                <!-- Bouton pour soumettre le formulaire -->
                <button type="submit" name="add_adherent" class="btn-ajouter">Ajouter un adhérent</button>
            </form>

          
    

</body>

</html>
