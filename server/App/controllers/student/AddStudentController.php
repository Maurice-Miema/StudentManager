<?php
    require_once __DIR__ . "/../../models/student/AddStudent.php";

    class AddStudentController {
        public function store() {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $data = json_decode(file_get_contents("php://input"), true);
                
                if (!isset($data["nom"], $data["postnom"], $data["matricule"], $data["password"], $data["role"])) {
                    echo json_encode(["message" => "Données incomplètes"]);
                    http_response_code(400);
                    exit();
                }

                $student = new AddStudentModel();
                $result = $student->addStudent($data["nom"], $data["postnom"], $data["matricule"], $data["password"], $data["role"]);

                if ($result) {
                    echo json_encode(["message" => "Utilisateur ajouté avec succès"]);
                    http_response_code(201);
                } else {
                    echo json_encode(["message" => "Échec de l'ajout Probleme Server"]);
                    http_response_code(500);
                }
            }
        }
    }
?>
