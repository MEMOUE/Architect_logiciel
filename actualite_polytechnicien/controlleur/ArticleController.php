<?php
require_once __DIR__ . '/../modele/dao/ArticleDAO.php';

class ArticleController {
    private $articleDAO;

    public function __construct() {
        $this->articleDAO = new ArticleDAO($this->getPDOConnection());
    }

    public function displayArticles() {
        if (isset($_GET['categorie'])) {
            $categoryId = intval($_GET['categorie']);
            $articles = $this->articleDAO->getArticlesByCategory($categoryId);
        } else {
            $articles = $this->articleDAO->getAllArticles();
        }
        include __DIR__ . '/../vue/article.php';
    }

    private function getPDOConnection() {
        $host = 'localhost';
        $db = 'mglsi_news';
        $user = 'mglsi_user';
        $pass = 'passer';

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
            return $pdo;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
?>
