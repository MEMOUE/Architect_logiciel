<?php
require_once __DIR__ . '/../domaine/Article.php';

class ArticleDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllArticles() {
        $stmt = $this->pdo->query('SELECT * FROM Article');
        return $stmt->fetchAll();
    }

    public function getArticlesByCategory($categoryId) {
        $stmt = $this->pdo->prepare('SELECT * FROM Article WHERE categorie = :categorie');
        $stmt->execute(['categorie' => $categoryId]);
        return $stmt->fetchAll();
    }
}
?>
