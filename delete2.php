<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Retrieve 'id' from the GET request
    $id = $_GET['id'];

    // Include the database connection file
    include ("Connection2.php");

    // Create an instance of the Connection class
    $connection = new Connection();

    // Select the database
    $db = $connection->selectDatabase();

    // Include the user file
    include 'user.php';

    // Call the static deleteUser method to delete the user
    if (User::deleteUser($db, $id)) {
        echo "User with ID $id has been deleted successfully.";
    } else {
        echo "Failed to delete the user with ID $id.";
    }
}
?>
