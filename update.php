<?php
include("Connection2.php");
$errormsg = "";
$errorpasswordmsg = "";
$emailvalue = "";
$passwordvalue = "";
$successmsg = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'] ?? null; // Get user ID or null if not set

    if ($id) {
        $connection = new Connection();
        $db = $connection->selectDatabase();

        include "users.php";

        // Call the static selectUserById method and store the result in $row
        $row = User::selectUserById($db, $id);
        if ($row) {
            // Pre-fill form fields with user data
            $emailvalue = $row['email'];
        } else {
            $errormsg = "No user found with ID $id.";
        }
    } else {
        $errormsg = "No ID provided.";
    }
}

if (isset($_POST["submit"])) {
    $id = $_GET['id'] ?? null; // Ensure ID is retrieved for update
    $emailvalue = $_POST["email"];
    $passwordvalue = $_POST["password"];

    if (empty($emailvalue) || empty($passwordvalue)) {
        $errorpasswordmsg = "All fields must be filled out.";
    } else {
        // Process the form submission
        $connection = new Connection();
        $db = $connection->selectDatabase();

        include "users.php";

        // Create a new instance of User
        $user = new User($id, $emailvalue, $passwordvalue);

        // Call the static updateUser method and pass the $user instance
        if (User::updateUser($db, $user)) {
            $successmsg = "User updated successfully!";
        } else {
            $errormsg = "Failed to update the user.";
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


