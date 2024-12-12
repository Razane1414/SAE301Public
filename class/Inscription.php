<?php

class Inscription {
    private $adherent_id;
    private $event_id;

    public function __construct($adherent_id, $event_id) {
        $this->adherent_id = $adherent_id;
        $this->event_id = $event_id;
    }

    
    // Méthode pour enregistrer une inscription dans la base de données
    public function save($pdo) {
        $stmt = $pdo->prepare("INSERT INTO inscriptions (adherent_id, event_id) VALUES (?, ?)");
        $stmt->execute([$this->adherent_id, $this->event_id]);
    }

    // Vérifier si un adhérent est déjà inscrit à un événement
    public static function isAlreadyInscribed($pdo, $adherent_id, $event_id) {
        $stmt = $pdo->prepare("SELECT * FROM inscriptions WHERE adherent_id = ? AND event_id = ?");
        $stmt->execute([$adherent_id, $event_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un tableau si trouvé, sinon false
    }
}
