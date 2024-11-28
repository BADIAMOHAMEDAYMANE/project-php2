<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Récupérer 'id' depuis la requête GET
    $id = $_GET['id'];

    // Inclure le fichier de connexion à la base de données
    include ("Connection2.php");

    // Créer une instance de la classe Connection
    $connection = new Connection();

    // Sélectionner la base de données
    $db = $connection->selectDatabase();

    // Inclure le fichier contenant la classe Users
    include 'Users.php';  // Assurez-vous que le fichier Users.php existe

    // Appeler la méthode statique deleteUser pour supprimer l'utilisateur
    if (Users::deleteUser($db, $id)) {  // Utilisez "Users" au lieu de "User"
        echo "L'utilisateur avec l'ID $id a été supprimé avec succès.";
    } else {
        echo "Échec de la suppression de l'utilisateur avec l'ID $id.";
    }
}
?>
