<?php 
include('credentials.php');
mysqli_select_db($conn,'website');

$sql = "SELECT id,email FROM users";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

<div class="container my-5">
    <h2>List of users from database</h2>
    <a  class="btn btn-primary" href=".php" role="button">Signup</a>

    <br>
    <br>
    <table class="table">
       <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?=$row["id"] ?></td>
                <td><?=$row["email"] ?></td>
                <td>
                    <a href="<?="/tp2/adminedit.php/".$row["id"] ?>" class="btn btn-primary">Edit</a>
                    <a href="<?="/tp2/admindelete.php/".$row["id"] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php } ?>
   
        </tbody>
        
    </table>
    </div>
</body>
</html>