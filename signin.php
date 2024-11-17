<?php
include("config3.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="signin2.css">
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
                    <label>Email</label>
                    <input type="email" name="email" >
                    <span class="icon">
                        <ion-icon name="mail-outline"></ion-icon>
                    </span>
                    <span style='color:red' class="span1"><?php echo $emailerrormsg ?></span>
                </div>
                <div class="input-box">
                    <label>Password</label>
                    <input type="password" name="password" >
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <span style='color:red' class="span1"><?php echo $passworderrormsg ?></span>
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
