<?php
require_once __DIR__ . "/../../models/groupe/DeleteGroupe.php";

class DeleteGroupeController {
    public function deleteGroupeController() {
        // Vérifier que la méthode HTTP est DELETE
        if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
            // Récupérer les données de la requête
            $data = json_decode(file_get_contents("php://input"), true);

            // Vérifier que l'ID du groupe est fourni
            if (!isset($data["id_groupe"])) {
                echo json_encode(["message" => "ID du groupe manquant"]);
                http_response_code(400); // Bad Request
                exit();
            }

            // Instancier le modèle DeleteGroupe
            $deleteGroupe = new DeleteGroupe();

            // Appeler la méthode pour supprimer le groupe
            $result = $deleteGroupe->deleteGroupe($data["id_groupe"]);

            // Retourner la réponse
            if (isset($result["success"])) {
                echo json_encode(["message" => $result["success"]]);
                http_response_code(200); // OK
            } else {
                echo json_encode(["message" => "Échec de la suppression", "error" => $result["error"]]);
                http_response_code(500); // Internal Server Error
            }
        } else {
            // Si la méthode HTTP n'est pas DELETE
            echo json_encode(["message" => "Méthode non autorisée"]);
            http_response_code(405); // Method Not Allowed
        }
    }
}
?>