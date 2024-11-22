<?php
  include("configadmin.php");
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
        <h2>SIGN UP</h2>         
        <br>         
        <form method="post">             
            <div class="row mb-3">                 
                <label class="col-form-label col-sm-1" for="email">Email:</label>                 
                <div class="col-sm-6">                     
                    <input value="<?php echo $emailvalue; ?>" class="form-control" type="email" id="email" name="email">                 
                </div>             
            </div>             
            <div class="row mb-3">                 
                <label class="col-form-label col-sm-1" for="password">Password:</label>                 
                <div class="col-sm-6">                     
                    <input class="form-control" type="password" id="password" name="password">                 
                </div>                 
                <span style="color:red"><?php echo $errorpasswordmsg; ?></span>             
            </div>             
            <div class="row mb-3">                 
                <div class="offset-sm-1 col-sm-3 d-grid">                     
                    <button name="submit" type="submit" class="btn btn-primary">Signup</button>                 
                </div>                 
                <div class="col-sm-3 d-grid">                     
                    <a class="btn btn-outline-primary" href="login.php">Login</a>                 
                </div>             
            </div>         
        </form>     
    </div> 
</body> 
</html>