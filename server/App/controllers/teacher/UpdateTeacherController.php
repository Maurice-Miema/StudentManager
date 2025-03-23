<?php
require_once __DIR__ . "/../../models/teacher/UpdateTeacher.php";

class UpdateTeacherController {
    public function store() {
        if ($_SERVER["REQUEST_METHOD"] === "PUT") {
            $data = json_decode(file_get_contents("php://input"), true);
            
            // Vérification des données requises
            if (!isset($data["id_professeur"], $data["nom"], $data["postnom"], $data["prenom"], $data["email"], $data["matricule"], $data["grade"])) {
                echo json_encode(["message" => "Données incomplètes"]);
                http_response_code(400); // Bad Request
                exit();
            }

            // Créer une instance de la classe UpdateTeacher
            $teacher = new UpdateTeacher();
            // Appeler la méthode updateTeacher et récupérer le résultat
            $result = $teacher->updateTeacher(
                $data["id_professeur"],
                $data["nom"],
                $data["postnom"],
                $data["prenom"],
                $data["email"],
                $data["matricule"],
                $data["grade"]
            );

            // Vérification du résultat de la mise à jour
            if (isset($result["success"])) {
                echo json_encode(["message" => $result["success"]]);
                http_response_code(200); // OK
            } else {
                echo json_encode(["message" => "Échec de la modification", "error" => $result["error"]]);
                http_response_code(500); // Internal Server Error
            }
        }
    }
}
?>