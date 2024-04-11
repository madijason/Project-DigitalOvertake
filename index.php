<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=digitalovertake;charset=utf8', 'root', '');

    // Première requête SQL
    $query_recommendations = $pdo->prepare('SELECT * FROM recommendations');
    $query_recommendations->execute();
    $recommandations = $query_recommendations->fetchAll();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr-fr">

<head>
    <meta charset="utf-8" />
    <title>Maë On Track - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Style pour la boîte modale */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="navbar">
        <h1 id="title">Maë On Track</h1>
        <a class="active" href="#home">Accueil</a>
        <a href="actus.php">Actus</a>
        <a href="articles.php">Articles</a>
        <img alt="logo" src="images/logo.png" height="100px" width="100px" />
        <a href="interviews.php">Interviews</a>
        <a href="about.php">A propos</a>
        <a class="pitcrew" href="#pitcrew" onclick="ouvrirModal()">PitCrew</a>
    </div>
    <div id="main" class="index">
        <div class="column">
            <div class="section">
                <h1>Dernières publications</h1>
                <div class="main_i">
                    <?php
                    try {
                        // Deuxième requête SQL
                        $query_recommendations_details = $pdo->prepare('
                                SELECT r.id, r.reco_id, r.category, i.id AS interview_id, i.title 
                                FROM recommendations r
                                INNER JOIN interviews i ON r.reco_id = i.id
                                ');
                        $query_recommendations_details->execute();
                        $results = $query_recommendations_details->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($results as $result) {

                            echo '<div class="card">';
                            echo '<p style="flex: 1; margin: 0; padding: 10px; font-weight: bold; font-size: 24px;">' . $result['title'] . '</p>';
                            echo '</div>';
                        }
                    } catch (Exception $e) {
                        die('Erreur : ' . $e->getMessage());
                    }
                    ?>
                </div>
            </div>
            <div class="section">
                <h1>Formats courts</h1>
                <div class="main_i">
                    <div class="short-card"></div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="section">
                <h1>Format longs</h1>
                <div class="main_i">
                    <div class="card"></div>
                </div>
            </div>
            <div class="section">
                <h1>Recommandations</h1>
                <div class="main_i">
                    <?php
                    try {
                        // Deuxième requête SQL
                        $query_recommendations_details = $pdo->prepare('
                                SELECT r.id, r.reco_id, r.category, i.id AS interview_id, i.title 
                                FROM recommendations r
                                INNER JOIN interviews i ON r.reco_id = i.id
                                ');
                        $query_recommendations_details->execute();
                        $results = $query_recommendations_details->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($results as $result) {

                            echo '<div class="card">';
                            echo '<p style="flex: 1; margin: 0; padding: 10px; font-weight: bold; font-size: 24px;">' . $result['title'] . '</p>';
                            echo '</div>';
                        }
                    } catch (Exception $e) {
                        die('Erreur : ' . $e->getMessage());
                    }
                    ?>
                </div>
                <!-- <span class="ribbon">New</span> -->
            </div>
        </div>
    </div>
    <!-- Boîte modale -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fermerModal()">&times;</span>
            <p>Cette fonctionnalité est en cours de développement. Veuillez revenir plus tard.</p>
        </div>
    </div>
    <script>
        // Fonction pour ouvrir la boîte modale
        function ouvrirModal() {
            document.getElementById("myModal").style.display = "block";
        }

        // Fonction pour fermer la boîte modale
        function fermerModal() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>
</body>

</html>
