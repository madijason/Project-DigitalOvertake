<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=digitalovertake;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

$query = "SELECT title, author, publication, content FROM actus WHERE url = :title";
try {
    $statement = $pdo->prepare($query);
    $statement->bindParam(':title', $_GET['title'], PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Erreur lors de la récupération des données : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr-fr">
<head>
    <meta charset="utf-8">
    <title>Maë On Track - Actu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="navbar">
        <h1 id="title">Maë On Track</h1>
        <a href="index.php">Accueil</a>
        <a href="actus.php">Actus</a>
        <a href="articles.php">Articles</a>
        <img alt="logo" src="images/logo.png" height="100px" width="100px">
        <a href="interviews.php">Interviews</a>
        <a href="about.php">A propos</a>
        <a class="pitcrew" href="#pitcrew">PitCrew</a>
    </div>
    <div class="actu">
        <h1 class="actu-title"><?php echo $result['title'] ?></h1>
        <h6 class="actu-intel">Par <?php echo $result['author'] ?> - Le <?php echo $result['publication'] ?></h6>
        <p class="actu-text"><?php echo $result['content'] ?></p>
    </div>
</body>
</html>
