<?php
session_start();

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO('mysql:host=localhost;dbname=digitalovertake;charset=utf8', 'root', '');
    
    // Configuration pour afficher les erreurs PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour sélectionner les colonnes username et password de la table users
    $sql = "SELECT username, password FROM users";
    $stmt = $pdo->query($sql);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Boucle à travers chaque résultat
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Accéder aux valeurs de chaque colonne
            $username = $row["username"];
            $password = $row["password"];

            if ($password == $_POST['password'] && $username == $_POST['username']) {
                echo 'Connecté';
                $_SESSION['connect'] = true;
                header('Location: manager.php');
                exit;
            } else {
                echo 'Mauvais identifiants';
                $_SESSION['connect'] = false;
            }
        }
    }
} catch (PDOException $e) {
    // En cas d'erreur de connexion ou de requête
    echo "Erreur : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form .form-group {
            margin-bottom: 20px;
        }

        .login-form .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .login-form .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="login-form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
