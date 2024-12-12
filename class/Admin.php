<?php

class Admin
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;

    // Constructeur pour l'administrateur
    public function __construct($nom, $prenom, $email, $password)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    // Méthode pour enregistrer un administrateur dans la base de données
    public function save($pdo)
    {
        $stmt = $pdo->prepare("INSERT INTO admins (nom, prenom, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->nom, $this->prenom, $this->email, $this->password]);
    }

    // Méthode pour vérifier si l'email de l'admin existe déjà
    public static function emailExists($pdo, $email)
    {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthodes pour gérer les événements
    public static function addEvent($pdo, $titre, $description, $date_event, $lieu, $type)
    {
        $stmt = $pdo->prepare("INSERT INTO events (titre, description, date_event, lieu, type) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$titre, $description, $date_event, $lieu, $type]);
    }

    public static function deleteEvent($pdo, $id)
    {
        $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function updateEvent($pdo, $id, $titre, $description, $date_event, $lieu, $type)
    {
        $stmt = $pdo->prepare("UPDATE events SET titre = ?, description = ?, date_event = ?, lieu = ?, type = ? WHERE id = ?");
        $stmt->execute([$titre, $description, $date_event, $lieu, $type, $id]);
    }

    // Méthode pour lister les événements
    public static function listEvents($pdo)
    {
        $stmt = $pdo->prepare("SELECT * FROM events");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les événements
    }
}
?>