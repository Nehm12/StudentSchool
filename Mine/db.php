<?php
// db.php
session_start();


$host = 'localhost'; // Adresse du serveur MySQL
$db = 'ifri_aspect'; // Nom de la base de données
$user = 'root'; // Nom d'utilisateur MySQL
$pass = ''; // Mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
