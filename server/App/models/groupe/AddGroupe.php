<?php
require_once __DIR__ . "/../../config/DataBase.php";

class AddGroupe {
    private $conn;
    private $table = "groupe";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addgroupe($nom_groupe, $nom_projet, $duree, $date_debut, $date_fin) {
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

            // Requête SQL
            $query = "INSERT INTO " . $this->table . " (nom_groupe, nom_projet, duree, date_debut, date_fin) VALUES (:nom_groupe, :nom_projet, :duree, :date_debut, :date_fin)";
            $stmt = $this->conn->prepare($query);

            // Liaison des paramètres
            $stmt->bindParam(":nom_groupe", $nom_groupe);
            $stmt->bindParam(":nom_projet", $nom_projet);
            $stmt->bindParam(":duree", $duree);
            $stmt->bindParam(":date_debut", $date_debut);
            $stmt->bindParam(":date_fin", $date_fin);

            // Exécution de la requête
            if (!$stmt->execute()) {
                throw new Exception("Échec de l'insertion du groupe.");
            }

            return true;
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}
?>