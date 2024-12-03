<?php
session_start();
require_once 'Connection2.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login2.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Get logged-in user_id

if (isset($_GET['id'])) {
    $child_id = $_GET['id'];

    // Connect to the database
    $db = new Connection();
    $conn = $db->selectDatabase();

    // Prepare the delete query
    $sql = "DELETE FROM child WHERE id = ? AND parent_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Query preparation failed: " . mysqli_error($conn));
    }

    // Bind parameters and execute
    mysqli_stmt_bind_param($stmt, "ii", $child_id, $user_id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("Location: managechild.php?success=1"); // Redirect to manage children page
    } else {
        header("Location: managechild.php?error=1"); // Redirect with error
    }
} else {
    header("Location: managechild.php"); // If no child id is provided, redirect to manage page
    exit();
}
