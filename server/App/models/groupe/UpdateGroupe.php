<?php
require_once __DIR__ . "/../../config/DataBase.php";

class UpdateGroupe {
    private $conn;
    private $table = "groupe";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function updateGroupe($id_groupe, $nom_groupe, $nom_projet, $duree, $date_debut, $date_fin) {
        try {
            // Convertir les dates au format YYYY-MM-DD
            $date_debut_obj = DateTime::createFromFormat('d/m/Y', $date_debut);
            $date_fin_obj = DateTime::createFromFormat('d/m/Y', $date_fin);

            // Vérifier si la conversion a réussi
            if (!$date_debut_obj || !$date_fin_obj) {
                throw new Exception("Format de date invalide. Utilisez le format jj/mm/aaaa.");
            }

            // Formater les dates en YYYY-MM-DD
            $date_debut = $date_debut_obj->format('Y-m-d');
            $date_fin = $date_fin_obj->format('Y-m-d');

            // Requête SQL pour mettre à jour un groupe
            $query = "UPDATE " . $this->table . " 
                      SET nom_groupe = :nom_groupe, 
                          nom_projet = :nom_projet, 
                          duree = :duree, 
                          date_debut = :date_debut, 
                          date_fin = :date_fin 
                      WHERE id_groupe = :id_groupe";

            $stmt = $this->conn->prepare($query);

            // Liaison des paramètres
            $stmt->bindParam(":id_groupe", $id_groupe);
            $stmt->bindParam(":nom_groupe", $nom_groupe);
            $stmt->bindParam(":nom_projet", $nom_projet);
            $stmt->bindParam(":duree", $duree);
            $stmt->bindParam(":date_debut", $date_debut);
            $stmt->bindParam(":date_fin", $date_fin);

            // Exécution de la requête
            if (!$stmt->execute()) {
                throw new Exception("Échec de la mise à jour du groupe.");
            }

            return true;
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}
?>