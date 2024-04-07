<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=digitalovertake;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

$query = $pdo->prepare('SELECT * FROM actus');
$query->execute();
$actus = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr-fr">
<head>
    <meta charset="utf-8">
    <title>Maë On Track - Actus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        a {
            text-decoration: none;
            color: #C9E4CA;
        }
        
        a:hover {
            color: #364958;
        }
    </style>
</head>
<body>
    <div id="navbar">
        <h1 id="title">Maë On Track</h1>
        <a href="index.php">Accueil</a>
        <a href="actus.php" class="active">Actus</a>
        <a href="articles.php">Articles</a>
        <img alt="logo" src="images/logo.png" height="100px" width="100px">
        <a href="interviews.php">Interviews</a>
        <a href="about.php">A propos</a>
        <a class="pitcrew" href="#pitcrew">PitCrew</a>
    </div>
    <div id="main">
        <?php foreach ($actus as $actu): ?>
            <div class="extended-card" onclick="redirectToDetail('<?php echo urlencode($actu['url']); ?>')">
                <div class="content">
                    <h3><?php echo $actu['title']; ?></h3>
                    <p>Par <?php echo $actu['author'] ?></p>
                </div>
                <img src="<?php echo $actu['images']; ?>" />
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        function redirectToDetail(url) {
            window.location.href = "actu_detail.php?title=" + encodeURIComponent(url);
        }
    </script>
</body>
</html>
