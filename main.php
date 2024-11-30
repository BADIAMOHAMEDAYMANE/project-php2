<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal</title>
    <style>
        /* CSS nettoyé et optimisé */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            display: flex;
            gap: 40px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
        }
        .login-option {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .login-option img {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            border-radius: 50%;
            padding: 15px;
            background: #f8f9fa;
        }
        .login-option h2 {
            margin-bottom: 15px;
            font-size: 24px;
        }
        .login-button {
            background: linear-gradient(90deg, #00d2ff, #3a7bd5);
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .admin-option .login-button {
            background: linear-gradient(90deg, #ff0844, #ffb199);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-option admin-option">
            <form method="POST" action="read.php">
                <img src="https://www.wpeka.com/rgh/wp-content/uploads/2014/03/Changing-the-default-admin-user-in-WordPress1-460x575.jpg" alt="Admin Icon">
                <h2>Admin Portal</h2>
                <p>Access advanced controls and system management</p>
                <button type="submit" name="submit1" class="login-button">Admin Login</button>
            </form>
        </div>
        <div class="login-option">
            <form method="POST" action="signup2.php">
                <img src="https://icons.veryicon.com/png/o/miscellaneous/icon-icon-of-ai-intelligent-dispensing/login-user-name-1.png" alt="User Icon">
                <h2>User Portal</h2>
                <p>Access your personal workspace and features</p>
                <button type="submit" name="submit2" class="login-button">User Login</button>
            </form>
        </div>
    </div>
</body>
</html>
