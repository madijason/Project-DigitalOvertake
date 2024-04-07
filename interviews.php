<?php
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=digitalovertake;charset=utf8', 'root', '');
    $query = $pdo->prepare('SELECT * FROM interviews');
    $query->execute();
    $interviews = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr-fr">
<head>
    <meta charset="utf-8" />
    <title>Maë On Track - Interviews</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="styles.css" rel="stylesheet" />
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
        <a href="articles.php">Articles</a>
        <img alt="logo" src="images/logo.png" height="100px" width="100px"/>
        <a href="#interviews" class="active">Interviews</a>
        <a href="about.php">A propos</a>
        <a class="pitcrew" href="#pitcrew">PitCrew</a>
    </div>       
    <div id="main">        
        <?php
            foreach ($interviews as $interview){
                ?>
                <div class="extended-card">
                    <a href="interview_detail.php?title=<?php echo urlencode($interview['title']); ?>" class="card-link">
                        <div class="content">
                            <h3><span class="interview-name"><?php echo $interview['title']; ?></span></h3>
                            <p><?php echo $interview['description']; ?></p>
                        </div>
                    </a>
                </div>
                <?php
            }
        ?>
    </div>
</body>
</html>
