<?php
require_once __DIR__ . "/../../config/DataBase.php";

class GetGroupe {
    private $conn;
    private $table = "groupe";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllGroupes() {
        try {
            // Requête SQL pour récupérer tous les groupes
            $query = "SELECT id_groupe, nom_groupe, nom_projet, duree, date_debut, date_fin FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $groupes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!$groupes) {
                return ["message" => "Aucun groupe trouvé."];
            }

            return $groupes;
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}
?>
