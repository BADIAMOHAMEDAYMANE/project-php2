<?php
include("Connection2.php");

try {
    // Instancier la connexion
    $dbConnection = new Connection();

    // Sélectionner la base de données
    $conn = $dbConnection->selectDatabase();

    // Créer une table si nécessaire
    $createTableQuery = "
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    $dbConnection->createTable($createTableQuery);

    echo "La base de données et la table sont prêtes.<br>";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
