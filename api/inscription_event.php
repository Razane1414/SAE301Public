<?php
require_once '../config/config.php';
require_once '../class/Inscription.php';
header('Content-Type: application/json');
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['adherent_id'])) {
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté pour vous inscrire.']);
    exit;
}

// Récupération des données POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adherent_id = $_SESSION['adherent_id']; // ID du membre connecté
    $event_id = $_POST['event_id']; // ID de l'événement à inscrire

    if (!$event_id) {
        echo json_encode(['success' => false, 'message' => 'ID de l\'événement manquant.']);
        exit;
    }

    try {
        // Vérifiez si l'utilisateur est déjà inscrit à l'événement
        if (Inscription::isAlreadyInscribed($pdo, $adherent_id, $event_id)) {
            echo json_encode(['success' => false, 'message' => 'Vous êtes déjà inscrit à cet événement.']);
            exit;
        }

        // Enregistrez l'inscription
        $inscription = new Inscription($adherent_id, $event_id);
        $inscription->save($pdo);

        echo json_encode(['success' => true, 'message' => 'Inscription réussie.']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'inscription : ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
}
