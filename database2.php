<?php
include("Connection2.php");

// Créer une nouvelle instance de la classe Connection
$db = new Connection();

// Créer la base de données
$db->createDatabase();

// Sélectionner la base de données
$db->selectDatabase();

// Définir la requête SQL pour créer la table "users"
$query = " 
    CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(30) UNIQUE,
        password VARCHAR(100)
    )
";

// Créer la table
$db->createTable($query);

// Fermer la connexion
$db->closeConnection();
?>
