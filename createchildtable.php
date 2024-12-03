<?php
include 'Connection2.php';

try {
    $db = new Connection();
    $db->createDatabase(); 
    $conn = $db->selectDatabase();

    // Updated query to include user_id
    $query = "
        CREATE TABLE IF NOT EXISTS child (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            date_of_birth DATE NOT NULL,
            user_id INT NOT NULL, -- Foreign key to the users table
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );
    ";
    $db->createTable($query);
    echo "La table `child` a été créée avec succès.";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
