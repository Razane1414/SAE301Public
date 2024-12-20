<?php

// Inclure la configuration pour la connexion à la base de données
require_once '../config/config.php';
require_once '../class/Event.php';
require_once '../class/Adherent.php';


// Démarrer la session
session_start();
if (!isset($_SESSION['admin_id'])) {
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
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($data)
            ]
        ];
        $context = stream_context_create($options);
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
                'method' => 'PUT',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($data)
            ]
        ];
        $context = stream_context_create($options);
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
            'method' => 'DELETE',
            'header' => 'Content-Type: application/json'
        ]
    ];
    $context = stream_context_create($options);
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
    <!-- FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="../include/js/calendrier.js"></script>
    <script src="../include/js/admin.js"></script>
    <script src="../include/js/modal.js"></script>

    <link rel="stylesheet" href="../include/css/header.css">
    <link rel="stylesheet" href="../include/css/admin.css">
    <link rel="stylesheet" href="../include/css/calendrier.css">
    <link rel="stylesheet" href="../include/css/home.css">
    <link rel="stylesheet" href="../include/css/membre.css">
</head>

<body>
    <?php
    include '../include/header.php';
    ?>

    <?php
    include '../include/header.php';
    ?>

    <div id="calendar"></div>
    <!-- Bouton Plus avec PNG -->
    <div class="btn-new-event">
        <button id="btn-plus" type="button">
            <img src="../include/images/plus.png" alt="Plus" width="24" height="24">
        </button>
    </div>

    <!-- Formulaire caché initialement -->
    <div id="add-event-form" class="carte-formulaire" style="display:none;">
        <div class="carte-header">Ajouter un événement</div>

        <!-- Corps de la carte -->
        <div class="carte-corps">
            <form method="POST">
                <div>
                    <input type="text" class="champ-formulaire" id="titre" name="titre"
                        placeholder="Titre de l'événement" required>
                </div>
                <div>
                    <textarea class="champ-formulaire" id="description" name="description" placeholder="Description"
                        required></textarea>
                </div>
                <div>
                    <input type="date" class="champ-formulaire" id="date_event" name="date_event" required>
                </div>
                <div>
                    <input type="text" class="champ-formulaire" id="lieu" name="lieu" placeholder="Lieu de l'événement">
                </div>
                <div>
                    <select class="champ-formulaire" id="type" name="type" required>
                        <?php
                        $eventTypes = Event::getEventTypes($pdo);
                        foreach ($eventTypes as $value => $label) {
                            echo "<option value=$value>$label</option>";
                        }
                        ?>
                    </select>
                </div>
                <!-- Bouton pour soumettre le formulaire -->
                <div class="center-btn">
                    <button type="submit" name="add_event" class="btn-ajouter">Ajouter l'événement</button>
                </div>
            </form>
        </div>
    </div>



    <?php if ($eventToEdit): ?>
        <div id="section-modifier">
            <!-- Formulaire caché initialement -->
            <div class="carte-formulaire">
                <div class="carte-header">Modifier l'évènement</div>

                <!-- Corps de la carte (formulaire) -->
                <div class="carte-corps">
                    <form method="POST">
                        <div>
                            <label for="titre" class="label">Titre de l'événement</label>
                            <input type="text" id="titre" class="champ-formulaire" name="titre"
                                value="<?= $eventToEdit['titre'] ?>" required>
                        </div>
                        <div>
                            <label for="description" class="label">Description</label>
                            <textarea id="description" class="champ-formulaire" name="description"
                                required><?= $eventToEdit['description'] ?></textarea>
                        </div>
                        <div>
                            <label for="date_event" class="label">Date</label>
                            <input type="date" id="date_event" class="champ-formulaire" name="date_event"
                                value="<?= $eventToEdit['date_event'] ?>" required>
                        </div>
                        <div>
                            <label for="lieu" class="label">Lieu de l'événement</label>
                            <input type="text" id="lieu" class="champ-formulaire" name="lieu"
                                value="<?= $eventToEdit['lieu'] ?>">
                        </div>
                        <div>
                            <label for="type" class="label">Type</label>
                            <select id="type" class="champ-formulaire" name="type" required>
                                <?php
                                $eventTypes = Event::getEventTypes($pdo);
                                foreach ($eventTypes as $value => $label) {
                                    $selected = ($value == $eventToEdit['type']) ? 'selected' : '';
                                    echo "<option value=\"$value\" $selected>$label</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="id" class="champ-formulaire" value="<?= $eventToEdit['id'] ?>">
                        <div class="center-btn">
                            <button type="submit" name="update_event" class="btn-ajouter">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <!-- Formulaire d'ajout d'adhérent -->


        <div id="section-ajouter-adherent">
            <!-- Carte contenant le formulaire -->
            <div class="carte-formulaire">
                <!-- En-tête de la carte -->
                <div class="carte-header">Ajouter un adhérent</div>

                <!-- Corps de la carte (formulaire) -->
                <div class="carte-corps">
                    <form method="POST">
                        <div>
                            <input type="text" class="champ-formulaire" id="nom" name="nom"
                                placeholder="Nom de l'adhérent" required>
                        </div>
                        <div>
                            <input type="text" class="champ-formulaire" id="prenom" name="prenom"
                                placeholder="Prenom de l'adhérent" required>
                        </div>
                        <div>
                            <input type="email" class="champ-formulaire" id="email" name="email" placeholder="Email"
                                required>
                        </div>
                        <div>
                            <input type="password" class="champ-formulaire" id="password" name="password"
                                placeholder="Mot de passe" required>
                        </div>
                        <div>
                            <input type="date" class="champ-formulaire" id="date_naissance" name="date_naissance"
                                placeholder="Mot de passe" required>
                        </div>
                        <div>
                            <select class="champ-formulaire" id="sexe" name="sexe" required>
                                <option value="M">Homme</option>
                                <option value="F">Femme</option>
                            </select>
                        </div>
                        <!-- Bouton pour soumettre le formulaire -->
                        <div class="center-btn">
                            <button type="submit" name="add_adherent" class="btn-ajouter">Ajouter un
                                adhérent</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Fenêtre modale de confirmation -->
            <div id="confirmation-modal" class="modal">
                <div class="modal-content">
                    <span id="close-modal" class="close">&times;</span>
                    <h2>Confirmation de suppression</h2>
                    <p>Êtes-vous sûr de vouloir supprimer cet événement ?</p>
                    <button id="confirm-delete" class="btn btn-danger">Supprimer</button>
                    <button id="cancel-delete" class="btn btn-secondary">Annuler</button>
                </div>
            </div>

            <?php
            include '../include/footer.php';
            ?>
</body>

</html>