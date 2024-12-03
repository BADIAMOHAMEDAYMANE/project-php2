<?php
session_start();
include "Connection2.php";

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // ID de l'utilisateur connecté

// Connexion à la base de données
$db = new Connection();
$conn = $db->selectDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth']; // Utilisation de la date de naissance plutôt que l'âge

    // Vérifier si la date de naissance et le nom sont définis
    if (empty($name) || empty($date_of_birth)) {
        $errorMessage = "Le nom et la date de naissance sont obligatoires!";
    } else {
        // Ajouter un enfant dans la base de données
        $sql = "INSERT INTO child (name, date_of_birth, parent_id) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $name, $date_of_birth, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            $successMessage = "Enfant ajouté avec succès!";
        } else {
            $errorMessage = "Erreur lors de l'ajout de l'enfant : " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Enfant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            text-align: center;
            font-size: 14px;
            color: #d9534f;
        }
        .success {
            color: #5bc0de;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter un Nouvel Enfant</h1>
        
        <?php if (isset($successMessage)): ?>
            <p class="message success"><?= htmlspecialchars($successMessage); ?></p>
        <?php elseif (isset($errorMessage)): ?>
            <p class="message"><?= htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>

        <form action="addchild.php" method="POST">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>

            <label for="date_of_birth">Date de naissance :</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>

            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>
</html>
