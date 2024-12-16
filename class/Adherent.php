<?php

class Adherent
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $date_naissance;
    private $sexe;

    // Constructeur mis à jour
    public function __construct($nom, $prenom, $email, $password, $date_naissance, $sexe)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT); // Hachage sécurisé
        $this->date_naissance = $date_naissance;
        $this->sexe = $sexe;
    }

    // Méthode pour enregistrer un adhérent
    public function save($pdo)
    {
        try {
            $stmt = $pdo->prepare("INSERT INTO adherents (nom, prenom, email, password, date_naissance, sexe) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$this->nom, $this->prenom, $this->email, $this->password, $this->date_naissance, $this->sexe]);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
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
