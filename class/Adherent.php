<?php

class Adherent
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;

    // Constructeur pour un adhérent
    public function __construct($nom, $prenom, $email, $password)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT); // Hachage du mdp pour la securité
    }

    // Méthode pour enregistrer un adhérent dans la base de données
    public function save($pdo)
    {
        $stmt = $pdo->prepare("INSERT INTO adherents (nom, prenom, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->nom, $this->prenom, $this->email, $this->password]);
    }

    // Méthode pour vérifier si l'email existe déjà
    public static function emailExists($pdo, $email)
    {
        $stmt = $pdo->prepare("SELECT * FROM adherents WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un tableau si trouvé, sinon false
    }

    // Getter pour l'ID
    public function getId()
    {
        return $this->id;
    }

    // Getter pour le nom
    public function getNom()
    {
        return $this->nom;
    }
}


?>