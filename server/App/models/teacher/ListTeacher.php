<?php
require_once __DIR__ . "/../../config/Database.php";

class ListTeacher {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function getTeacher() {
        try {
            $sql = "SELECT u.id_utilisateur, u.nom, u.post_nom, u.prenom, u.email, u.matricule, p.grade 
                    FROM professeur p
                    JOIN utilisateur u ON p.id_utilisateur = u.id_utilisateur";
                    
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des enseignants : " . $e->getMessage());
            return false;
        }
    }
}
?>