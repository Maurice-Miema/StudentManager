<?php
    require_once __DIR__ . "/../../models/student/UpdateStudent.php";

    class UpdateStudentController {
        public function store() {
            if ($_SERVER["REQUEST_METHOD"] === "PUT") {
                $data = json_decode(file_get_contents("php://input"), true);
                
                // Vérification des données requises
                if (!isset($data["id_etudiant"], $data["nom"], $data["postnom"], $data["matricule"], $data["promotion"], $data["annee_academique"])) {
                    echo json_encode(["message" => "Données incomplètes"]);
                    http_response_code(400);
                    exit();
                }

                $student = new UpdateStudent();
                $result = $student->updateStudent(
                    $data["id_etudiant"],
                    $data["nom"],
                    $data["postnom"],
                    $data["matricule"],
                    $data["promotion"],
                    $data["annee_academique"]
                );

                if ($result === true) {
                    echo json_encode(["message" => "Les informations de l'étudiant ont été mises à jour avec succès."]);
                    http_response_code(200);
                } else {
                    echo json_encode(["message" => "Échec de la Modification", "error" => $result["error"]]);
                    http_response_code(500);
                }
            }
        }
    }
?>

