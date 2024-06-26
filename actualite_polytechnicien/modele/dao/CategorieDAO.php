<?php
require_once __DIR__ . '/../domaine/Categorie.php';

class CategorieDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllCategories() {
        $stmt = $this->pdo->query('SELECT * FROM Categorie');
        return $stmt->fetchAll();
    }
}
?>
