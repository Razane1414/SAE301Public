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
// Récupérer les dernières inscriptions
$sql = "SELECT 
            i.id AS inscription_id,
            a.nom AS nom_adherent,
            a.prenom AS prenom_adherent,
            e.titre AS titre_evenement,
            i.date_inscription

        FROM 
            inscriptions i
        JOIN 
            adherents a ON i.adherent_id = a.id
        JOIN 
            events e ON i.event_id = e.id
        ORDER BY 
            i.date_inscription DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$inscriptions = $stmt->fetchAll();

// Ajouter un adhérent 
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
// Récupérer tous les adhérents
$sqlAdherents = "SELECT 
                    id,
                    nom,
                    prenom,
                    email,
                    date_naissance,
                    sexe,
                    date_creation
                FROM 
                    adherents
                ORDER BY 
                    date_creation DESC";

$stmtAdherents = $pdo->prepare($sqlAdherents);
$stmtAdherents->execute();
$adherents = $stmtAdherents->fetchAll();

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
    <script src="../include/js/admin.js"></script>

</head>

<body>

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
    <h2>Modifier l'événement</h2>
    <form method="POST">
        <div>
            <label for="edit_titre">Titre</label>
            <input type="text" id="edit_titre" name="titre" value="<?= $eventToEdit['titre'] ?>" required>
        </div>
        <div>
            <label for="edit_description">Description</label>
            <textarea id="edit_description" name="description" required><?= $eventToEdit['description'] ?></textarea>
        </div>
        <div>
            <label for="edit_date_event">Date</label>
            <input type="date" id="edit_date_event" name="date_event" value="<?= $eventToEdit['date_event'] ?>" required>
        </div>
        <div>
            <label for="edit_lieu">Lieu</label>
            <input type="text" id="edit_lieu" name="lieu" value="<?= $eventToEdit['lieu'] ?>">
        </div>
        <div>
            <label for="edit_type">Type</label>
            <select id="edit_type" name="type" required>
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



    <h2>Dernières Inscriptions aux Événements</h2>
    <table>
        <thead>
            <tr>
                <th>Nom de l'adhérent</th>
                <th>Prénom</th>
                <th>Événement</th>
                <th>Date d'inscription</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inscriptions as $inscription): ?>
            <tr>
                <td><?= htmlspecialchars($inscription['nom_adherent']) ?></td>
                <td><?= htmlspecialchars($inscription['prenom_adherent']) ?></td>
                <td><?= htmlspecialchars($inscription['titre_evenement']) ?></td>
                <td><?= htmlspecialchars($inscription['date_inscription']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

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
                        <input type="text" class="champ-formulaire" id="nom" name="nom" placeholder="Nom de l'adhérent"
                            required>
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
                        <button type="submit" name="add_adherent" class="btn-ajouter">Ajouter un adhérent</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <h2>Liste des Adhérents</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Date de naissance</th>
                <th>Sexe</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($adherents as $adherent): ?>
            <tr>
                <td><?= htmlspecialchars($adherent['nom']) ?></td>
                <td><?= htmlspecialchars($adherent['prenom']) ?></td>
                <td><?= htmlspecialchars($adherent['email']) ?></td>
                <td><?= htmlspecialchars($adherent['date_naissance']) ?></td>
                <td><?= htmlspecialchars($adherent['sexe'] == 'M' ? 'Homme' : 'Femme') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>