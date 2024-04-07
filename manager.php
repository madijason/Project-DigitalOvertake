<?php
session_start();

if ($_SESSION['connect'] == "True") {
    // Connect to the database
    $pdo = new PDO('mysql:host=localhost;dbname=digitalovertake;charset=utf8', 'root', '');
    
    // Check if an option has been selected
    if(isset($_GET['choice'])) {
        $choice = $_GET['choice'];
        
        // Retrieve data based on the selected option
        switch($choice) {
            case 'interviews':
                $query = $pdo->prepare('SELECT * FROM interviews');
                break;
            case 'actus':
                $query = $pdo->prepare('SELECT * FROM actus');
                break;
            case 'articles':
                $query = $pdo->prepare('SELECT * FROM articles');
                break;
            default:
                // Handle invalid option
                break;
        }
        
        if(isset($query)) {
            $query->execute();
            $data = $query->fetchAll();
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Maë On Track - Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="manager_style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="shared-screen">
        <div class="main-bar">
            <div class="selection-div">
                <form>
                    <label for="choice">Choisissez une option :</label>
                    <select id="choice" name="choice">
                      <option value="articles">Articles</option>
                      <option value="interviews">Interviews</option>
                      <option value="actus">Actualités</option>
                    </select>
                    <button class="button">Créer</button>
                    <button class="button" type="submit">Actualiser</button> <!-- Bouton Actualiser -->
                </form>
            </div>
            <div class="content-list">
                <?php if(isset($data)): ?>
                <input type="text" id="myInput" placeholder="Rechercher un article..">
                <ul id="myUL">
                    <?php foreach($data as $item): ?>
                        <li><a href="#"><?= $item['title'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>              
        <div class="window">
            <button class="button" id="buttonB">Gras</button>
            <button class="button" id="buttonU">Souligner</button>
            <button class="button" id="buttonI">Italique</button>
            <h1 contenteditable="true">Titre du texte</h1>
            <hr />
            <p contenteditable="true">Je suis le texte</p>
        </div>
    </div>
</body>
<script>
document.getElementById("buttonB").addEventListener("click", function() {
    var selection = window.getSelection().toString();
    if (selection !== "") {
        var span = document.createElement("span");
        span.style.fontWeight = "bold"; // Ajoute le style gras
        span.textContent = selection;
        var range = window.getSelection().getRangeAt(0);
        
        // Vérifie si la sélection est déjà en gras
        if (range.commonAncestorContainer.parentNode.style.fontWeight === "bold") {
            span.style.fontWeight = "normal"; // Retire le gras si déjà appliqué
        }
        
        range.deleteContents();
        range.insertNode(span);
    }
});

document.getElementById("buttonU").addEventListener("click", function() {
    var selection = window.getSelection().toString();
    if (selection !== "") {
        var span = document.createElement("span");
        span.style.textDecoration = "underline"; // Ajoute le style souligné
        span.textContent = selection;
        var range = window.getSelection().getRangeAt(0);
        
        // Vérifie si la sélection est déjà soulignée
        if (range.commonAncestorContainer.parentNode.style.textDecoration === "underline") {
            span.style.textDecoration = "none"; // Retire le soulignement si déjà appliqué
        }
        
        range.deleteContents();
        range.insertNode(span);
    }
});

document.getElementById("buttonI").addEventListener("click", function() {
    var selection = window.getSelection().toString();
    if (selection !== "") {
        var span = document.createElement("span");
        span.style.fontStyle = "italic"; // Ajoute le style italique
        span.textContent = selection;
        var range = window.getSelection().getRangeAt(0);
        
        // Vérifie si la sélection est déjà en italique
        if (range.commonAncestorContainer.parentNode.style.fontStyle === "italic") {
            span.style.fontStyle = "normal"; // Retire l'italique si déjà appliqué
        }
        
        range.deleteContents();
        range.insertNode(span);
    }
});

</script>
</html>
<?php
} else {
    echo 'Non connecté';
}
?>
