<?php
$hote = 'localhost'; 
$port = '8888'; 
$nom_bd = 'team_vulcan'; 
$identifiant = 'root'; 
$mot_de_passe = 'root'; 

try {
    $pdo = new PDO(
        "mysql:host=$hote;port=$port;dbname=$nom_bd", 
        $identifiant, 
        $mot_de_passe
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>