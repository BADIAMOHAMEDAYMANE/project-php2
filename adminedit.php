<?php
include("credentials.php");
mysqli_select_db($conn, 'website');

// Initialisation des variables
$errormsg = "";
$errorpasswordmsg = "";
$emailvalue = "";
$passwordvalue = "";
$successmsg = "";

// Récupération de l'ID à partir de l'URL
$url = $_SERVER['REQUEST_URI'];
$pathParts = explode('/', trim($url, '/'));
$id = isset($pathParts[2]) ? intval($pathParts[2]) : 0; // Validation de l'ID

// Pré-remplissage des champs pour un utilisateur existant
if ($id > 0) {
    $sql = "SELECT id, email, password FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $emailvalue = $row["email"];
    } else {
        $errormsg = "No user found with the provided ID.";
    }
} else {
    $errormsg = "Invalid ID provided.";
}

// Gestion du formulaire
if (isset($_POST['submit'])) {
    $emailvalue = mysqli_real_escape_string($conn, $_POST['email']);
    $passwordvalue = $_POST['password'];

    if (empty($emailvalue) || empty($passwordvalue)) {
        $errormsg = "All fields are required.";
    } else if (strlen($passwordvalue) < 8) {
        $errorpasswordmsg = "Password must contain at least 8 characters.";
    } else if (!preg_match('/[A-Z]+/', $passwordvalue)) {
        $errorpasswordmsg = "Password must contain at least one capital letter.";
    } else {
        $hashedPassword = password_hash($passwordvalue, PASSWORD_DEFAULT);

        // Mise à jour des données de l'utilisateur
        $sql = "UPDATE users SET email = '$emailvalue', password = '$hashedPassword' WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            $successmsg = "User updated successfully.";
            header("Location: /tp2/adminusers.php");
            exit();
        } else {
            $errormsg = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Edit User</h2>
        <br>
        <form method="post" action="">
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="email">Email:</label>
                <div class="col-sm-6">
                    <input value="<?= htmlspecialchars($emailvalue) ?>" class="form-control" type="email" id="email" name="email">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="password">Password:</label>
                <div class="col-sm-6">
                    <input class="form-control" type="password" id="password" name="password">
                </div>
                <span style="color:red"><?= htmlspecialchars($errorpasswordmsg) ?></span>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-1 col-sm-3 d-grid">
                    <button name="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            <span style="color:green"><?= htmlspecialchars($successmsg) ?></span>
            <span style="color:red"><?= htmlspecialchars($errormsg) ?></span>
        </form>
    </div>
</body>
</html>
