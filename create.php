<?php
include("Connection2.php"); // Inclure la logique de connexion à la base de données
include("Users.php");       // Inclure la classe Users

// Initialisation des messages et des valeurs
$messages = []; // Ce tableau stockera les messages d'erreurs et de succès
$emailvalue = "";
$passwordvalue = "";
$successmsg = "";

if (isset($_POST['submit'])) {
    $emailvalue = $_POST['email'];
    $passwordvalue = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validation des champs
    if (empty($emailvalue) || empty($passwordvalue)) {
        $messages[] = "Tous les champs sont obligatoires.";
    } elseif (strlen($passwordvalue) < 8) {
        $messages[] = "Le mot de passe doit contenir au moins 8 caractères.";
    } elseif (!preg_match('/[A-Z]/', $passwordvalue)) {
        $messages[] = "Le mot de passe doit contenir au moins une lettre majuscule.";
    } elseif ($passwordvalue !== $confirmPassword) {
        $messages[] = "Les mots de passe ne correspondent pas.";
    } else {
        // Créer une connexion à la base de données
        $conn = new Connection();

        try {
            // Sélectionner la base de données
            $conn->selectDatabase();

            // Créer un nouvel utilisateur
            $newUsers = new Users($emailvalue, $passwordvalue);

            // Insérer l'utilisateur dans la base de données
            $insertResult = $newUsers->insertUser($conn->conn); // Utiliser l'objet connexion

            // Vérifier si l'insertion a réussi
            if ($insertResult) {
                // Rediriger vers la page read.php après succès
                header("Location: read.php");
                exit(); // Arrêter l'exécution après redirection
            } else {
                $messages[] = Users::$errorMessage; // Message d'erreur depuis la classe Users
            }
        } catch (Exception $e) {
            $messages[] = "Erreur : " . $e->getMessage(); // Afficher l'erreur si la connexion échoue
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Inscription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Inscription</h2>
        <form method="post">
            <!-- Champ Email -->
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="email">Email :</label>
                <div class="col-sm-6">
                    <input value="<?php echo htmlspecialchars($emailvalue); ?>" class="form-control" type="email" id="email" name="email" required>
                </div>
            </div>
            
            <!-- Champ Mot de passe -->
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="password">Mot de passe :</label>
                <div class="col-sm-6">
                    <input class="form-control" type="password" id="password" name="password" required>
                </div>
            </div>
            
            <!-- Champ Confirmation du mot de passe -->
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="confirm_password">Confirmez le mot de passe :</label>
                <div class="col-sm-6">
                    <input class="form-control" type="password" id="confirm_password" name="confirm_password" required>
                </div>
            </div>
            
            <!-- Boutons -->
            <div class="row mb-3">
                <div class="offset-sm-1 col-sm-3 d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">S'inscrire</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="signin.php">Se connecter</a>
                </div>
            </div>

            <!-- Messages d'erreur et de succès -->
            <div class="row mb-3">
                <?php
                // Afficher les messages de succès ou d'erreurs
                if ($successmsg) {
                    echo "<span style='color:green'>$successmsg</span>";
                } elseif (!empty($messages)) {
                    foreach ($messages as $message) {
                        echo "<span style='color:red'>$message</span><br>";
                    }
                }
                ?>
            </div>
        </form>
    </div>
</body>
</html>
