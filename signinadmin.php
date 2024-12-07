<?php 
include("Connection2.php");
include("createtableadmin.php");
session_start();

// Initialisation de la connexion
$dbConnection = new Connection();
$conn = $dbConnection->selectDatabase();

createAdminTable($conn);

$nameerrormsg = "";
$passworderrormsg = "";
$namevalue = "";

// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit"])) {
    $namevalue = trim($_POST["name"] ?? '');
    $passwordvalue = trim($_POST["password"] ?? '');
    
    // Validation des champs
    if (empty($namevalue)) {
        $nameerrormsg = "You must enter your name.";
    } elseif (empty($passwordvalue)) {
        $passworderrormsg = "Password must be filled out.";
    } else {
        // Requête SQL sécurisée avec `prepare` et `bind_param`
        $stmt = $conn->prepare("SELECT name, passwordadmin FROM admin WHERE name = ?");
        if ($stmt) {
            $stmt->bind_param("s", $namevalue);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($passwordvalue, $row['passwordadmin'])) {
                    // Connexion réussie
                    $_SESSION['user'] = $row['name']; // Stocker le nom de l'utilisateur dans la session
                    header("Location: navbar.php");
                    exit();
                } else {
                    $passworderrormsg = "Invalid password.";
                }
            } else {
                $nameerrormsg = "No account found with that name.";
            }
            
            $stmt->close();
        } else {
            $nameerrormsg = "Failed to prepare the SQL statement.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="signinadmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <section>
        <div class="login-box">
            <form action="" method="post">
                <h2>Login</h2>
                <div class="input-box">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($namevalue); ?>">
                    <span class="icon">
                        <ion-icon name="person-outline"></ion-icon>
                    </span>
                    <span style='color:red' class="span1"><?php echo htmlspecialchars($nameerrormsg); ?></span>
                </div>
                <div class="input-box">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <span style='color:red' class="span1"><?php echo htmlspecialchars($passworderrormsg); ?></span>
                </div>
                <button type="submit" name="submit">Login</button>
            </form>
        </div>
    </section>

    <!-- Importing Ionicons for icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>