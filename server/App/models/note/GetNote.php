<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class GetNote {
        private $conn;
        private $table_note = "notes";  // Table des notes
        private $table_cours = "cours"; // Table des cours

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        public function getNotesByStudent($id_etudiant) {
            try {
                // Joindre la table 'cours' à la table 'notes' sur 'id_cours'
                $query = "
                    SELECT 
                        n.id_cours, 
                        n.note_obtenue, 
                        c.nom AS nom_cours
                    FROM " . $this->table_note . " n
                    JOIN " . $this->table_cours . " c ON n.id_cours = c.id_cours
                    WHERE n.id_etudiant = :id_etudiant
                ";

                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":id_etudiant", $id_etudiant);
                $stmt->execute();

                $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!$notes) {
                    return ["message" => "Aucune note trouvée pour cet étudiant."];
                }

                // Calcul de la moyenne
                $total_notes = count($notes);
                $somme_notes = array_sum(array_column($notes, "note_obtenue"));
                $moyenne = $total_notes > 0 ? $somme_notes / $total_notes : 0;

                return [
                    "notes" => $notes,
                    "moyenne" => round($moyenne, 2)
                ];
            } catch (Exception $e) {
                return ["error" => $e->getMessage()];
            }
        }
    }
?>
