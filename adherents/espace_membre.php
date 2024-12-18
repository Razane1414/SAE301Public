<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

    <link rel="stylesheet" href="../include/css/home.css">
    <link rel="stylesheet" href="../include/css/membre.css">
    <link rel="stylesheet" href="../include/css/calendrier.css">
    <script src="../include/js/calendriermembre.js"></script>

    <title>Espace membre</title>
</head>

<body>
    <?php
    require_once '../config/config.php';
    include '../include/header.php';
    session_start();

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    try {
        $pdo = new PDO("mysql:host=$hote;port=$port;dbname=$nom_bd", $identifiant, $mot_de_passe);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $adherent_id = $_SESSION['adherent_id']; // Remplacez par la méthode correcte pour récupérer l'ID de l'adhérent connecté

        // Récupérer les événements et les inscriptions actuelles
        $stmt = $pdo->prepare(
            "SELECT e.id, e.titre, e.date_event, e.description, e.lieu, e.type, 
                    IFNULL(i.adherent_id, 0) AS inscrit
             FROM events e
             LEFT JOIN inscriptions i ON e.id = i.event_id AND i.adherent_id = :adherent_id"
        );
        $stmt->bindParam(':adherent_id', $adherent_id);
        $stmt->execute();

        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erreur de connexion à la base de données : " . htmlspecialchars($e->getMessage()) . "</div>";
        exit;
    }
    ?>

    <div class="container my-5">
        <div id="calendar"></div>

        <div class="py-5">
            <div class="header">Événement</div>
            <div class="content-section">
                <div class="text-section">
                    <div class="event-title">Aucun événement sélectionné</div>
                    <p class="description">Cliquez sur un événement du calendrier pour afficher ses détails ici.</p>
                </div>
                <div class="image-section">
                    <div class="image-container">
                        <img src="../include/images/jjb.png" alt="JJB Stage">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var events = <?php echo json_encode(array_map(function ($event) {
                return [
                    'id' => $event['id'],
                    'title' => $event['titre'],
                    'start' => $event['date_event'],
                    'description' => $event['description'],
                    'location' => $event['lieu'],
                    'status' => $event['inscrit'] ? 'inscrit' : 'non_inscrit'
                ];
            }, $events)); ?>;

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                events: events,
                eventClick: function (info) {
                    // Récupérer les données de l'événement cliqué
                    const title = info.event.title;
                    const description = info.event.extendedProps.description;

                    // Mettre à jour les éléments de la page
                    document.querySelector('.event-title').textContent = `Événement sélectionné : ${title}`;
                    document.querySelector('.description').textContent = description;
                }
            });

            calendar.render();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../include/footer.php'; ?>
</body>

</html>
