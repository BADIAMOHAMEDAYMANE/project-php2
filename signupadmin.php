<?php
// Inclure les fichiers nécessaires avec require_once pour éviter les doublons
require_once("Connection2.php");
require_once("createtableadmin.php");

// Initialisation de la connexion
$dbConnection = new Connection();
$conn = $dbConnection->selectDatabase();


createAdminTable($conn);

session_start();

// Initialisation des variables
$nameerrormsg = "";
$passworderrormsg = "";
$namevalue = "";
$passwordvalue = "";
$confirmpasswordvalue = "";

// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit"])) {
    $namevalue = trim($_POST["username"] ?? '');
    $passwordvalue = trim($_POST["password"] ?? '');
    $confirmpasswordvalue = trim($_POST["confirm-password"] ?? '');

    // Validation des champs
    if (empty($namevalue)) {
        $nameerrormsg = "Enter the admin's name";
    } elseif (empty($passwordvalue)) {
        $passworderrormsg = "Password must be filled out";
    } elseif ($confirmpasswordvalue !== $passwordvalue) {
        $passworderrormsg = "The passwords are not matching";
    } else {
        // Hash du mot de passe
        $hashedpassword = password_hash($passwordvalue, PASSWORD_DEFAULT);

        // Insertion dans la base de données
        $sql = "INSERT INTO admin (name, passwordadmin) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $namevalue, $hashedpassword);

            if ($stmt->execute()) {
                echo "The insertion passed successfully";
                header("Location: login2.php");
                exit();
            } else {
                $passworderrormsg = "Error: Unable to insert data. " . $conn->error;
            }

            $stmt->close();
        } else {
            $passworderrormsg = "Error: Unable to prepare statement. " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signupadmin.css">
</head>
<body>
<div class="signup-container">
    <h1>Sign Up for Admins</h1>
    <form id="login-form" action="" method="POST">
        <label for="username">Name:</label>
        <input type="text" id="username" name="username" placeholder="Enter your name" value="<?php echo htmlspecialchars($namevalue); ?>">
        <span style='color:red'><?php echo $nameerrormsg; ?></span>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password">
        <span style='color:red'><?php echo $passworderrormsg; ?></span>

        <label for="confirm-password">Confirm Password:</label>
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password">
        <button type="submit" name="submit">Sign Up</button>
        <p>
            Do you already have an account?
            <a href="signinadmin.php">Sign In</a>
        </p>
    </form>
</div>
</body>
</html>
