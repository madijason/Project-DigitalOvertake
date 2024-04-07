<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=digitalovertake;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    die();
}

$query = $pdo->prepare('SELECT * FROM articles');
$query->execute();
$articles = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr-fr">
<head>
    <meta charset="utf-8">
    <title>Maë On Track - Articles</title>
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
        <a href="actus.php">Actus</a>
        <a href="articles.php" class="active">Articles</a>
        <img alt="logo" src="images/logo.png" height="100px" width="100px">
        <a href="interviews.php">Interviews</a>
        <a href="about.php">A propos</a>
        <a class="pitcrew" href="#pitcrew">PitCrew</a>
    </div>
    <div id="articles-navbar">
        <a href="#F1">F1</a>
        <a href="#F2">F2</a>
        <a href="#F3">F3</a>
        <a href="#F1Academy">F1 Academy</a>
        <a href="#Autres">Autres</a>
    </div>
    <div id="main" class="shared">
        <div id="brand-navbar">
            <a href="#rb">Redbull</a>
            <a href="#mercedes">Mercedes</a>
            <a href="#ferrari">Ferrari</a>
            <a href="#mcl">McLaren</a>
            <a href="#astonmartin">Aston Martin</a>
            <a href="#alpine">Alpine</a>
            <a href="#williams">Williams</a>
            <a href="#rbvisa">RB Visa Cash</a>
            <a href="#stake">Stake</a>
            <a href="#haas">Haas</a>
        </div>
        <?php foreach ($articles as $article): ?>
            <div class="extended-card" onclick="redirectToDetail('<?php echo urlencode($article['url']); ?>')">
                <div class="content">
                    <h3><?php echo $article['title']; ?></h3>
                    <p><?php echo substr($article['content'], 0, 100); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        function redirectToDetail(title) {
            window.location.href = "article_detail.php?title=" + encodeURIComponent(title);
        }
    </script>
</body>
</html>
