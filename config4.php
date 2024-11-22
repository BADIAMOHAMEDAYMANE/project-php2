<?php
include("credentials.php");

// Vérifier la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}

// Initialisation des variables
session_start();
$emailerrormsg = "";
$passworderrormsg = "";
$emailvalue = "";
$passwordvalue = "";
$confirmpasswordvalue = "";

if (isset($_POST["submit"])) {
    $emailvalue = $_POST["email"];
    $passwordvalue = $_POST["password"];
    $confirmpasswordvalue = $_POST["confirm-password"];

    // Validation des champs
    if ($emailvalue == "") {
        $emailerrormsg = "Email must be filled out";
    } elseif (!preg_match("/\w+(@emsi\.ma){1}$/", $emailvalue)) {
        $emailerrormsg = "Please enter a valid email with '@emsi.ma'";
    } elseif ($passwordvalue == "") {
        $passworderrormsg = "Password must be filled out";
    } elseif ($confirmpasswordvalue != $passwordvalue) {
        $passworderrormsg = "The passwords are not matching";
    } else {
        mysqli_select_db($conn, 'website');
        $hashedpassword = password_hash($passwordvalue,PASSWORD_DEFAULT);
          $sql = "INSERT INTO users(email,password)
        VALUES ('$emailvalue','$hashedpassword')";
        if(mysqli_query($conn,$sql)){
            echo "the insertion passed good";
        }
        else{
            echo "Error: " . mysqli_error($conn);
        }
        header("Location: signin.php");
        exit();
    }
}