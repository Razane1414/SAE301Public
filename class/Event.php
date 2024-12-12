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
}
