<?php 
include("credentials.php");
mysqli_select_db($conn,'testdb');
$errormsg = ""; 
$errorpasswordmsg = ""; 
$fnamevalue = "";
$lnamevalue = "";
$emailvalue = "";
$passwordvalue = "";
$successmsg ="";

$url = $_SERVER['REQUEST_URI']; 
$pathParts = explode('/', trim($url, '/'));
$id = $pathParts[2];
$sql = "SELECT id,email,password FROM Persons WHERE id=".$id;
$result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
         $fnamevalue = $row["firstname"];
         $lnamevalue = $row["lastname"];
         $emailvalue = $row["email"];
        }

    if (isset($_POST['submit'])) {
            $fnamevalue = $_POST['firstName'];
            $lnamevalue = $_POST['lastName'];
            $emailvalue = $_POST['email'];
            $passwordvalue = $_POST['password'];
        
            if (empty($fnamevalue) || empty($lnamevalue) || empty($emailvalue) || empty($passwordvalue)) {
                $errormsg = "All fields are required.";
            } else if (strlen($passwordvalue) < 8) {
                $errorpasswordmsg = "Password must contain at least 8 characters.";
            } else if (!preg_match('/[A-Z]+/', $passwordvalue)) {
                $errorpasswordmsg = "Password must contain at least one capital letter.";
            }
            else{

                $hashedPassword = password_hash($passwordvalue,PASSWORD_DEFAULT);
                $sql = "UPDATE persons 
                SET firstname = '$fnamevalue', 
                    lastname = '$lnamevalue', 
                    email = '$emailvalue', 
                    password = '$hashedPassword' 
                WHERE id = $id";
                    if (mysqli_query($conn, $sql)) {
                        $successmsg =  "Table Clients created succesfuly";
                        header(header: "location:/tp2/allusers.php");   
                    } else {
                       $errormsg .="Error : " .sql ."<br>" .mysqli_error($conn);
            }
        }
        }

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
        <h2>EDIT</h2>
        <br>
        <form method="post">
            <div class="row mb-3">
                <span style="color:red"><?=$errormsg ?></span>
                <label class="col-form-label col-sm-1" for="fname">First Name:</label>
                <div class="col-sm-6">
                    <input value="<?= $fnamevalue ?>" class="form-control" type="text" id="fname" name="firstName">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="lname">Last Name:</label>
                <div class="col-sm-6">
                    <input value="<?=  $lnamevalue ?>" class="form-control" type="text" id="lname" name="lastName">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="email">Email:</label>
                <div class="col-sm-6">
                    <input value="<?= $emailvalue ?>" class="form-control" type="email" id="email" name="email">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-1" for="password">Password:</label>
                <div class="col-sm-6">
                    <input class="form-control" type="password" id="password" name="password">
                </div>
                <span style="color:red"><?= $errorpasswordmsg?></span>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-1 col-sm-3 d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">Update</button>
                </div>

            </div>
        </form>
    </div>
</body>
</html>
