<?php
require_once __DIR__ . "/../../models/groupe/UpdateGroupe.php";

class UpdateGroupeController {
    public function updateGroupeController() {
        // Vérifier que la méthode HTTP est PUT
        if ($_SERVER["REQUEST_METHOD"] === "PUT") {
            // Récupérer les données de la requête
            $data = json_decode(file_get_contents("php://input"), true);

            // Valider les données
            if (!isset($data["id_groupe"], $data["nom_groupe"], $data["nom_projet"], $data["duree"], $data["date_debut"], $data["date_fin"])) {
                echo json_encode(["message" => "Données incomplètes"]);
                http_response_code(400); // Bad Request
                exit();
            }

            // Instancier le modèle UpdateGroupe
            $updateGroupe = new UpdateGroupe();

            // Appeler la méthode pour mettre à jour le groupe
            $result = $updateGroupe->updateGroupe(
                $data["id_groupe"],
                $data["nom_groupe"],
                $data["nom_projet"],
                $data["duree"],
                $data["date_debut"],
                $data["date_fin"]
            );

            // Retourner la réponse
            if ($result === true) {
                echo json_encode(["message" => "Groupe mis à jour avec succès !"]);
                http_response_code(200); // OK
            } else {
                echo json_encode(["message" => "Échec de la mise à jour", "error" => $result["error"]]);
                http_response_code(500); // Internal Server Error
            }
        } else {
            // Si la méthode HTTP n'est pas PUT
            echo json_encode(["message" => "Méthode non autorisée"]);
            http_response_code(405); // Method Not Allowed
        }
    }
}
?>