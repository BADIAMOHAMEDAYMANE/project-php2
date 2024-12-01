<?php
 include("config4.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="signup.css">
</head>
<body>
  <div class="signup-container">
    <h1>Sign Up</h1>
    <form id="login-form" action="" method="POST">
      <label for="username">Email:</label>
      <input type="email" id="username" name="email" placeholder="Enter your email">
      <span style='color:red' class="span1"><?php echo $emailerrormsg ?></span>
      
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter your password">
      <span style='color:red' class="span1"><?php echo $passworderrormsg ?></span>
      
      <label for="confirm-password">Confirm Password:</label>
      <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password">
      <button type="submit" name="submit">Sign Up</button>
      <p>
      Do you already have an account? 
      <a href="signin.php">Sign In</a>
    </p>
    </form>
  </div>
</body>
</html>
