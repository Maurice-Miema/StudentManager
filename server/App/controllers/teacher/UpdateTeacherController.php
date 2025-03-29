<?php
    require_once __DIR__ . "/../../models/teacher/UpdateTeacher.php";

    class UpdateTeacherController {
        public function store() {
            if ($_SERVER["REQUEST_METHOD"] === "PUT") {
                $data = json_decode(file_get_contents("php://input"), true);
                
                // Vérification des données requises
                if (!isset($data["id_professeur"], $data["nom"], $data["postnom"], $data["prenom"], $data["email"], $data["matricule"], $data["grade"])) {
                    echo json_encode(["message" => "Données incomplètes"]);
                    http_response_code(400);
                    exit();
                }

                $teacher = new UpdateTeacher();
                $result = $teacher->updateTeacher(
                    $data["id_professeur"],
                    $data["nom"],
                    $data["postnom"],
                    $data["prenom"],
                    $data["email"],
                    $data["matricule"],
                    $data["grade"]
                );

                if ($result === true) {
                    echo json_encode(["message" => "Les informations du professeur ont été mises à jour avec succès."]);
                    http_response_code(200);
                } else {
                    echo json_encode(["message" => "Échec de la Modification", "error" => $result["error"]]);
                    http_response_code(500);
                }
            }
        }
    }
?>

