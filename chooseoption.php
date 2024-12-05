<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(120deg, #6a11cb, #2575fc);
            color: #fff;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .container h1 {
            margin-bottom: 15px;
            font-size: 28px;
            color: #6a11cb;
        }

        .container p {
            font-size: 16px;
            margin-bottom: 25px;
            color: #555;
        }

        .btn {
            display: inline-block;
            width: 100%;
            margin: 10px 0;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-signup {
            background-color: #6a11cb;
            color: #fff;
            border: none;
        }

        .btn-signup:hover {
            background-color: #5a0fbc;
        }

        .btn-visit {
            background-color: #f0f0f0;
            color: #333;
            border: 1px solid #ddd;
        }

        .btn-visit:hover {
            background-color: #e0e0e0;
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue</h1>
        <p>Explorez notre site ou inscrivez-vous pour rejoindre notre école.</p>
        <a href="signup2.php" class="btn btn-signup">S'inscrire à l'école</a>
        <a href="validation.php" class="btn btn-visit">Visiter le site</a>
        <footer>
            <p>&copy; 2024 Notre École. Tous droits réservés.</p>
        </footer>
    </div>
</body>
</html>
