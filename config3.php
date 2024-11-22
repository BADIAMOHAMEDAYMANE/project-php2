<?php
include("credentials.php");
mysqli_select_db($conn, 'website');
session_start();

$emailerrormsg = "";
$passworderrormsg = "";

if (isset($_POST["submit"])) {
    $emailvalue = $_POST["email"];
    $passwordvalue = $_POST["password"];

    // Validation des champs
    if ($emailvalue == "") {
        $emailerrormsg = "Email must be filled out";
    } elseif (!preg_match("/\w+(@emsi\.ma){1}$/", $emailvalue)) { // Correction de l'expression régulière
        $emailerrormsg = "Please enter a valid email with '@emsi.ma'";
    } elseif ($passwordvalue == "") {
        $passworderrormsg = "Password must be filled out";
    } else {
        // Requête SQL sécurisée avec `prepare` et `bind_param`
        $stmt = $conn->prepare("SELECT email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $emailvalue);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($passwordvalue, $row['password'])) {
                // Connexion réussie
                header("location:validation.php");
                exit();
            } else {
                $passworderrormsg = "Invalid password.";
            }
        } else {
            $emailerrormsg = "No account found with that email.";
        }

        $stmt->close();
    }
}
?>
