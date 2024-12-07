<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f3f4f7, #e0e5ec);
            color: #333;
            margin: 0;
            padding: 0;
        }

        nav {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff !important;
        }

        .navbar-nav .nav-link {
            color: #555 !important;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff !important;
        }

        /* Header Styles */
        h1 {
            margin-top: 3rem;
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Spacing for content */
        .container {
            margin-top: 2rem;
            padding: 2rem;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="read.php">Users List <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login2.php">Add Child</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Welcome Message -->
    <div class="container">
        <h1>Welcome to the Admin's World</h1>
        <p style="margin-top: 1rem; font-size: 1.2rem; color: #555;">
            Explore and manage the user data efficiently with this simple and intuitive interface.
        </p>
    </div>
</body>
</html>
