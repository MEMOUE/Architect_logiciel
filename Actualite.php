<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualité Polytechnicien</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 1em;
            font-size: 2em;
        }
        .nav {
            display: flex;
            justify-content: center;
            background-color: #333;
        }
        .nav a {
            padding: 14px 20px;
            display: block;
            color: white;
            text-align: center;
            text-decoration: none;
        }
        .nav a:not(:last-child) {
            border-right: 1px solid #bbb;
        }
        .nav a:hover {
            background-color: #ddd;
            color: black;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        .article {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 10px 0;
            padding: 20px;
            width: 80%;
            box-sizing: border-box;
        }
        .article h2 {
            font-size: 1.5em;
            margin: 0 0 10px;
        }
        .article p {
            font-size: 1em;
            margin: 0 0 20px;
        }
        .article small {
            color: #888;
        }
    </style>
</head>
<body>
    <div class="header">
        ACTUALITE  POLYTECHNICIEN
    </div>
    <div class="nav">
        <a href="?">Accueil</a>
        <a href="?categorie=1">Sport</a>
        <a href="?categorie=2">Santé</a>
        <a href="?categorie=3">Education</a>
        <a href="?categorie=4">Politique</a>
    </div>
    <div class="container">
        <?php
        
        $mysqli = new mysqli("localhost", "mglsi_user", "passer", "mglsi_news");

        
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        
        if (isset($_GET['categorie'])) {
            $categorie_id = intval($_GET['categorie']);
            $articles_query = "SELECT * FROM Article WHERE categorie=$categorie_id";
        } else {
            $articles_query = "SELECT * FROM Article";
        }

        
        $articles_result = $mysqli->query($articles_query);
        if ($articles_result->num_rows > 0) {
            while ($article = $articles_result->fetch_assoc()) {
                echo '<div class="article">';
                echo '<h2>' . $article['titre'] . '</h2>';
                echo '<p>' . $article['contenu'] . '</p>';
                echo '<small>Publié le ' . $article['dateCreation'] . '</small>';
                echo '</div>';
            }
        } else {
            echo '<p>Aucun article trouvé.</p>';
        }

        
        $mysqli->close();
        ?>
    </div>
</body>
</html>
