<?php
require_once 'controlleur/ArticleController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualité Polytechnicien</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
$controller = new ArticleController();
$controller->displayArticles();
?>
</body>
</html>
