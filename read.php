<?php
include("Connection2.php"); // Inclure la logique de connexion à la base de données
include("Users.php");       // Inclure la classe Users

// Récupérer tous les utilisateurs avec selectAllUsers
$conn = new Connection();
$dbConn = $conn->selectDatabase();
$users = Users::selectAllUsers($dbConn); // Utilisation de selectAllUsers
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h3>Liste des utilisateurs</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($users) > 0) {
                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td>" . $user['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                        echo "<td>";
                        echo "<a href='update.php?id=" . $user['id'] . "' class='btn btn-primary btn-sm me-2'>Modifier</a>";
                        echo "<a href='delete2.php?id=" . $user['id'] . "' class='btn btn-danger btn-sm'>Supprimer</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } 
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>


