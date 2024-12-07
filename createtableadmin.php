<?php
function createAdminTable($conn) {
    $createTableQuery = "
        CREATE TABLE IF NOT EXISTS admin (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL UNIQUE,
            passwordadmin VARCHAR(255) NOT NULL
        )";
    if ($conn->query($createTableQuery) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error;
    }
}
?>
