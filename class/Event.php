<?php

class Event
{
    private $id;
    private $titre;
    private $description;
    private $date_event;
    private $lieu;
    private $type;

    // Constructeur pour initialiser un événement
    public function __construct($titre, $description, $date_event, $lieu, $type)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->date_event = $date_event;
        $this->lieu = $lieu;
        $this->type = $type;
    }

    // Méthode pour enregistrer un événement dans la base de données
    public function save($pdo)
    {
        $stmt = $pdo->prepare("INSERT INTO events (titre, description, date_event, lieu, type) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$this->titre, $this->description, $this->date_event, $this->lieu, $this->type]);
    }

    // Méthode pour récupérer tous les événements
    public static function getAllEvents($pdo)
    {
        $stmt = $pdo->query("SELECT * FROM events");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer un événement par son ID
    public static function getEventById($pdo, $id)
    {
        $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour mettre à jour un événement dans la base de données
    public function update($pdo, $id)
    {
        $stmt = $pdo->prepare("UPDATE events SET titre = ?, description = ?, date_event = ?, lieu = ?, type = ? WHERE id = ?");
        $stmt->execute([$this->titre, $this->description, $this->date_event, $this->lieu, $this->type, $id]);
    }

    // Méthode pour supprimer un événement par son ID
    public static function delete($pdo, $id)
    {
        $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
        $stmt->execute([$id]);
    }
    public static function getEventTypes($pdo)
    {
        // Exemple avec un tableau en dur
        return [
            'MMA' => 'MMA',
            'Boxe Thai' => 'Boxe Thai',
            'Kickboxing' => 'Kickboxing',
            'JJB' => 'JJB',
            'Autre' => 'Autre'
        ];

    }
}

?>