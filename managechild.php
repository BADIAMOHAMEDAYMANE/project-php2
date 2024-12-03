<?php
session_start();
require_once 'Connection2.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Get logged-in user_id

$db = new Connection();
$conn = $db->selectDatabase();

// Query to fetch children associated with the logged-in parent (user)
$sql = "SELECT * FROM child WHERE parent_id = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Query preparation failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}

$children = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Children</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 80%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 8px 16px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }

        .btn-edit {
            background-color: #4CAF50;
        }

        .btn-delete {
            background-color: #f44336;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 50%;
            margin: 20px auto;
        }

        input[type="text"], input[type="date"], input[type="number"] {
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Manage Your Children</h1>

    <h2>Children List</h2>
    <?php if (empty($children)): ?>
        <p>No children found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($children as $child): ?>
                    <tr>
                        <td><?= htmlspecialchars($child['name']); ?></td>

                        <?php
                        // Calculate the age based on the date of birth
                        $dob = new DateTime($child['date_of_birth']);
                        $today = new DateTime();
                        $age = $today->diff($dob)->y;
                        ?>

                        <td><?= $age; ?></td>
                        <td>
                            <a href="editchild.php?id=<?= $child['id']; ?>" class="btn btn-edit">Edit</a>
                            <a href="deletechild.php?id=<?= $child['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this child?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <h2>Add a New Child</h2>
    <form method="POST" action="addchild.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required>

        <button type="submit">Add Child</button>
    </form>
</div>

</body>
</html>



