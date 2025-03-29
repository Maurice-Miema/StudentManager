<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class ListStudent {
        private $pdo;

        public function __construct() {
            $database = new Database();
            $this->pdo = $database->getConnection();
        }

        public function getStudent() {
            try {
                $sql = "SELECT u.id_utilisateur, u.nom, u.post_nom, u.prenom, u.email, u.matricule, p.nom_promotion, p.annee_academique
                        FROM promotion p
                        JOIN utilisateur u ON p.id_etudiant = u.id_utilisateur";
                        
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